<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstaFollower;
use App\Models\InstaInteraction;
use App\Models\InstaInteractionType;
use App\Models\InstaInteractionStat;
use App\Models\InstaPost;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InstaInteractionController extends Controller
{
    /**
     * Récupère les followers éligibles pour une interaction (like/comment).
     * Filtrage basé sur les limites hebdomadaires et mensuelles.
     */
    public function getEligibleFollowers(Request $request)
    {
        // Définir les dates de début de semaine, mois et année
        $currentDate = Carbon::now();
        $weekStart = $currentDate->copy()->startOfWeek()->toDateString();
        $monthStart = $currentDate->copy()->startOfMonth()->toDateString();
        $yearStart = $currentDate->copy()->startOfYear()->year;

        // Récupérer les followers éligibles pour un like (<2 likes sortants par semaine)
        $eligibleForLike = InstaFollower::whereHas('interactionStats', function ($query) use ($weekStart, $monthStart, $yearStart) {
            $query->where('week_start', $weekStart)
                ->where('month_start', $monthStart)
                ->where('year_start', $yearStart)
                ->where('likes_outgoing_week', '<', 2);
        })
            ->with(['interactionStats'])
            ->get();

        // Récupérer les followers éligibles pour un commentaire (<1 commentaire sortant par mois)
        $eligibleForComment = InstaFollower::whereHas('interactionStats', function ($query) use ($weekStart, $monthStart, $yearStart) {
            $query->where('week_start', $weekStart)
                ->where('month_start', $monthStart)
                ->where('year_start', $yearStart)
                ->where('comments_outgoing_month', '<', 1);
        })
            ->with(['interactionStats'])
            ->get();

        return response()->json([
            'eligible_for_like' => $eligibleForLike,
            'eligible_for_comment' => $eligibleForComment
        ]);
    }

    /**
     * Enregistre une interaction (like, comment, mention).
     * Demande attendue :
     * {
     *    "follower_id": 1,
     *    "interaction_type": "like", // 'like', 'comment', 'mention'
     *    "interaction_direction": "outgoing", // 'outgoing', 'incoming'
     *    "comment_text": "Superbe post !" // optionnel, requis pour les commentaires
     * }
     */
    public function recordInteraction(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'follower_id' => 'required|exists:InstaFollowers,follower_id',
            'interaction_type' => 'required|in:like,comment,mention',
            'interaction_direction' => 'required|in:outgoing,incoming',
            'comment_text' => 'required_if:interaction_type,comment',
        ]);

        // Récupérer le type d'interaction
        $interactionType = InstaInteractionType::where('name', $validated['interaction_type'])->first();

        if (!$interactionType) {
            return response()->json(['error' => 'Invalid interaction type'], 400);
        }

        // Créer l'interaction
        $interaction = InstaInteraction::create([
            'follower_id' => $validated['follower_id'],
            'interaction_type_id' => $interactionType->interaction_type_id,
            'interaction_direction' => $validated['interaction_direction'],
            'interaction_date' => Carbon::now(),
            'comment_text' => $validated['comment_text'] ?? null,
        ]);

        // Mettre à jour les statistiques
        $this->updateInteractionStats($validated['follower_id'], $interactionType->name, $validated['interaction_direction']);

        return response()->json(['message' => 'Interaction recorded successfully'], 201);
    }

    /**
     * Obtient les statistiques d'interaction d'un follower.
     */
    public function getFollowerStats($id)
    {
        $follower = InstaFollower::with('interactionStats')->find($id);

        if (!$follower) {
            return response()->json(['error' => 'Follower not found'], 404);
        }

        return response()->json([
            'follower_id' => $follower->follower_id,
            'username' => $follower->username,
            'interaction_stats' => $follower->interactionStats
        ]);
    }

    /**
     * Met à jour les statistiques d'interaction pour un follower.
     */
    private function updateInteractionStats($follower_id, $interaction_type, $interaction_direction)
    {
        $currentDate = Carbon::now();
        $weekStart = $currentDate->copy()->startOfWeek()->toDateString();
        $monthStart = $currentDate->copy()->startOfMonth()->toDateString();
        $yearStart = $currentDate->copy()->startOfYear()->year;

        // Récupérer ou créer les stats pour le follower et la période actuelle
        $stats = InstaInteractionStat::firstOrCreate(
            [
                'follower_id' => $follower_id,
                'week_start' => $weekStart,
                'month_start' => $monthStart,
                'year_start' => $yearStart,
            ],
            []
        );

        // Déterminer les champs à mettre à jour
        $fields = [];
        if ($interaction_direction == 'outgoing') {
            switch ($interaction_type) {
                case 'like':
                    $fields['likes_outgoing_week'] = $stats->likes_outgoing_week + 1;
                    $fields['likes_outgoing_month'] = $stats->likes_outgoing_month + 1;
                    $fields['likes_outgoing_year'] = $stats->likes_outgoing_year + 1;
                    $fields['likes_outgoing_total'] = $stats->likes_outgoing_total + 1;
                    $fields['last_like_date'] = Carbon::now();
                    break;
                case 'comment':
                    $fields['comments_outgoing_week'] = $stats->comments_outgoing_week + 1;
                    $fields['comments_outgoing_month'] = $stats->comments_outgoing_month + 1;
                    $fields['comments_outgoing_year'] = $stats->comments_outgoing_year + 1;
                    $fields['comments_outgoing_total'] = $stats->comments_outgoing_total + 1;
                    $fields['last_comment_date'] = Carbon::now();
                    break;
                case 'mention':
                    $fields['mentions_outgoing_week'] = $stats->mentions_outgoing_week + 1;
                    $fields['mentions_outgoing_month'] = $stats->mentions_outgoing_month + 1;
                    $fields['mentions_outgoing_year'] = $stats->mentions_outgoing_year + 1;
                    $fields['mentions_outgoing_total'] = $stats->mentions_outgoing_total + 1;
                    break;
            }
        } elseif ($interaction_direction == 'incoming') {
            switch ($interaction_type) {
                case 'like':
                    $fields['likes_incoming_week'] = $stats->likes_incoming_week + 1;
                    $fields['likes_incoming_month'] = $stats->likes_incoming_month + 1;
                    $fields['likes_incoming_year'] = $stats->likes_incoming_year + 1;
                    $fields['likes_incoming_total'] = $stats->likes_incoming_total + 1;
                    break;
                case 'comment':
                    $fields['comments_incoming_week'] = $stats->comments_incoming_week + 1;
                    $fields['comments_incoming_month'] = $stats->comments_incoming_month + 1;
                    $fields['comments_incoming_year'] = $stats->comments_incoming_year + 1;
                    $fields['comments_incoming_total'] = $stats->comments_incoming_total + 1;
                    break;
                case 'mention':
                    $fields['mentions_incoming_week'] = $stats->mentions_incoming_week + 1;
                    $fields['mentions_incoming_month'] = $stats->mentions_incoming_month + 1;
                    $fields['mentions_incoming_year'] = $stats->mentions_incoming_year + 1;
                    $fields['mentions_incoming_total'] = $stats->mentions_incoming_total + 1;
                    break;
            }
        }

        // Mettre à jour les statistiques
        $stats->update($fields);
    }

    public function updateLikes(Request $request)
    {
        // Validation des données entrantes
        $request->validate([
            'post_id' => 'required|string|max:50',
            'like_count' => 'required|integer|min:0',
        ]);

        $postId = $request->input('post_id');
        $newLikeCount = $request->input('like_count');

        // Recherche ou création du post
        $post = InstaPost::firstOrCreate(
            ['post_id' => $postId],
            ['like_count' => 0] // Valeur par défaut si le post est créé
        );

        // Ancienne valeur des likes
        $oldLikeCount = $post->like_count;

        // Mise à jour avec la nouvelle valeur
        $post->update([
            'like_count' => $newLikeCount,
            'last_checked' => now(),
        ]);

        // Réponse JSON avec l'ancienne valeur
        return response()->json([
            'post_id' => $postId,
            'old_like_count' => $oldLikeCount,
            'new_like_count' => $newLikeCount,
        ]);
    }
}

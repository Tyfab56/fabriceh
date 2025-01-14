<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstaInteractionStat extends Model
{
    use HasFactory;

    protected $primaryKey = 'stat_id';
    protected $table = 'InstaInteractionStats'; // Nom complet de la table avec le préfixe

    protected $fillable = [
        'follower_id',
        'week_start',
        'month_start',
        'year_start',
        'likes_outgoing_week',
        'comments_outgoing_week',
        'mentions_outgoing_week',
        'likes_outgoing_month',
        'comments_outgoing_month',
        'mentions_outgoing_month',
        'likes_outgoing_year',
        'comments_outgoing_year',
        'mentions_outgoing_year',
        'likes_outgoing_total',
        'comments_outgoing_total',
        'mentions_outgoing_total',
        'likes_incoming_week',
        'comments_incoming_week',
        'mentions_incoming_week',
        'likes_incoming_month',
        'comments_incoming_month',
        'mentions_incoming_month',
        'likes_incoming_year',
        'comments_incoming_year',
        'mentions_incoming_year',
        'likes_incoming_total',
        'comments_incoming_total',
        'mentions_incoming_total',
    ];

    public function follower()
    {
        return $this->belongsTo(InstaFollower::class, 'follower_id', 'follower_id');
    }
}

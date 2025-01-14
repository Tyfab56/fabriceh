<template>
    <section class="hero-section">
        <div class="hero-overlay">
            <h1 class="hero-top">Évitez les erreurs</h1>
            <h1 class="hero-title">Optimisez votre séjour en Islande</h1>
            <h1>en 30 minutes</h1>
            <p class="hero-subtitle">
                Bénéficiez d’un coaching sur mesure pour un itinéraire clair,
                des réponses précises et une sérénité totale.
            </p>
        </div>
    </section>
</template>

<script>
export default {
    name: "IslandCoachingHero",
};
</script>

<style scoped>
.hero-section {
    position: relative;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: url("/media/hero1.webp"); /* Replace with your image path */
    background-size: cover;
    background-position: center;
    filter: brightness(0.7); /* To make the image barely perceptible */
}

.hero-overlay {
    text-align: center;
    color: #fff;
    z-index: 1;
    padding: 0 20px;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 10px;
}
.hero-top {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.hero-subtitle {
    font-size: 1.2rem;
    margin-top: 0;
}

.hero-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
    z-index: 0;
}
</style>

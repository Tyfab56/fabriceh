/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import { createApp } from "vue";
import IslandCoachingHero from "./components/IslandCoachingHero.vue";

// Créez l'application Vue
const app = createApp({});

// Enregistrez le composant globalement
app.component("island-coaching-hero", IslandCoachingHero);

// Montez l'application sur l'élément `#app`
app.mount("#app");

<!-- resources/js/Pages/Formulaire.vue -->

<template>
    <div>
        <div v-if="questionsLoaded">
            <div v-if="questions && questions.length > 0">
                <div v-for="question in questions" :key="question.id">
                    <p>{{ question.content }}</p>
                    <!-- Ajoute d'autres éléments d'interface utilisateur pour les réponses, commentaires, etc. -->
                </div>
            </div>
            <div v-else>
                <p>Aucune question disponible.</p>
            </div>
        </div>
        <div v-else>
            <p>Chargement des questions...</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

// Définis les propriétés dont le composant a besoin
const props = defineProps(["form", "questions"]);

// Crée des refs pour les données du composant
const questions = ref([]); // Liste des questions récupérées depuis le backend
const questionsLoaded = ref(false); // Indicateur de chargement des questions

// Exécute du code après que le composant est monté
onMounted(async () => {
    // Vérifie si des questions ont été transmises depuis le contrôleur
    if (props.form && props.form.questions && props.form.questions.length > 0) {
        questions.value = props.form.questions;
        questionsLoaded.value = true;
    } else {
        console.error("Aucune question transmise depuis le contrôleur.");
    }
});
</script>

<style scoped>
/* Ajoutez ici vos styles CSS si nécessaire */
</style>

<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-700 to-purple-900 flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg">
      <h1 class="text-3xl font-bold mb-4">Formulaire</h1>
      <div class="flex flex-col items-center">
        <div v-if="questionsLoaded">
          <div v-if="questions && questions.length > 0">
            <div v-for="question in questions" :key="question.id" class="mb-4">
              <p class="font-semibold">{{ question.content }}</p>
              <textarea v-if="question.type_id === 1" rows="4" cols="50" v-model="responses[question.id]" class="mt-2"></textarea>
              <div v-if="question.type_id === 2">
                <label v-for="answer in answers[question.id]" :key="answer.id">
                  <input type="checkbox" :value="answer.id" v-model="responses[question.id][answer.id]">
                  {{ answer.content }}
                </label>
              </div>
              <div v-if="question.type_id === 3">
                <label v-for="answer in answers[question.id]" :key="answer.id">
                  <input type="radio" :value="answer.id" v-model="responses[question.id]">
                  {{ answer.content }}
                </label>
              </div>
              <!-- Espace pour le commentaire -->
              <textarea v-if="question.have_a_comment" rows="2" cols="50" v-model="comments[question.id]" placeholder="Commentaire" class="mt-2"></textarea>
            </div>
          </div>
          <div v-else>
            <p>Aucune question disponible.</p>
          </div>
        </div>
        <div v-else>
          <p>Chargement des questions...</p>
        </div>
        <div class="mt-6">
          <button @click="submitForm" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Envoyer
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

// Définis les propriétés dont le composant a besoin
const props = defineProps(["form", "questions", "answers"]);

// Crée des refs pour les données du composant
const questions = ref([]); // Liste des questions récupérées depuis le backend
const questionsLoaded = ref(false); // Indicateur de chargement des questions
const responses = ref({}); // Stocke les réponses de l'utilisateur
const comments = ref({}); // Stocke les commentaires de l'utilisateur

// Exécute du code après que le composant est monté
onMounted(async () => {
  // Vérifie si des questions ont été transmises depuis le contrôleur
  if (props.form && props.form.questions && props.form.questions.length > 0) {
    questions.value = props.form.questions;
    questionsLoaded.value = true;
    // Initialiser les réponses avec des valeurs vides pour chaque question
    questions.value.forEach(question => {
      // Si le type de question est 2 (checkbox), initialisez les réponses avec un objet vide
      if (question.type_id === 2) {
        responses.value[question.id] = {};
      } else {
        // Sinon, initialisez les réponses avec une chaîne vide
        responses.value[question.id] = "";
      }
      // Initialiser les commentaires avec une chaîne vide pour chaque question
      comments.value[question.id] = "";
    });
  } else {
    console.error("Aucune question transmise depuis le contrôleur.");
  }
});

// Fonction pour soumettre le formulaire
const submitForm = () => {
  // Envoyer les réponses et les commentaires à votre backend
  console.log("Réponses:", responses.value);
  console.log("Commentaires:", comments.value);
};
</script>

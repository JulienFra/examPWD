<template>
    <div>
        <h1>Formulaire d'évaluation</h1>

        <!-- Formulaire -->
        <form @submit.prevent="submitForm">
            <!-- Boucle sur chaque question -->
            <div v-for="question in questions" :key="question.id">
                <div>
                    <!-- Affichage de la question -->
                    <label>{{ question.content }}</label><br />

                    <!-- Champ de texte pour le commentaire si disponible -->
                    <textarea v-if="question.have_a_comment" v-model="comments[question.id]" cols="30" rows="3"></textarea><br />

                    <!-- Choix multiple -->
                    <div v-if="question.type === 'multiple_choice'">
                        <!-- Boucle sur chaque option de choix -->
                        <div v-for="option in question.multiple_answers" :key="option.id">
                            <input type="radio" :id="'option_' + option.id" :name="'question_' + question.id" :value="option.id" v-model="answers[question.id]" />
                            <label :for="'option_' + option.id">{{ option.content }}</label><br />
                        </div>
                    </div>

                    <!-- Champ de texte pour la saisie de réponse -->
                    <input v-else-if="question.type === 'text'" type="text" :id="'text_' + question.id" :name="'question_' + question.id" v-model="answers[question.id]" /><br />
                </div>
            </div>

            <!-- Bouton de soumission du formulaire -->
            <button type="submit">Soumettre</button>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    setup() {
        const { props } = usePage();
        const questions = ref(props.questions); // Liste des questions récupérées depuis le backend
        const answers = ref({}); // Réponses aux questions
        const comments = ref({}); // Commentaires sur les questions

        const submitForm = () => {
            // Rassemble les réponses et les commentaires pour soumission
            const formData = {
                answers: answers.value,
                comments: comments.value,
            };

            // Envoie les réponses au backend
            // Utilisez ici une requête HTTP (axios ou fetch) pour envoyer les données au backend
            // Example d'utilisation d'axios :
            // axios.post('/submit', formData)
            //   .then(response => {
            //     console.log(response.data);
            //   })
            //   .catch(error => {
            //     console.error(error);
            //   });
        };

        return {
            questions,
            answers,
            comments,
            submitForm,
        };
    },
};
</script>

<style scoped>
/* Ajoutez ici vos styles CSS si nécessaire */
</style>

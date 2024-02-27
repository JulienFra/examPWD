<template>
    <div>
        <!-- Vérification si les questions sont chargées -->
        <div v-if="questionsLoaded">
            <!-- Vérification si des questions sont disponibles -->
            <div v-if="questions && questions.length > 0">
                <!-- Affichage du formulaire -->
                <!-- ... -->
            </div>
            <!-- Si aucune question n'est disponible -->
            <div v-else>
                <p>Aucune question disponible.</p>
            </div>
        </div>
        <!-- Si les questions ne sont pas encore chargées -->
        <div v-else>
            <p>Chargement des questions...</p>
        </div>
    </div>
</template>


<script>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    setup() {
        const { props } = usePage();
        const questions = ref([]); // Liste des questions récupérées depuis le backend
        const questionsLoaded = ref(false); // Indicateur de chargement des questions
        const answers = ref({}); // Réponses aux questions
        const comments = ref({}); // Commentaires sur les questions

        onMounted(async () => {
            // Vérifie si des questions ont été transmises depuis le contrôleur
            if (props.questions && props.questions.length > 0) {
                questions.value = props.questions;
                questionsLoaded.value = true;
            } else {
                console.error("Aucune question transmise depuis le contrôleur.");
                console.log("Données reçues depuis le contrôleur : ", props.questions);
            }
        });

        const submitForm = () => {
            // Rassemble les réponses et les commentaires pour soumission
            const formData = {
                answers: answers.value,
                comments: comments.value,
            };

            console.log('Questions récupérées depuis le backend :', questions.value);

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
            questionsLoaded,
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

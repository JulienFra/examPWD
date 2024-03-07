<template>
    <div>
        <h1>Formulaire</h1>
        <div v-if="questionsLoaded">
            <div v-if="questions && questions.length > 0">
                <div v-for="question in questions" :key="question.id" class="mb-4">
                    <p class="font-semibold">{{ question.content }}</p>
                    <textarea v-if="question.type_id === 1" v-model="responses[question.id]" rows="4" cols="50" class="mt-2"></textarea>
                    <div v-if="question.type_id === 2">
                        <label v-for="answer in question.answers" :key="answer.id">
                            <input type="checkbox" :value="answer.id" v-model="responses[question.id][answer.id]">
                            {{ answer.content }}
                        </label>
                    </div>
                    <div v-if="question.type_id === 3">
                        <label v-for="answer in question.answers" :key="answer.id">
                            <input type="radio" :value="answer.id" v-model="responses[question.id]">
                            {{ answer.content }}
                        </label>
                    </div>
                    <textarea v-if="question.have_a_comment" v-model="comments[question.id]" rows="2" cols="50" placeholder="Commentaire" class="mt-2"></textarea>
                    <input type="hidden" name="question_id[]" :value="question.id">
                </div>
            </div>
            <div v-else>
                <p>Aucune question disponible.</p>
            </div>
        </div>
        <div v-else>
            <p>Chargement des questions...</p>
        </div>
        <!-- Ajout du champ student_course_id -->
        <input type="hidden" name="student_course_id" :value="studentCourse.id">
        <div class="mt-6">
            <button @click="submitForm" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Envoyer</button>
        </div>
    </div>
</template>

<script setup>
import { defineProps, ref, onMounted } from "vue";

const props = defineProps(["questions", "studentCourse"]);

const questionsLoaded = ref(false);
const responses = ref({});
const comments = ref({});
const studentCourse = ref(props.studentCourse); // Correction: initialisation de studentCourse

onMounted(() => {
    if (props.questions && props.questions.length > 0) {
        questionsLoaded.value = true;
        props.questions.forEach((question) => {
            if (question.type_id === 2) {
                // Correction: Initialisation des réponses pour les cases à cocher
                responses.value[question.id] = {};
            } else {
                responses.value[question.id] = "";
            }
            comments.value[question.id] = "";
        });
    } else {
        console.error("Aucune question transmise depuis le contrôleur.");
    }
});

const submitForm = () => {
    console.log("Données de réponse:", responses.value);
    console.log("Données de commentaire:", comments.value);

    const formData = new FormData();
    formData.append("student_course_id", studentCourse.value.id); // Correction: Accès à l'ID de studentCourse

    // Correction: Envoi des données correctement pour les cases à cocher
    Object.entries(responses.value).forEach(([questionId, response]) => {
        if (typeof response === "object") {
            Object.entries(response).forEach(([answerId, isChecked]) => {
                if (isChecked) {
                    formData.append(`responses[${questionId}][]`, answerId);
                }
            });
        } else {
            formData.append(`responses[${questionId}]`, response);
        }
    });

    Object.entries(comments.value).forEach(([key, value]) => {
        formData.append(`comments[${key}]`, value);
    });

    fetch(route("formulaire.store"), {
        method: "POST",
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Erreur lors de la soumission du formulaire");
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error(error.message);
    });
};
</script>

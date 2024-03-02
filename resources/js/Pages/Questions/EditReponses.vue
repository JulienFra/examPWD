<template>
    <div>
        <h1>Modifier les Réponses de la Question</h1>

        <form @submit.prevent="modifierReponses">
            <div>
                <label>Choix de Réponses:</label>
                <ul>
                    <li
                        v-for="(answer, index) in formUpdateQuestion.answers"
                        :key="index"
                    >
                        <input
                            v-model="answer.content"
                            type="text"
                            required
                            :placeholder="'Réponse ' + (index + 1)"
                        />
                        <button type="button" @click="retirerReponse(index)">
                            Retirer Réponse
                        </button>
                    </li>
                </ul>
                <button type="button" @click="ajouterReponse">
                    Ajouter Réponse
                </button>
            </div>

            <button type="submit">Modifier les Réponses</button>
        </form>

        <Link :href="route('questions.show', { id: question.id })">
            Retour à la page de la Question
        </Link>
    </div>
</template>

<script setup>
import { defineProps, ref } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const { question } = defineProps(["question"]);

const formUpdateQuestion = useForm("put", {
    answers: question.answers.map((answer) => ({ content: answer.content })),
});

const ajouterReponse = () => {
    formUpdateQuestion.answers.push({ content: "" });
};

const retirerReponse = (index) => {
    formUpdateQuestion.answers.splice(index, 1);
};

const modifierReponses = () => {
    formUpdateQuestion.put(route("questions.updateReponses", question), {
        preserveScroll: true,
        onSuccess: () => {
            // Vous pouvez également afficher un message de succès ici si nécessaire
            // Par exemple: toast.success('Réponses de la question mises à jour avec succès');
        },
    });
};
</script>

<template>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Modifier les Réponses de la Question</h1>

        <form @submit.prevent="modifierReponses" class="mb-4">
            <div class="mb-4">
                <label class="block mb-2">Choix de Réponses:</label>
                <ul>
                    <li v-for="(answer, index) in formUpdateQuestion.answers" :key="index" class="mb-2">
                        <input
                            v-model="answer.content"
                            type="text"
                            required
                            :placeholder="'Réponse ' + (index + 1)"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        />
                        <button type="button" @click="retirerReponse(index)" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Retirer Réponse
                        </button>
                    </li>
                </ul>
                <button type="button" @click="ajouterReponse" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Ajouter Réponse
                </button>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Modifier les Réponses
            </button>
        </form>

        <Link :href="route('questions.show', { id: question.id })" class="text-blue-500 hover:underline">
            Retour à la page de la Question
        </Link>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
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

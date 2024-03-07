<template>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Modifier le Contenu de la Question</h1>

        <form @submit.prevent="updateContenu" class="mb-4">
            <div class="mb-4">
                <label class="block mb-2">Contenu de la Question:</label>
                <textarea
                    v-model="formUpdateQuestion.content"
                    rows="3"
                    required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                ></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2">
                    <input
                        v-model="formUpdateQuestion.have_a_comment"
                        type="checkbox"
                        class="mr-2 leading-tight"
                    />
                    Commentaire:
                </label>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Modifier le Contenu
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
    content: question.content,
    have_a_comment: question.have_a_comment,
});

const updateContenu = () => {
    formUpdateQuestion.put(route("questions.updateContenu", question), {
        preserveScroll: true,
        onSuccess: () => {},
    });
};
</script>

<template>
    <div>
        <h1>Modifier le Contenu de la Question</h1>

        <form @submit.prevent="updateContenu">
            <div>
                <label>Contenu de la Question:</label>
                <textarea
                    v-model="formUpdateQuestion.content"
                    rows="3"
                    required
                ></textarea>
            </div>

            <div>
                <label>Commentaire:</label>
                <input
                    v-model="formUpdateQuestion.have_a_comment"
                    type="checkbox"
                />
            </div>

            <button type="submit">Modifier le Contenu</button>
        </form>

        <Link :href="route('questions.show', { id: question.id })">
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

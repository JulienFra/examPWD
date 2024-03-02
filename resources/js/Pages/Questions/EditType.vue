<template>
    <div>
        <h1>Changer le Type de la Question</h1>

        <form @submit.prevent="changerType">
            <div>
                <label>Type de la Question:</label>
                <select v-model="formUpdateQuestion.type_id" required>
                    <!-- Options pour les types de questions (à charger depuis votre backend) -->
                    <option
                        v-for="typeOption in types"
                        :key="typeOption.id"
                        :value="typeOption.id"
                    >
                        {{ typeOption.name }}
                    </option>
                </select>
            </div>

            <button type="submit">Changer le Type</button>
        </form>

        <Link :href="route('questions.show', { id: question.id })">
            Retour à la page de la Question
        </Link>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const { question, types } = defineProps(["question", "types"]);

const formUpdateQuestion = useForm("put", {
    type_id: question.type_id,
});

const changerType = () => {
    formUpdateQuestion.put(route("questions.updateType", question), {
        preserveScroll: true,
        onSuccess: () => {

        },
    });
};
</script>

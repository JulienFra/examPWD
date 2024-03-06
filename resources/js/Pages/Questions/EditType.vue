<template>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Changer le Type de la Question</h1>

        <form @submit.prevent="changerType" class="mb-4">
            <div class="mb-4">
                <label class="block mb-2">Type de la Question:</label>
                <select v-model="formUpdateQuestion.type_id" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
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

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Changer le Type
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

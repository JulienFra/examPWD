<template>
    <div
        class="min-h-screen bg-gradient-to-b from-blue-700 to-purple-900 flex justify-center items-center"
    >
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4">Détails de la Question</h1>
            <div>
                <p class="font-semibold">Contenu de la Question:</p>
                <p>{{ question.content }}</p>
            </div>
            <div class="mt-4">
                <p class="font-semibold">Type de la Question:</p>
                <p>{{ question.type.name }}</p>
            </div>
            <div v-if="question.type_id !== 1" class="mt-4">
                <p class="font-semibold">Choix:</p>
                <ul>
                    <li v-for="answer in question.answers" :key="answer.id">
                        {{ answer.content }}
                    </li>
                </ul>
            </div>
            <!-- Affiche la section Commentaire indépendamment de la valeur de have_a_comment -->
            <div class="mt-4">
                <p class="font-semibold">Commentaire:</p>
                <p>{{ question.have_a_comment ? "Oui" : "Non" }}</p>
            </div>
            <!-- Bouton de modification -->
            <Link
                :href="route('questions.editContenu', { id: question.id })"
                class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
            >
                Modifier la question
            </Link>
            <!-- Bouton de modification -->
            <Link
                :href="route('questions.editType', { id: question.id })"
                class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
            >
                Modifier le type
            </Link>
            <div v-if="question.type_id !== 1" class="mt-4">
                <Link
                    :href="route('questions.editReponses', { id: question.id })"
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                >
                    Modifier les réponses
                </Link>
            </div>
            <!-- Bouton de retour à la liste des questions -->
            <Link
                :href="route('questions.index')"
                class="mt-4 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600"
            >
                Retour à la liste des questions
            </Link>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";

const { question } = defineProps(["question"]);
</script>

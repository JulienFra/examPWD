<template>
    <div
        class="min-h-screen bg-gradient-to-b from-blue-700 to-purple-900 flex justify-center items-center"
    >
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4">Réponses du Cours</h1>
            <p class="font-semibold">Professeur: {{ teacher.name }}</p>
            <p class="font-semibold">Cours: {{ course.name }}</p>

            <h2 class="mt-4">Questions et Réponses</h2>
            <ul>
                <li v-for="question in questions" :key="question.id">
                    <h3 class="text-lg font-semibold">
                        {{ question.content }}
                    </h3>
                    <ul>
                        <li
                            v-for="(response, index) in getGroupedResponses(question.id)"
                            :key="index"
                        >
                            {{ response.response }} ({{ response.count }})
                            <span
                                v-if="response.comment"
                                class="text-gray-500 ml-2"
                                >({{ response.comment }})</span
                            >
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const { teacher, course, questions, responses } = defineProps([
    "teacher",
    "course",
    "questions",
    "responses",
]);

function getGroupedResponses(questionId) {
    const groupedResponses = {};
    const filteredResponses = responses.filter(
        (response) => response.question_id === questionId
    );

    // Compter les réponses identiques
    filteredResponses.forEach((response) => {
        const key = response.response + (response.comment ? "|" + response.comment : "");
        if (!groupedResponses[key]) {
            groupedResponses[key] = {
                response: response.response,
                comment: response.comment,
                count: 0,
            };
        }
        groupedResponses[key].count++;
    });

    // Convertir l'objet en tableau
    return Object.values(groupedResponses);
}
</script>

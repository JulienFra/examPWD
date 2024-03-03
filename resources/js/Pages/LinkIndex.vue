<template>
    <div
        class="min-h-screen bg-gradient-to-b from-blue-700 to-purple-900 flex justify-center items-center"
    >
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4">Liste des Cours</h1>

            <ul>
                <li v-for="course in finishedCourses" :key="course.id">
                    {{ course.name }}
                    <!-- Affiche les liens associés à ce cours -->
                    <ul>
                        <li
                            v-for="token in course.registeredTokens"
                            :key="token.id"
                        >
                            {{ token.token }}
                        </li>
                    </ul>
                </li>
            </ul>

            <h2 class="mt-4">Liste des Professeurs</h2>

            <ul>
                <li v-for="teacher in teachers" :key="teacher.id">
                    {{ teacher.name }}
                    <!-- Affiche le lien associé à ce professeur -->
                    <p>{{ teacher.token }}</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const { finishedCourses, teachers } = defineProps([
    "finishedCourses",
    "teachers",
]);
</script>

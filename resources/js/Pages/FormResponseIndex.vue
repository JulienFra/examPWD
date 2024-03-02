<!-- App/View/FormResponse/Index.vue -->

<template>
    <div
        class="min-h-screen bg-gradient-to-b from-blue-700 to-purple-900 flex justify-center items-center"
    >
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4">Réponses de Formulaire</h1>
            <p class="font-semibold">Professeur: {{ teacher.name }}</p>

            <h2 class="mt-4">Cours</h2>
            <ul>
                <li v-for="course in courses" :key="course.id">
                    <Link
                        :href="
                            route('course.responses', {
                                teacherToken: teacher.token,
                                courseId: course.id,
                            })
                        "
                        class="text-blue-500 hover:underline"
                    >
                        {{ course.name }}
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";

const { teacher, courses } = defineProps(["teacher", "courses"]);
</script>

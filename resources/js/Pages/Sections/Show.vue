<!-- resources/js/Pages/Sections/Show.vue -->

<template>
    <div>
        <h1>{{ section.name }}</h1>

        <div v-if="section.courses.length > 0">
            <h2>Cours dans cette section :</h2>
            <ul>
                <li v-for="course in section.courses" :key="course.id">
                    {{ course.name }} - {{ course.end_time }}

                    <!-- Affiche le nom du professeur -->
                    <div v-if="course.teacher">
                        <strong>Enseignant :</strong>
                        {{ course.teacher.name }}
                    </div>
                </li>
            </ul>
            <Link :href="route('courses.create', { id: section.id })"
                >Ajouter un cours</Link
            >
        </div>

        <Link :href="route('sections.index')"
            >Retour à la liste des sections</Link
        >
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Link } from "@inertiajs/vue3";

defineProps(["section"]);
</script>

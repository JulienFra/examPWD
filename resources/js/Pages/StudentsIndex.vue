<!-- resources/js/Pages/StudentsIndex.vue -->

<template>
    <div>
        <h1>Liste des Élèves</h1>
        <ul>
            <li v-for="student in students" :key="student.id">
                {{ student.name }} {{ student.surname }} -
                <Link :href="route('students.show', student.id)"
                    >Afficher les détails</Link
                >
            </li>
        </ul>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps(["students"]);
</script>

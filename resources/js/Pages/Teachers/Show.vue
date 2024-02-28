<!-- resources/js/Pages/Teachers/Show.vue -->

<template>
    <div>
        <h1>Détails de l'Enseignant</h1>

        <div>
            <p>Nom: {{ teacher.name }}</p>
            <!-- Ajoutez d'autres détails de l'enseignant en conséquence -->
        </div>
        <Link :href="route('teachers.edit', { id: teacher.id })"
            >Modifier les informations</Link
        >
        <Link :href="route('teachers.index')"
            >Retour à la liste des enseignants</Link
        >
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps(["teacher"]);
</script>

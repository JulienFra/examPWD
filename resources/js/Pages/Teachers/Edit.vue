<!-- resources/js/Pages/Students/Edit.vue -->

<template>
    <div>
        <h1>Modifier le professeur</h1>

        <form @submit.prevent="updateTeacher">
            <div>
                <label>Prénom:</label>
                <input v-model="formUpdateTeacher.name" type="text" required />
            </div>

            <!-- Bouton pour modifier les informations -->
            <button type="submit">Modifier le professeur</button>
        </form>

        <Link :href="route('teachers.show', { id: teacher.id })">
            Retour à la page du professeur
        </Link>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const { teacher } = defineProps(["teacher"]);

const formUpdateTeacher = useForm("put", {
    name: teacher.name,
});

const updateTeacher = () => {
    formUpdateTeacher.put(route("teachers.update", teacher), {
        preserveScroll: true,
        onSuccess: () => {},
    });
};
</script>

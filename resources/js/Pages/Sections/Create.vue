<!-- resources/js/Pages/Sections/Create.vue -->

<template>
    <div>
        <h1>Ajouter une Section</h1>
        <form @submit.prevent="createSection">
            <label>Nom de la section:</label>
            <input v-model="formCreateSection.name" type="text" required />

            <!-- Ajoute d'autres champs de formulaire si nécessaire -->

            <button type="submit">Ajouter</button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const formCreateSection = useForm({
    name: "",
    // Ajoute d'autres champs de formulaire si nécessaire
});

const createSection = () => {
    formCreateSection.post(route("sections.store"), {
        preserveScroll: true,
        onSuccess: () => {
            // Utilise window.location.href pour rediriger vers la liste des sections
            window.location.href = route("sections.index");
        },
    });
};
</script>

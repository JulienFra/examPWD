<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Ajouter une Section</h1>
        <form @submit.prevent="createSection" class="max-w-md">
            <div class="mb-4">
                <label for="section_name" class="block text-sm font-medium text-gray-700">Nom de la section:</label>
                <input v-model="formCreateSection.name" type="text" required id="section_name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <!-- Ajoute d'autres champs de formulaire si nécessaire -->

            <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Ajouter</button>
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

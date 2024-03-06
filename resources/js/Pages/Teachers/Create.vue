<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Ajouter un professeur</h1>

        <form @submit.prevent="createTeacher" class="max-w-md">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom prénom:</label>
                <input v-model="formCreateTeacher.name" type="text" id="name" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Ajouter</button>
        </form>

        <Link :href="route('teachers.index')" class="block mt-4 text-blue-600 hover:underline">
            Retour à la liste des professeurs
        </Link>
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const formCreateTeacher = useForm({
    name: "",
});

const createTeacher = () => {
    formCreateTeacher.post(route("teachers.store"), {
        preserveScroll: true,
        onSuccess: () => {
            window.location.href = route("teachers.index");
        },
    });
};
</script>

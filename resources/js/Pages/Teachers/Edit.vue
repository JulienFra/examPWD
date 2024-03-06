<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Modifier le professeur</h1>

        <form @submit.prevent="updateTeacher" class="max-w-md">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Prénom:</label>
                <input v-model="formUpdateTeacher.name" type="text" required id="name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Modifier le professeur</button>
        </form>

        <Link :href="route('teachers.show', { id: teacher.id })" class="block mt-4 text-blue-600 hover:underline">
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

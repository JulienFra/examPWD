<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Modifier l'étudiant</h1>

        <form @submit.prevent="updateStudent" class="mb-8">
            <div class="mb-4">
                <label for="name" class="block">Prénom:</label>
                <input v-model="formUpdateStudent.name" id="name" type="text" required class="border border-gray-300 px-4 py-2 rounded w-full" />
            </div>

            <div class="mb-4">
                <label for="surname" class="block">Nom:</label>
                <input v-model="formUpdateStudent.surname" id="surname" type="text" required class="border border-gray-300 px-4 py-2 rounded w-full" />
            </div>

            <div class="mb-4">
                <label for="email" class="block">Email:</label>
                <input v-model="formUpdateStudent.email" id="email" type="email" required class="border border-gray-300 px-4 py-2 rounded w-full" />
            </div>

            <!-- Bouton pour modifier les informations -->
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Modifier l'étudiant</button>
        </form>

        <Link :href="route('students.show', { id: student.id })" class="text-blue-500 hover:underline">Retour à la page de l'étudiant</Link>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const { student } = defineProps(["student"]);

const formUpdateStudent = useForm("put", {
    name: student.name,
    surname: student.surname,
    email: student.email,
});

const updateStudent = () => {
    formUpdateStudent.put(route("students.update", student), {
        preserveScroll: true,
        onSuccess: () => {},
    });
};
</script>

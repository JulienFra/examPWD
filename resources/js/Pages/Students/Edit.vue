<!-- resources/js/Pages/Students/Edit.vue -->

<template>
    <div>
        <h1>Modifier l'étudiant</h1>

        <form @submit.prevent="updateStudent">
            <div>
                <label>Nom:</label>
                <input v-model="formUpdateStudent.name" type="text" required />
            </div>

            <div>
                <label>Prénom:</label>
                <input
                    v-model="formUpdateStudent.surname"
                    type="text"
                    required
                />
            </div>

            <div>
                <label>Email:</label>
                <input
                    v-model="formUpdateStudent.email"
                    type="email"
                    required
                />
            </div>

            <!-- Bouton pour modifier les informations -->
            <button type="submit">Modifier l'étudiant</button>
        </form>

        <Link :href="route('students.show', { id: student.id })">
            Retour à la page de l'étudiant
        </Link>
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

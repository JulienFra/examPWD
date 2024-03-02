<template>
    <div>
        <h1>Ajouter un étudiant</h1>

        <form @submit.prevent="createStudent">
            <div>
                <label for="name">Prénom:</label>
                <input
                    v-model="formCreateStudent.name"
                    type="text"
                    id="name"
                    required
                />
            </div>

            <div>
                <label for="surname">Nom:</label>
                <input
                    v-model="formCreateStudent.surname"
                    type="text"
                    id="surname"
                    required
                />
            </div>

            <div>
                <label for="email">Email:</label>
                <input
                    v-model="formCreateStudent.email"
                    type="email"
                    id="email"
                    required
                />
            </div>

            <button type="submit">Ajouter</button>
        </form>

        <Link :href="route('students.index')"
            >Retour à la liste des étudiants</Link
        >
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const formCreateStudent = useForm({
    name: "",
    surname: "",
    email: "",
});

const createStudent = () => {
    formCreateStudent.post(route("students.store"), {
        preserveScroll: true,
        onSuccess: () => {
            window.location.href = route("students.index");
        },
    });
};
</script>

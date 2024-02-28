<template>
    <div>
        <h1>Ajouter un professeur</h1>

        <form @submit.prevent="createTeacher">
            <div>
                <label for="name">Prénom:</label>
                <input
                    v-model="formCreateTeacher.name"
                    type="text"
                    id="name"
                    required
                />
            </div>

            <button type="submit">Ajouter</button>
        </form>

        <Link :href="route('teachers.index')"
            >Retour à la liste des professeur</Link
        >
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

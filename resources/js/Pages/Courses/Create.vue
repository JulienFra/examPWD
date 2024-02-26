<!-- resources/js/Pages/Courses/Create.vue -->

<template>
    <div>
        <h1>Créer un nouveau cours pour {{ section.name }}</h1>

        <form @submit.prevent="createCourse">
            <label>Nom du cours:</label>
            <input v-model="formCreateCourse.name" type="text" required />

            <label>Date de fin:</label>
            <input v-model="formCreateCourse.end_time" type="date" required />

            <label>Enseignant:</label>
            <select v-model="formCreateCourse.teacher_id">
                <option value="">Aucun enseignant</option>
                <option
                    v-for="teacher in teachers"
                    :key="teacher.id"
                    :value="teacher.id"
                >
                    {{ teacher.name }}
                </option>
            </select>

            <button type="submit">Créer le cours</button>
        </form>

        <Link :href="route('sections.show', { id: section.id })">
            Retour à la section
        </Link>
    </div>
</template>

<script setup>
import { defineProps, ref } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const { section, teachers } = defineProps(["section", "teachers"]);

const formCreateCourse = useForm({
    name: "",
    end_time: "",
    teacher_id: null,
});

const createCourse = () => {
    formCreateCourse.post(route("courses.store", { sectionId: section.id }), {
        preserveScroll: true,
        onSuccess: () => {
            window.location.href = route("sections.show", { id: section.id });
        },
    });
};
</script>

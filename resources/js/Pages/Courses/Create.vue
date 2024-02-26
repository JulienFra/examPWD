<!-- resources/js/Pages/Courses/Create.vue -->

<template>
    <div>
        <h1>Créer un nouveau cours pour {{ section.name }}</h1>

        <form @submit.prevent="createCourse">
            <div>
                <label>Nom du cours:</label>
                <input v-model="formCreateCourse.name" type="text" required />
            </div>

            <div>
                <label>Date de fin:</label>
                <input
                    v-model="formCreateCourse.end_time"
                    type="date"
                    required
                />
            </div>

            <div>
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
            </div>

            <button type="submit">Créer le cours</button>
        </form>

        <Link :href="route('sections.show', { id: section.id })"
            >Retour à la section</Link
        >
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

defineProps(["section", "teachers"]);

const formCreateCourse = useForm({
    name: "",
    end_time: "",
    teacher_id: null,
    // Ajoute d'autres champs de formulaire si nécessaire
});

const createCourse = (sectionId) => {
    formCreateCourse
        .post(route("courses.store", { sectionId }), {
            preserveScroll: true,
        })
        .then(() => {
            // Utilise window.location.href pour rediriger vers la page de détails de la section
            window.location.href = route("sections.show", { id: sectionId });
        });
};
</script>

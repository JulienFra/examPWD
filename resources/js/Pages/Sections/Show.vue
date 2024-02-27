<!-- resources/js/Pages/Sections/Show.vue -->

<template>
    <div>
        <h1>{{ section.name }}</h1>

        <div v-if="section.courses.length > 0">
            <h2>Cours dans cette section :</h2>
            <ul>
                <li v-for="course in section.courses" :key="course.id">
                    {{ course.name }} - {{ course.end_time }}

                    <!-- Affiche le nom du professeur -->
                    <div v-if="course.teacher">
                        <strong>Enseignant :</strong>
                        {{ course.teacher.name }}
                    </div>

                    <!-- Ajout des boutons pour supprimer et modifier -->
                    <button @click="confirmDelete(course.id)">Supprimer</button>
                    <button @click="editCourse(course.id)">Modifier</button>
                </li>
            </ul>
        </div>
        <Link :href="route('courses.create', { id: section.id })"
            >Ajouter un cours</Link
        >

        <Link :href="route('sections.index')"
            >Retour à la liste des sections</Link
        >

        <!-- Modal de confirmation de suppression des cours -->
        <div v-if="confirmingCourseDeletion">
            <p>Voulez-vous vraiment supprimer ce cours?</p>
            <button @click="deleteCourse">Oui</button>
            <button @click="closeModal">Annuler</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const confirmingCourseDeletion = ref(false);
const courseIdToDelete = ref(null);
const formDeleteCourse = useForm("delete", {});

const confirmDelete = (id) => {
    courseIdToDelete.value = id;
    confirmingCourseDeletion.value = true;
};

const deleteCourse = () => {
    formDeleteCourse.delete(route("courses.destroy", courseIdToDelete.value), {
        preserveScroll: true,
        onSuccess: () => {
            confirmingCourseDeletion.value = false;
        },
    });
};

const closeModal = () => {
    confirmingCourseDeletion.value = false;
};

const editCourse = (id) => {
    // Rediriger vers la page de modification du cours avec l'ID du cours
    window.location.href = route("courses.edit", { courseId: id });
};

defineProps(["section"]);
</script>
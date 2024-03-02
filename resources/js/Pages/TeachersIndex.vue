<!-- resources/js/Pages/TeachersIndex.vue -->

<template>
    <div>
        <h1>Liste des Enseignants</h1>
        <ul>
            <li v-for="teacher in teachers" :key="teacher.id">
                {{ teacher.name }} -
                <Link :href="route('teachers.show', teacher.id)"
                    >Afficher les détails</Link
                >
                <button @click="confirmDelete(teacher.id)">Supprimer</button>
            </li>
        </ul>
        <Link :href="route('teachers.create')">Ajouter un Enseignant</Link>
        <!-- Modal de confirmation de suppression -->
        <div v-if="confirmingTeacherDeletion">
            <p>Voulez-vous vraiment supprimer cet enseignant?</p>
            <button @click="deleteTeacher">Oui</button>
            <button @click="closeModal">Annuler</button>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const confirmingTeacherDeletion = ref(false);
const teacherIdToDelete = ref(null);
const formDeleteTeacher = useForm("delete", {});

const confirmDelete = (id) => {
    teacherIdToDelete.value = id;
    confirmingTeacherDeletion.value = true;
};

const deleteTeacher = () => {
    formDeleteTeacher.delete(
        route("teachers.destroy", teacherIdToDelete.value),
        {
            preserveScroll: true,
            onSuccess: () => {
                confirmingTeacherDeletion.value = false;
            },
        }
    );
};

const closeModal = () => {
    confirmingTeacherDeletion.value = false;
};

defineProps(["teachers"]);
</script>

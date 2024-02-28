<!-- resources/js/Pages/StudentsIndex.vue -->

<!-- resources/js/Pages/StudentsIndex.vue -->

<template>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">Liste des Élèves</h1>
        <ul>
            <li v-for="student in students" :key="student.id" class="mb-4">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">{{ student.name }}</span>
                    <span class="font-semibold ml-2">{{
                        student.surname.toUpperCase()
                    }}</span>
                    <div class="flex items-center space-x-4">
                        <Link
                            :href="route('students.show', student.id)"
                            class="text-blue-600 hover:underline"
                        >
                            Afficher les détails
                        </Link>
                        <button
                            @click="confirmDelete(student.id)"
                            class="text-red-500 hover:underline"
                        >
                            Supprimer
                        </button>
                    </div>
                </div>
            </li>
        </ul>
        <Link
            :href="route('students.create')"
            class="text-green-500 hover:underline"
        >
            Ajouter un Élève
        </Link>
        <!-- Modal de confirmation de suppression -->
        <div
            v-if="confirmingStudentDeletion"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <p>Voulez-vous vraiment supprimer cet élève?</p>
                <div class="mt-4 space-x-4">
                    <button
                        @click="deleteStudent"
                        class="bg-red-500 text-white px-4 py-2 rounded-md"
                    >
                        Oui
                    </button>
                    <button
                        @click="closeModal"
                        class="bg-gray-400 text-white px-4 py-2 rounded-md"
                    >
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const confirmingStudentDeletion = ref(false);
const studentIdToDelete = ref(null);
const formDeleteStudent = useForm("delete", {});

const confirmDelete = (id) => {
    studentIdToDelete.value = id;
    confirmingStudentDeletion.value = true;
};

const deleteStudent = () => {
    formDeleteStudent.delete(
        route("students.destroy", studentIdToDelete.value),
        {
            preserveScroll: true,
            onSuccess: () => {
                confirmingStudentDeletion.value = false;
            },
        }
    );
};

const closeModal = () => {
    confirmingStudentDeletion.value = false;
};

defineProps(["students"]);
</script>

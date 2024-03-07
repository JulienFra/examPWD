<template>
    <AppLayout title="Liste des Enseignants">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">
                Liste des Enseignants
            </h2>
        </template>
        <div class="min-h-screen bg-gradient-to-b from-blue-700 to-purple-900 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-4">Liste des Enseignants</h1>
                <ul>
                    <li v-for="teacher in teachers" :key="teacher.id" class="mb-4">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold ml-1 mr-4">{{ teacher.name }}</span>
                            <div class="flex items-center space-x-4">
                                <Link :href="route('teachers.show', teacher.id)" class="text-blue-600 hover:underline">Afficher les détails</Link>
                                <button @click="confirmDelete(teacher.id)" class="text-red-500 hover:underline">Supprimer</button>
                            </div>
                        </div>
                    </li>
                </ul>
                <Link :href="route('teachers.create')" class="text-green-500 hover:underline">Ajouter un Enseignant</Link>
                <!-- Modal de confirmation de suppression -->
                <div v-if="confirmingTeacherDeletion" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                        <p>Voulez-vous vraiment supprimer cet enseignant?</p>
                        <div class="mt-4 space-x-4">
                            <button @click="deleteTeacher" class="bg-red-500 text-white px-4 py-2 rounded-md">Oui</button>
                            <button @click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded-md">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
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

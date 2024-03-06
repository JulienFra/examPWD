<template>
    <AppLayout title="Actions Administratives">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">
                Actions Administratives
            </h2>
        </template>
        <div class="min-h-screen bg-gradient-to-b from-blue-700 to-purple-900 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-4">Liste des Sections</h1>
                <ul>
                    <li v-for="section in sections" :key="section.id" class="mb-4">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold ml-1 mr-4">{{ section.name }}</span>
                            <div class="flex items-center space-x-4">
                                <Link :href="route('sections.show', section.id)" class="text-blue-600 hover:underline">Afficher les détails</Link>
                                <button @click="confirmDelete(section.id)" class="text-red-500 hover:underline">Supprimer</button>
                            </div>
                        </div>
                    </li>
                </ul>
                <Link :href="route('sections.create')" class="text-green-500 hover:underline">Ajouter une Section</Link>
                <div v-if="confirmingSectionDeletion" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                        <p>Voulez-vous vraiment supprimer cette section?</p>
                        <div class="mt-4 space-x-4">
                            <button @click="deleteSection" class="bg-red-500 text-white px-4 py-2 rounded-md">Oui</button>
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

const confirmingSectionDeletion = ref(false);
const sectionIdToDelete = ref(null);
const formDeleteSection = useForm("delete", {});

const confirmDelete = (id) => {
    sectionIdToDelete.value = id;
    confirmingSectionDeletion.value = true;
};

const deleteSection = () => {
    formDeleteSection.delete(
        route("sections.destroy", sectionIdToDelete.value),
        {
            preserveScroll: true,
            onSuccess: () => {
                confirmingSectionDeletion.value = false;
            },
        }
    );
};

const closeModal = () => {
    confirmingSectionDeletion.value = false;
};

defineProps(["sections"]);
</script>

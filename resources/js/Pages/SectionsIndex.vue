<!-- resources/js/Pages/SectionsIndex.vue -->

<template>
    <div>
        <h1>Liste des Sections</h1>
        <ul>
            <li v-for="section in sections" :key="section.id">
                {{ section.name }} -
                <Link :href="route('sections.show', section.id)"
                    >Afficher les détails</Link
                >
                <button @click="confirmDelete(section.id)">Supprimer</button>
            </li>
        </ul>
        <Link :href="route('sections.create')">Ajouter une Section</Link>
        <!-- Modal de confirmation de suppression -->
        <div v-if="confirmingSectionDeletion">
            <p>Voulez-vous vraiment supprimer cette section?</p>
            <button @click="deleteSection">Oui</button>
            <button @click="closeModal">Annuler</button>
        </div>
    </div>
</template>

<script setup>
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

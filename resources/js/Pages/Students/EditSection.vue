<!-- resources/js/Pages/Students/EditSection.vue -->

<template>
    <div>
        <h1>Modifier la section de {{ student.name }} {{ student.surname }}</h1>

        <form @submit.prevent="updateSection">
            <div>
                <label>Sélectionnez une ou plusieurs sections:</label>
                <div v-for="section in sections" :key="section.id">
                    <input
                        type="checkbox"
                        :id="`section_${section.id}`"
                        :value="section.id"
                        v-model="formUpdateSection.selectedSections"
                    />
                    <label :for="`section_${section.id}`">{{
                        section.name
                    }}</label>
                </div>
            </div>

            <button type="submit">Enregistrer</button>
        </form>

        <Link :href="route('students.show', { id: student.id })"
            >Retour à la page de l'étudiant</Link
        >
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const { student, sections } = defineProps(["student", "sections"]);

const formUpdateSection = useForm({
    selectedSections: student.sections.map((section) => section.id) || [],
});

const updateSection = () => {
    console.log(
        "Selected Sections Before:",
        formUpdateSection.selectedSections
    );

    formUpdateSection.put(route("students.updateSection", student), {
        preserveScroll: true,
        onSuccess: () => {
            console.log("Update successful!");
        },
    });
};
</script>

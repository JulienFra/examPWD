<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Modifier la section de {{ student.name }} {{ student.surname }}</h1>

        <form @submit.prevent="updateSection" class="mb-8">
            <div>
                <label class="block mb-2">Sélectionnez une ou plusieurs sections:</label>
                <div v-for="section in sections" :key="section.id" class="flex items-center mb-4">
                    <input
                        type="checkbox"
                        :id="`section_${section.id}`"
                        :value="section.id"
                        v-model="formUpdateSection.selectedSections"
                        class="mr-2"
                    />
                    <label :for="`section_${section.id}`" class="text-sm">{{ section.name }}</label>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Enregistrer</button>
        </form>

        <Link :href="route('students.show', { id: student.id })" class="text-blue-500 hover:underline">Retour à la page de l'étudiant</Link>
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
    console.log("Selected Sections Before:", formUpdateSection.selectedSections);

    formUpdateSection.put(route("students.updateSection", student), {
        preserveScroll: true,
        onSuccess: () => {
            console.log("Update successful!");

            if (formUpdateSection.selectedSections.length === 0) {
                formUpdateSection.selectedSections = ['Aucune section'];
            }

            const deselectedSections = sections.filter(section => !formUpdateSection.selectedSections.includes(section.id));

            deselectedSections.forEach(section => {
                section.courses.forEach(course => {
                    formUpdateSection.delete(route('courses.destroy', { id: course.id }), {
                        preserveScroll: true,
                        onSuccess: () => {
                            console.log("Course deletion successful!");
                        },
                    });
                });
            });
        },
    });
};
</script>

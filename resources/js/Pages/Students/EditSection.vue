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

            // Si aucune section n'est sélectionnée, attribuez la valeur par défaut "Aucune section"
            if (formUpdateSection.selectedSections.length === 0) {
                formUpdateSection.selectedSections = ['Aucune section'];
            }

            // Vérifiez si une section a été désélectionnée
            const deselectedSections = sections.filter(section => !formUpdateSection.selectedSections.includes(section.id));

            // Si une section a été désélectionnée, supprimez tous les cours liés à cette section
            deselectedSections.forEach(section => {
                section.courses.forEach(course => {
                    // Supprimez le cours
                    // Vous devrez peut-être ajuster cette partie pour l'adapter à votre code
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

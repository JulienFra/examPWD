<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Modifier les cours de {{ student.name }} {{ student.surname }}</h1>

        <form @submit.prevent="updateCourse" class="mb-8">
            <div v-for="course in courses" :key="course.id" class="flex items-center mb-4">
                <input
                    type="checkbox"
                    :id="`course_${course.id}`"
                    :value="course.id"
                    v-model="formUpdateCourse.selectedCourses"
                    class="mr-2"
                />
                <label :for="`course_${course.id}`" class="text-sm">{{ course.name }}</label>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Enregistrer</button>
        </form>

        <Link :href="route('students.show', { id: student.id })" class="text-blue-500 hover:underline">Retour à la page de l'étudiant</Link>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const { student, courses, selectedCourseIds } = defineProps([
    "student",
    "courses",
    "selectedCourseIds",
]);

const formUpdateCourse = useForm({
    selectedCourses: selectedCourseIds,
});

const updateCourse = () => {
    console.log("Selected courses Before:", formUpdateCourse.selectedCourses);
    formUpdateCourse.put(route("students.update-course", student), {
        preserveScroll: true,
        onSuccess: () => {
            console.log("Update successful!");
        },
    });
};
</script>

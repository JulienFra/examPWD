<template>
    <div>
        <h1>Modifier les cours de {{ student.name }} {{ student.surname }}</h1>

        <form @submit.prevent="updateCourse">
            <div v-for="course in courses" :key="course.id">
                <input
                    type="checkbox"
                    :id="`course_${course.id}`"
                    :value="course.id"
                    v-model="formUpdateCourse.selectedCourses"
                />
                <label :for="`course_${course.id}`">{{ course.name }}</label>
            </div>

            <button type="submit">Enregistrer</button>
        </form>

        <Link :href="route('students.show', { id: student.id })">
            Retour à la page de l'étudiant
        </Link>
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

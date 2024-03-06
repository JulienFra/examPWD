<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Créer un nouveau cours pour {{ section.name }}</h1>

        <form @submit.prevent="createCourse" class="max-w-md">
            <div class="mb-4">
                <label for="course_name" class="block text-sm font-medium text-gray-700">Nom du cours:</label>
                <input v-model="formCreateCourse.name" type="text" required id="course_name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="course_end_time" class="block text-sm font-medium text-gray-700">Date de fin:</label>
                <input v-model="formCreateCourse.end_time" type="date" required id="course_end_time" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="course_teacher" class="block text-sm font-medium text-gray-700">Enseignant:</label>
                <select v-model="formCreateCourse.teacher_id" id="course_teacher" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Aucun enseignant</option>
                    <option
                        v-for="teacher in teachers"
                        :key="teacher.id"
                        :value="teacher.id"
                    >
                        {{ teacher.name }}
                    </option>
                </select>
            </div>

            <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Créer le cours</button>
        </form>

        <Link :href="route('sections.show', { id: section.id })" class="block mt-4 text-blue-600 hover:underline">
            Retour à la section
        </Link>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const { section, teachers } = defineProps(["section", "teachers"]);

const formCreateCourse = useForm({
    name: "",
    end_time: "",
    teacher_id: null,
});

const createCourse = () => {
    formCreateCourse.post(route("courses.store", { sectionId: section.id }), {
        preserveScroll: true,
        onSuccess: () => {
            window.location.href = route("sections.show", { id: section.id });
        },
    });
};
</script>

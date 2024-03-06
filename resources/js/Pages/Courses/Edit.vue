<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Modifier le cours</h1>

        <form @submit.prevent="updateCourse" class="max-w-md">
            <div class="mb-4">
                <label for="course_name" class="block text-sm font-medium text-gray-700">Nom du cours:</label>
                <input v-model="formUpdateCourse.name" type="text" required id="course_name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="course_end_time" class="block text-sm font-medium text-gray-700">Date de fin:</label>
                <input v-model="formUpdateCourse.end_time" type="date" required id="course_end_time" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="course_teacher" class="block text-sm font-medium text-gray-700">Enseignant:</label>
                <select v-model="formUpdateCourse.teacher_id" required id="course_teacher" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
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

            <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Modifier le cours</button>
        </form>

        <Link :href="route('sections.index', { courseId: course.id })" class="block mt-4 text-blue-600 hover:underline">
            Retour aux détails du cours
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const { course, teachers } = defineProps(["course", "teachers"]);

const formUpdateCourse = useForm("put", {
    name: course.name,
    end_time: course.end_time,
    teacher_id: course.teacher_id,
});

const updateCourse = () => {
    formUpdateCourse.put(route("courses.update", course), {
        preserveScroll: true,
        onSuccess: () => {
            window.location.href = route("sections.index");
        },
    });
};
</script>

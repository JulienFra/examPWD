<!-- resources/js/Pages/Courses/Edit.vue -->

<template>
    <div>
        <h1>Modifier le cours</h1>

        <form @submit.prevent="updateCourse">
            <div>
                <label>Nom du cours:</label>
                <input v-model="formUpdateCourse.name" type="text" required />
            </div>

            <div>
                <label>Date de fin:</label>
                <input
                    v-model="formUpdateCourse.end_time"
                    type="date"
                    required
                />
            </div>

            <div>
                <label>Enseignant:</label>
                <select v-model="formUpdateCourse.teacher_id" required>
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

            <button type="submit">Modifier le cours</button>
        </form>

        <Link :href="route('sections.index', { courseId: course.id })">
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

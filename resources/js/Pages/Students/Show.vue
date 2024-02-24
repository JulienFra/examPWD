<template>
    <div>
        <h1>{{ student.name }} {{ student.surname }}</h1>
        <div v-if="student.sections.length">
            <h2>Sections :</h2>
            <ul>
                <li v-for="section in student.sections" :key="section.id">
                    {{ section.name }}
                    <h3>Cours :</h3>
                    <ul>
                        <li v-for="course in section.courses" :key="course.id">
                            {{ course.name }}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <Link :href="route('students.index')"
            >Retour à la liste des élèves</Link
        >
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

defineProps(["student"]);
</script>

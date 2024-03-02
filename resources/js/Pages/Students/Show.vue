<template>
    <div class="container mx-auto px-4 py-8">
      <div class="bg-white shadow-md rounded-md p-6">
        <h1 class="text-3xl font-bold mb-4">{{ student.name }} {{ student.surname }}</h1>
        <div v-if="student.sections" class="mb-6">
          <h2 class="text-xl font-semibold mb-2">Sections :</h2>
          <ul>
            <li v-for="section in student.sections" :key="section.id" class="mb-2">
              <span>{{ section.name }}</span>
            </li>
          </ul>
        </div>
        <div v-if="student.courses">
          <h2 class="text-xl font-semibold mb-2">Cours :</h2>
          <ul>
            <li v-for="course in student.courses" :key="course.id" class="mb-2">
              <span>{{ course.name }}</span>
            </li>
          </ul>
        </div>
        <div class="mt-6">
          <Link :href="route('students.edit', { id: student.id })" class="text-blue-600 hover:underline mr-4">
            Modifier les informations
          </Link>
          <Link :href="route('students.edit-section', { id: student.id })" class="text-blue-600 hover:underline mr-4">
            Modifier la section
          </Link>
          <Link :href="route('students.edit-course', { id: student.id })" class="text-blue-600 hover:underline">
            Modifier les cours
          </Link>
        </div>
      </div>
      <div class="mt-4">
        <Link :href="route('students.index')" class="text-blue-600 hover:underline">
          Retour à la liste des élèves
        </Link>
      </div>
    </div>
  </template>
  
  <script setup>
  import { Link } from "@inertiajs/vue3";
  
  defineProps(["student"]);
  </script>
  
  <style scoped>
  .container {
    max-width: 800px;
  }
  </style>
  
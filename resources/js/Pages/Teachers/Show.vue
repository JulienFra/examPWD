<template>
    <div class="container mx-auto px-4 py-8">
      <h1 class="text-3xl font-bold mb-4">Détails de l'Enseignant</h1>
  
      <div class="mb-4">
        <p class="text-lg font-medium">Nom: {{ teacher.name }}</p>
        <!-- Ajoutez d'autres détails de l'enseignant en conséquence -->
      </div>
  
      <div class="flex space-x-4">
        <Link :href="route('teachers.edit', { id: teacher.id })" class="text-blue-600 hover:underline">
          Modifier les informations
        </Link>
        <Link :href="route('teachers.index')" class="text-blue-600 hover:underline">
          Retour à la liste des enseignants
        </Link>
      </div>
    </div>
  </template>
  
  <script setup>
  import { Link } from "@inertiajs/vue3";
  defineProps(["teacher"]);
  </script>
  
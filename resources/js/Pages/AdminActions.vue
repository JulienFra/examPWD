<!-- resources/js/Pages/AdminActions.vue -->

<template>
    <AppLayout title="Actions Administratives">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Actions Administratives
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <!-- Contenu de la page -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">
                            Liste des élèves :
                        </h3>
                        <Link
                            :href="route('students.index')"
                            class="text-blue-600 hover:underline"
                            >Voir la liste des élèves</Link
                        >
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>

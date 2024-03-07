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
                        <!-- Utilise students.index au lieu de students.show -->
                        <Link
                            :href="route('students.index')"
                            class="text-blue-600 hover:underline"
                        >
                            Voir la liste des élèves
                        </Link>
                    </div>

                    <!-- Ajout du lien vers la liste des sections -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">
                            Liste des sections :
                        </h3>
                        <Link
                            :href="route('sections.index')"
                            class="text-blue-600 hover:underline"
                        >
                            Voir la liste des sections
                        </Link>
                    </div>

                    <!-- Ajout du lien vers la liste des enseignants -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">
                            Liste des enseignants :
                        </h3>
                        <Link
                            :href="route('teachers.index')"
                            class="text-blue-600 hover:underline"
                        >
                            Voir la liste des enseignants
                        </Link>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">
                            Liste des questions :
                        </h3>
                        <Link
                            :href="route('questions.index')"
                            class="text-blue-600 hover:underline"
                        >
                            Voir la liste des questions
                        </Link>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">
                            Lien à envoyer :
                        </h3>
                        <Link
                            :href="route('admin-actions.linkIndex')"
                            class="text-blue-600 hover:underline"
                        >
                            Voir la liste des liens à envoyer
                        </Link>
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

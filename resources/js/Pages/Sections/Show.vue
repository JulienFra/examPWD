<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ section.name }}</h1>

        <div v-if="section.courses.length > 0" class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Cours dans cette section :</h2>
            <ul>
                <li v-for="course in section.courses" :key="course.id" class="mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <span>{{ course.name }} - {{ course.end_time }}</span>

                            <!-- Affiche le nom du professeur -->
                            <div v-if="course.teacher" class="mt-2">
                                <strong>Enseignant :</strong>
                                <span>{{ course.teacher.name }}</span>
                            </div>
                        </div>
                        
                        <!-- Ajout des boutons pour supprimer et modifier -->
                        <div class="space-x-2">
                            <button @click="confirmDelete(course.id)" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Supprimer</button>
                            <button @click="editCourse(course.id)" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Modifier</button>
                            <div v-if="isEndTimePassed(course.end_time)">
                                <button v-if="!emailSent[course.id]" @click="sendEmail(course.id)" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Envoyer un e-mail</button>
                                <div v-else class="text-green-500">
                                    Formulaire envoyé aux élèves
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <Link :href="route('courses.create', { id: section.id })" class="text-blue-500 hover:underline block mb-4">Ajouter un cours</Link>
        <Link :href="route('sections.index')" class="text-blue-500 hover:underline">Retour à la liste des sections</Link>

        <!-- Modal de confirmation de suppression des cours -->
        <div v-if="confirmingCourseDeletion" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <p class="mb-4">Voulez-vous vraiment supprimer ce cours?</p>
                <div class="flex justify-center">
                    <button @click="deleteCourse" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 mr-2">Oui</button>
                    <button @click="closeModal" class="bg-gray-400 text-white py-2 px-4 rounded hover:bg-gray-500">Annuler</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const emailSent = ref({});

const confirmingCourseDeletion = ref(false);
const courseIdToDelete = ref(null);
const formDeleteCourse = useForm("delete", {});

const confirmDelete = (id) => {
    courseIdToDelete.value = id;
    confirmingCourseDeletion.value = true;
};

const deleteCourse = () => {
    formDeleteCourse.delete(route("courses.destroy", courseIdToDelete.value), {
        preserveScroll: true,
        onSuccess: () => {
            confirmingCourseDeletion.value = false;
        },
    });
};

const closeModal = () => {
    confirmingCourseDeletion.value = false;
};

const editCourse = (id) => {
    // Rediriger vers la page de modification du cours avec l'ID du cours
    window.location.href = route("courses.edit", { courseId: id });
};

// Vérifier si la date de fin du cours est dépassée
const isEndTimePassed = (endTime) => {
    return new Date(endTime) < new Date();
};

// Rediriger vers la page d'envoi d'e-mail
const sendEmail = (courseId) => {
    fetch(route('send.email', { courseId }), {
        method: 'GET',
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message); // Afficher le message de réponse
        emailSent.value = { ...emailSent.value, [courseId]: true }; // Mettre à jour l'état pour indiquer que l'e-mail a été envoyé pour ce cours
    })
    .catch(error => {
        console.error('Une erreur s\'est produite:', error);
        // Ajouter votre logique ici pour gérer les erreurs
    });
};

defineProps(["section"]);
</script>

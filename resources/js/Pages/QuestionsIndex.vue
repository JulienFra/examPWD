<template>
    <div
        class="min-h-screen bg-gradient-to-b from-blue-700 to-purple-900 flex justify-center items-center"
    >
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4">Liste des Questions</h1>
            <ul>
                <li
                    v-for="question in questions"
                    :key="question.id"
                    class="mb-4"
                >
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">{{
                            question.content
                        }}</span>
                        <div class="flex items-center space-x-4">
                            <Link
                                :href="route('questions.show', question.id)"
                                class="text-blue-600 hover:underline"
                                >Afficher les détails</Link
                            >
                            <button
                                @click="confirmDelete(question.id)"
                                class="text-red-500 hover:underline"
                            >
                                Supprimer
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            <Link
                :href="route('questions.create')"
                class="text-green-500 hover:underline"
                >Ajouter une Question</Link
            >

            <!-- Modal de confirmation de suppression -->
            <div
                v-if="confirmingQuestionDeletion"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
            >
                <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                    <p>Voulez-vous vraiment supprimer cette question?</p>
                    <div class="mt-4 space-x-4">
                        <button
                            @click="deleteQuestion"
                            class="bg-red-500 text-white px-4 py-2 rounded-md"
                        >
                            Oui
                        </button>
                        <button
                            @click="closeModal"
                            class="bg-gray-400 text-white px-4 py-2 rounded-md"
                        >
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const confirmingQuestionDeletion = ref(false);
const questionIdToDelete = ref(null);
const formDeleteQuestion = useForm("delete", {});

const confirmDelete = (id) => {
    questionIdToDelete.value = id;
    confirmingQuestionDeletion.value = true;
};

const deleteQuestion = async () => {
    await formDeleteQuestion.delete(
        route("questions.destroy", questionIdToDelete.value),
        {
            preserveScroll: true,
            onSuccess: () => {
                confirmingQuestionDeletion.value = false;
            },
        }
    );
};

const closeModal = () => {
    confirmingQuestionDeletion.value = false;
};

defineProps(["questions"]);
</script>

<template>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Ajouter une Nouvelle Question</h1>

        <form @submit.prevent="ajouterQuestion" class="mb-4">
            <div class="mb-4">
                <label class="block mb-2">Contenu de la Question:</label>
                <textarea
                    v-model="formCreateQuestion.content"
                    rows="3"
                    required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                ></textarea>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Ajouter la Question
            </button>
        </form>

        <Link :href="route('questions.index')" class="text-blue-500 hover:underline">
            Retour à la page d'Index des Questions
        </Link>
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const formCreateQuestion = useForm({
    content: "",
});

const ajouterQuestion = () => {
    formCreateQuestion.post(
        route("questions.store"),
        {
            content: formCreateQuestion.content,
        },
        {
            onSuccess: () => {
                // Vous pouvez également afficher un message de succès ici si nécessaire
                // Par exemple: toast.success('Question ajoutée avec succès');
                return redirect(route("questions.index"));
            },
        }
    );
};
</script>

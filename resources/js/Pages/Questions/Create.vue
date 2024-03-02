<template>
    <div>
        <h1>Ajouter une Nouvelle Question</h1>

        <form @submit.prevent="ajouterQuestion">
            <div>
                <label>Contenu de la Question:</label>
                <textarea
                    v-model="formCreateQuestion.content"
                    rows="3"
                    required
                ></textarea>
            </div>

            <button type="submit">Ajouter la Question</button>
        </form>

        <Link :href="route('questions.index')">
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

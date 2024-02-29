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

            <div>
                <label>
                    <input
                        v-model="formCreateQuestion.haveComment"
                        type="checkbox"
                    />
                    Avoir un Commentaire
                </label>
            </div>

            <button type="submit">Ajouter la Question</button>
        </form>

        <Link :href="route('questions.index')">
            Retour à la page d'Index des Questions
        </Link>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const formCreateQuestion = useForm({
    content: "",
    haveComment: false,
});

const ajouterQuestion = () => {
    formCreateQuestion.post(
        route("questions.store"),
        {
            content: formCreateQuestion.content,
            have_comment: formCreateQuestion.haveComment ? 1 : 0,
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

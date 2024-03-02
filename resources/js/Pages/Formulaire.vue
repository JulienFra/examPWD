<template>
    <div
        class="min-h-screen bg-gradient-to-b from-blue-700 to-purple-900 flex justify-center items-center"
    >
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4">Formulaire</h1>
            <div class="flex flex-col items-center">
                <div v-if="questionsLoaded">
                    <div v-if="questions && questions.length > 0">
                        <div
                            v-for="question in questions"
                            :key="question.id"
                            class="mb-4"
                        >
                            <p class="font-semibold">{{ question.content }}</p>
                            <textarea
                                v-if="question.type_id === 1"
                                rows="4"
                                cols="50"
                                v-model="responses[question.id]"
                                class="mt-2"
                            ></textarea>
                            <div v-if="question.type_id === 2">
                                <label
                                    v-for="answer in question.answers"
                                    :key="answer.id"
                                >
                                    <input
                                        type="checkbox"
                                        :value="answer.id"
                                        v-model="
                                            responses[question.id][answer.id]
                                        "
                                    />
                                    {{ answer.content }}
                                </label>
                            </div>
                            <div v-if="question.type_id === 3">
                                <label
                                    v-for="answer in question.answers"
                                    :key="answer.id"
                                >
                                    <input
                                        type="radio"
                                        :value="answer.id"
                                        v-model="responses[question.id]"
                                    />
                                    {{ answer.content }}
                                </label>
                            </div>
                            <!-- Espace pour le commentaire -->
                            <textarea
                                v-if="question.have_a_comment"
                                rows="2"
                                cols="50"
                                v-model="comments[question.id]"
                                placeholder="Commentaire"
                                class="mt-2"
                            ></textarea>
                        </div>
                    </div>
                    <div v-else>
                        <p>Aucune question disponible.</p>
                    </div>
                </div>
                <div v-else>
                    <p>Chargement des questions...</p>
                </div>
                <!-- Formulaire pour saisir le prompt -->
                <form @submit.prevent="submitPrompt" class="mt-6">
                    <label for="prompt" class="font-semibold"
                        >Enter your prompt:</label
                    >
                    <textarea
                        id="prompt"
                        v-model="prompt"
                        rows="4"
                        cols="50"
                        class="mt-2"
                    ></textarea>
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mt-4"
                    >
                        Generate Text
                    </button>
                </form>
                <!-- Affichage du texte généré -->
                <div v-if="generatedText" class="mt-6">
                    <h2 class="font-semibold">Generated Text:</h2>
                    <p>{{ generatedText }}</p>
                </div>
                <!-- Fin des modifications -->
                <button
                    @click="submitForm"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mt-6"
                >
                    Envoyer
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, ref, onMounted } from "vue";
import axios from "axios";

const props = defineProps(["questions", "answers"]);

const questionsLoaded = ref(false);
const responses = ref({});
const comments = ref({});
const prompt = ref(""); // Nouvelle variable pour stocker le prompt saisi
const generatedText = ref(""); // Nouvelle variable pour stocker le texte généré

onMounted(() => {
    if (props.questions && props.questions.length > 0) {
        questionsLoaded.value = true;
        props.questions.forEach((question) => {
            if (question.type_id === 2) {
                responses.value[question.id] = {};
            } else {
                responses.value[question.id] = "";
            }
            comments.value[question.id] = "";
        });
    } else {
        console.error("Aucune question transmise depuis le contrôleur.");
    }
});

const submitForm = () => {
    console.log("Réponses :", responses.value);
    console.log("Commentaires :", comments.value);
};

// Nouvelle fonction pour soumettre le prompt et générer le texte
const submitPrompt = async () => {
    try {
        const response = await axios.post("/generate-text", {
            prompt: prompt.value,
        });
        generatedText.value = response.data;
    } catch (error) {
        console.error("Error generating text:", error);
    }
};
</script>

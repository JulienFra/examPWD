<template>
    <div>
        <h1>Formulaire</h1>
        <form @submit.prevent="submitForm">
            <div v-if="questionsLoaded">
                <div v-if="questions && questions.length > 0">
                    <div
                        v-for="question in questions"
                        :key="question.id"
                        class="mb-4"
                    >
                        <p class="font-semibold">{{ question.content }}</p>
                        <div v-if="question.type_id === 1">
                            <textarea
                                v-model="responses[question.id]"
                                rows="4"
                                cols="50"
                                class="mt-2"
                            ></textarea>
                            <button
                                @click="paraphraseQuestion(question.id)"
                                class="mt-2"
                            >
                                Paraphraser
                            </button>
                            <p
                                v-if="paraphrasedResponses[question.id]"
                                class="italic"
                            >
                                Paraphrased:
                                {{ paraphrasedResponses[question.id] }}
                            </p>
                        </div>
                        <div v-else-if="question.type_id === 2">
                            <label
                                v-for="answer in question.answers"
                                :key="answer.id"
                            >
                                <input
                                    type="checkbox"
                                    :value="answer.id"
                                    v-model="responses[question.id]"
                                />
                                {{ answer.content }}
                            </label>
                        </div>
                        <div v-else-if="question.type_id === 3">
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
                        <textarea
                            v-if="question.have_a_comment"
                            v-model="comments[question.id]"
                            rows="2"
                            cols="50"
                            placeholder="Commentaire"
                            class="mt-2"
                        ></textarea>
                        <input
                            type="hidden"
                            name="question_id[]"
                            :value="question.id"
                        />
                    </div>
                </div>
                <div v-else>
                    <p>Aucune question disponible.</p>
                </div>
            </div>
            <div v-else>
                <p>Chargement des questions...</p>
            </div>
            <!-- Ajout du champ student_course_id -->
            <input
                type="hidden"
                name="student_course_id"
                :value="studentCourse.id"
            />
            <div class="mt-6">
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                >
                    Envoyer
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { defineProps, ref, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import axios from "axios";

const props = defineProps(["questions", "studentCourse"]);

const form = useForm({
    response: {},
    comment: {},
});

const questionsLoaded = ref(false);
const responses = ref({});
const comments = ref({});
const paraphrasedResponses = ref({});

onMounted(() => {
    if (props.questions && props.questions.length > 0) {
        questionsLoaded.value = true;
        props.questions.forEach((question) => {
            if (question.type_id === 2) {
                responses.value[question.id] = [];
            } else {
                responses.value[question.id] = "";
            }
            comments.value[question.id] = "";
            paraphrasedResponses.value[question.id] = "";
        });
    } else {
        console.error("Aucune question transmise depuis le contrôleur.");
    }
});

const submitForm = () => {
    form.post(
        route("formulaire.store"),
        {
            response: responses.value,
            comment: comments.value,
        },
        {
            preserveScroll: true,
            onSuccess: () => {
                // Affiche un message de succès si nécessaire
                // Par exemple: toast.success('Formulaire soumis avec succès');
            },
        }
    );
};

const paraphraseQuestion = async (questionId) => {
    try {
        const response = await axios.post(route("paraphrase.route"), {
            text: responses.value[questionId],
        });
        paraphrasedResponses.value[questionId] = response.data.paraphrase;
    } catch (error) {
        console.error(
            "Erreur lors de la paraphrase de la question ouverte",
            error
        );
    }
};
</script>

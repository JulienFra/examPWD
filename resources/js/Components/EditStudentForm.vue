<!-- resources/js/components/EditStudentForm.vue -->

<template>
    <form @submit.prevent="submitForm">
        <label for="name">Nom:</label>
        <input v-model="formData.name" type="text" id="name" required />

        <label for="surname">Prénom:</label>
        <input v-model="formData.surname" type="text" id="surname" required />

        <label for="email">Adresse e-mail:</label>
        <input v-model="formData.email" type="email" id="email" required />

        <h2>Sections :</h2>
        <ul>
            <li v-for="section in allSections" :key="section.id">
                <input
                    type="checkbox"
                    v-model="formData.sections"
                    :value="section.id"
                    :checked="formData.sections.includes(section.id)"
                />
                {{ section.name }}
            </li>
        </ul>

        <h3>Cours :</h3>
        <ul>
            <li v-for="section in selectedSections" :key="section.id">
                <strong>{{ section.name }}</strong>
                <ul>
                    <li v-for="course in section.courses" :key="course.id">
                        <input
                            type="checkbox"
                            v-model="formData.courses"
                            :value="course.id"
                            :checked="formData.courses.includes(course.id)"
                        />
                        {{ course.name }}
                    </li>
                </ul>
            </li>
        </ul>

        <button type="submit">Enregistrer</button>

        <div v-if="updateSuccess" class="success-message">
            Étudiant mis à jour
        </div>
        <div v-if="updateError" class="error-message">Erreur</div>

        <button @click="closeForm" type="button">Annuler</button>
    </form>
</template>

<script setup>
import { ref, defineProps, onMounted, onUnmounted } from "vue";

const { student, sections, courses, emit } = defineProps([
    "student",
    "sections",
    "courses",
]);

const formData = ref({
    name: student.name,
    surname: student.surname,
    email: student.email,
    sections: student.sections.map((section) => section.id),
    courses: student.courses.map((course) => course.id),
});

const allSections = ref([]);
const selectedSections = ref([]);

// Variables de données locales pour les messages
const updateSuccess = ref(false);
const updateError = ref(false);

onMounted(() => {
    // Obtiens toutes les sections et initialise les sections sélectionnées
    allSections.value = sections;
    selectedSections.value = sections.filter((section) =>
        formData.sections.includes(section.id)
    );
});

// Méthode pour mettre à jour les cours sélectionnés lorsque les sections changent
const updateSelectedCourses = () => {
    selectedSections.value = allSections.value.filter((section) =>
        formData.sections.includes(section.id)
    );
};

const submitForm = async () => {
    try {
        await updateStudent(student.id, formData);
        updateSuccess.value = true;
        // Réinitialise le message d'erreur
        updateError.value = false;
        emit("closeForm");
    } catch (error) {
        updateError.value = true;
        // Réinitialise le message de succès
        updateSuccess.value = false;
    }
};

const closeForm = () => {
    emit("closeForm");
};

onUnmounted(() => {
    // Réinitialise les messages lors du démontage du composant
    updateSuccess.value = false;
    updateError.value = false;
});
</script>

<style scoped>
.success-message {
    color: green;
    margin-top: 10px;
}

.error-message {
    color: red;
    margin-top: 10px;
}
</style>

<template>
    <div>
        <Head title="Ajouter Élève" />

        <form
            @submit.prevent="submitForm"
            class="border flex space-x-4 p-4 rounded"
        >
            <div class="flex-1">
                <input
                    class="block px-2 py-1.5 bg-gray-100 rounded w-full"
                    placeholder="Nom"
                    type="text"
                    v-model="form.name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="flex-1">
                <input
                    class="block px-2 py-1.5 bg-gray-100 rounded w-full"
                    placeholder="Prénom"
                    type="text"
                    v-model="form.surname"
                />
                <InputError :message="form.errors.surname" class="mt-2" />
            </div>

            <div class="flex-1">
                <input
                    class="block px-2 py-1.5 bg-gray-100 rounded w-full"
                    placeholder="Email"
                    type="email"
                    v-model="form.email"
                />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <div>
                <button
                    type="submit"
                    class="px-6 py-1.5 bg-indigo-600 rounded text-white"
                >
                    Suivant
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "./InputError.vue";

const form = useForm({
    name: "",
    surname: "",
    email: "",
});

const submitForm = () => {
    form.post(route("students.store"));
};
</script>

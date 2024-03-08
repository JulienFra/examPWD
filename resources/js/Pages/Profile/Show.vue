<template>
    <div class="max-w-lg mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
        <h1 class="text-2xl font-bold mb-6">Modifier le Mot de Passe</h1>
        <form @submit.prevent="updatePassword">
            <!-- Current Password -->
            <div class="col-span-6 sm:col-span-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                <input
                    type="password"
                    id="current_password"
                    v-model="form.current_password"
                    autocomplete="current-password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
                <InputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <!-- New Password -->
            <div class="col-span-6 sm:col-span-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                <input
                    type="password"
                    id="password"
                    v-model="form.password"
                    autocomplete="new-password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <!-- Confirm New Password -->
            <div class="col-span-6 sm:col-span-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                <input
                    type="password"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" :disabled="form.processing" class="bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 px-4 py-2 rounded-md text-white">
                    Enregistrer
                </button>
            </div>
        </form>
        <ActionMessage :on="form.recentlySuccessful" class="mt-4">
            Enregistré.
        </ActionMessage>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('user-password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

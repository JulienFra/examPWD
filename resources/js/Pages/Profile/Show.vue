<template>
    <div class="max-w-lg mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
        <h1 class="text-2xl font-bold mb-6">Modifier le Mot de Passe</h1>
        
        <form @submit.prevent="updatePassword">
            <div class="mb-4">
                <label for="currentPassword" class="block text-sm font-medium text-gray-700">Mot de passe actuel:</label>
                <input v-model="currentPassword" type="password" id="currentPassword" name="currentPassword" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="newPassword" class="block text-sm font-medium text-gray-700">Nouveau mot de passe:</label>
                <input v-model="newPassword" type="password" id="newPassword" name="newPassword" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe:</label>
                <input v-model="confirmPassword" type="password" id="confirmPassword" name="confirmPassword" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Modifier le mot de passe
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currentPassword: '',
            newPassword: '',
            confirmPassword: ''
        }
    },
    methods: {
        updatePassword() {
            // Add your logic to update the password here
            console.log('Current Password:', this.currentPassword);
            console.log('New Password:', this.newPassword);
            console.log('Confirm Password:', this.confirmPassword);
        }
    }
}
</script>

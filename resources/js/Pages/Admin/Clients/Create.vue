<template>
    <AppLayout title="Cadastrar Cliente">
        <div class="container mx-auto px-4 py-8">
            <div class="bg-gray-200 rounded-lg shadow-md overflow-hidden">
                <div class="w-full bg-gray-100 p-4 border-b border-gray-200">
                    <div class="font-bold">
                        <h1>Cadastrar Cliente</h1>
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form @submit.prevent="submit">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                                            <input type="text" name="name" v-model="form.name" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" name="email" v-model="form.email" id="email" autocomplete="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                                            <input type="text" cpf="cpf" v-model="form.cpf" id="cpf" autocomplete="cpf" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                                            <input type="password" name="password" v-model="form.password" id="password" autocomplete="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
    name: 'ProductCreate',
    components: {
        AppLayout
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                cpf: '',
                password: ''
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('admin.clients.store'))
        }
    }
}
</script>

<template>
    <WebLayout title="Produtos / Serviços">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    
                                    <table class="min-w-full">
                                        <thead class="border-b">
                                            <tr>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    #
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Produto
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Descrição
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Categoria
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Preço
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Ações
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="data.cart.length > 0">
                                            <tr v-for="product in data.cart" :key="product.id" class="border-b" >
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ product.name }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ product.description }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ product.category.name }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ product.price }}
                                                </td>
                                                <td class="text-sm text-red-900 font-light px-6 py-4 whitespace-nowrap flex">
                                                    <!-- <div class="bg-yellow-800 text-white mr-2 py-2 px-4 border border-blue-700 rounded">
                                                        <Link :href="route('admin.products.edit', product.id)">Editar</Link>
                                                    </div> -->
                                                    
                                                    <div class="bg-red-800 text-white py-2 px-4 border border-blue-700 rounded">
                                                        <Link :href="(route('cartDestroy', {id: product.id}))">Remover</Link>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                         <tbody v-else>
                                            <tr class="text-center">
                                                <td>Nenhum item no carrinho</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div>
                                        <form class="bg-green-800 text-white py-2 px-4 border border-blue-700 rounded"  @submit.prevent="submit">
                                            <input type="submit" value="Checkout"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </WebLayout>
</template>
<script>
import Pagination from "@/Shared/Pagination.vue";
import WebLayout from '@/Layouts/WebLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'
import _ from 'lodash'

export default {
    name: 'ProductList',
    components: {
        Pagination,
        WebLayout,
        Link
    },
    data() {
        return {
            form: this.$inertia.form({})
        }
    },            
    props: {
        data: Object,
    },

    methods: {
        submit() {
        this.form.post(this.route('cartFinish'))
        }
    }

}
</script>
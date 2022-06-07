
<template>
    <AppLayout title="Produtos / Serviços">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <div class="flex justify-between">
                                        <div class="input-group relative flex flex-wrap items-stretch w-5/4 mb-4">
                                            <input v-model="term" @keyup="search" type="search" class="form-control relative flex-auto sm:min-w-0 block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="button-addon3">
                                            <button @click.prevent="search" class="btn inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" type="button" id="button-addon3">Search</button>
                                        </div>
                                        <div class="float-right bg-gray-800 text-white  py-2 px-4 border border-blue-700 rounded">
                                            <Link :href="route('admin.products.create')">Novo Produto</Link>
                                        </div>
                                    </div>
                                    
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
                                        <tbody v-for="(product, index) in products.data" :key="index">
                                            <tr class="border-b" >
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
                                                    <div class="bg-yellow-800 text-white mr-2 py-2 px-4 border border-blue-700 rounded">
                                                        <Link :href="route('admin.products.edit', product.id)">Editar</Link>
                                                    </div>
                                                    <div class="bg-red-800 text-white py-2 px-4 border border-blue-700 rounded">
                                                        <Link method="delete" :href="route('admin.products.destroy', product.id)">Remover</Link>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <div class="px-6 pb-4 bg-white">
                                        <pagination :data="products" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import Pagination from "@/Shared/Pagination.vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'
import _ from 'lodash'

export default {
    name: 'ProductList',
    components: {
        Pagination,
        AppLayout,
        Link
    },
    data() {
        return {
            term: ''
        }
    },

    props: {
        products: Object,
    },
    
    methods: {
        search: _.throttle(function(){
            this.$inertia.replace(route('admin.products.index', {term:this.term}, { preserveState: true }))
        }, 500),
    }
    
}
</script>
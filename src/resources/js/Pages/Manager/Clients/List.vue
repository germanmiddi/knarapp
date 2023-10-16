
<template>
<!-- eslint-disable -->
    <div class="w-full" >
        <header class="">
            <div class="flex justify-between max-w-7xl mx-auto py-6 px-10">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Clientes
                </h2>
                <a class="btn-blue" :href="route('client.create')">
                    Nuevo Cliente
                </a>
            </div>
        </header>

        <Toast :toast="this.toastMessage" :type="this.labelType" @clear="clearMessage"></Toast>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div v-if="showToast" class="rounded-md bg-green-50 p-4 mb-5  ">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <CheckCircleIcon class="h-5 w-5 text-green-400" aria-hidden="true" />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ this.message }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button" @click="showToast = false"
                                class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
                                <span class="sr-only">Dismiss</span>
                                <XIcon class="h-5 w-5" aria-hidden="true" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <table class="w-full whitespace-nowrap">
                    <tr class="text-left font-bold bg-blue-500 text-white">
                        <th class="px-6 py-3 text-center">ID</th>
                        <th class="px-6 py-3 text-center">Nombre</th>
                        <th class="px-6 py-3 ">Contacto</th>
                        <th class="px-6 py-3 text-center">Acciones</th>
                    </tr>
                    <tr v-for="client in clients.data" :key="client.id"
                        class="hover:bg-gray-100 focus-within:bg-gray-100 text-sm ">
                        <td class="border-t px-6 py-4 text-center">
                            {{ client.id }}
                        </td>
                        <td class="border-t px-6 py-4 text-center">
                            {{ client.company_name }}
                        </td>

                        <td class="border-t px-6 py-4 text-center">
                            <div class="flex"> 
                                <PhoneIcon class="w-3 mr-2 text-blue-500"/> {{ client.phone }} </div>
                            <div class="flex"> 
                            <EnvelopeIcon class="w-3 mr-2 text-blue-500"/>{{ client.email }}</div>
                        </td>
                        <td class="border-t px-6 py-4 ">
                            <div class="flex items-center">   
                                <a type="button" :href="route('client.edit', client.id)" 
                                   class="inline-flex items-center px-2 py-1 border border-gray-200 rounded-md bg-gray-100 
                                        hover:bg-gray-300 text-gray-700">
                                    <PencilIcon class="h-4 w-4 mr-2" aria-hidden="true" />Editar</a>
                                <button class="ml-2 inline-flex items-center px-2 py-1 border border-gray-200 rounded-md bg-gray-100 
                                         hover:bg-gray-300 text-gray-700"
                                        @click="deleteClient(client)">
                                        <TrashIcon class="h-3 w-3  mr-2 " aria-hidden="true" /> Borrar </button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>



</template>
<script>

import { defineComponent } from 'vue'
import { PencilIcon,
         TrashIcon,
         PlusCircleIcon,
         XMarkIcon,
         CheckCircleIcon,
         ChevronRightIcon,
         PhoneIcon,
         EnvelopeIcon          
        } from '@heroicons/vue/24/outline';
import Toast from '@/Layouts/Components/Toast.vue';

import {
         TransitionRoot, 
         Dialog, 
         DialogOverlay, 
         TransitionChild, 
         DialogTitle, 
         
        //  Menu,
        //  MenuButton,
        //  MenuItem,
        //  MenuItems,
        } from '@headlessui/vue'


export default defineComponent({
    props: {
        toast: Object
    },
    components: {
        TrashIcon,
        PencilIcon,
        PlusCircleIcon,
        Toast,
        XMarkIcon,
        CheckCircleIcon,
        ChevronRightIcon,
        PhoneIcon,
        EnvelopeIcon,
        TransitionRoot, 
        Dialog, 
        DialogOverlay, 
        TransitionChild, 
        DialogTitle,        
    },
    data() {

        return {
            open: false,
            clients: {},
            toastMessage: "",
            labelType: "info",
            message: "",
            showToast: false,
        }
    },

    methods: {
        async getClients() {

            const get = `${route('clients.list')}`

            const response = await fetch(get, { method: 'GET' })
            this.clients = await response.json()

        },
        clearMessage() {
            this.toastMessage = ""
        },
        async deleteClient(client) {
            const response = await fetch(route('client.destroy'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(client)
            })

            if (response.ok) {
                this.getClients()
            } else {
                const responseData = await response.json();
                alert(responseData.message)
            }
        }

    },

    created() {
        this.getClients()
    },

})
</script>

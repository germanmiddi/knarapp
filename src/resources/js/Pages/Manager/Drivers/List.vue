
<template>
    <!-- eslint-disable -->
        <div class="w-full" >
            <header class="">
                <div class="flex justify-between max-w-7xl mx-auto py-6 px-10">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                        Choferes
                    </h2>
                    <a class="btn-blue" :href="route('driver.create')">
                        Nuevo Chofer
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
                            <th class="px-6 py-3 text-center">Tipo</th>
                            <th class="px-6 py-3 text-center">Nombre</th>
                            <th class="px-6 py-3 text-center">Vehículo</th>
                            <th class="px-6 py-3 ">Contacto</th>
                            <th class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                        <tr v-for="driver in drivers.data" :key="driver.id"
                            class="hover:bg-gray-50 focus-within:bg-gray-100 text-sm ">
                            <td class="border-t px-6 py-4 text-center">
                                {{ driver.id }}
                            </td>
                            <td class="border-t px-6 py-4 text-center">
                                {{ driver.driver_type }}
                            </td>
                            <td class="border-t px-6 py-4 text-center">
                                {{ driver.name }} {{ driver.lastname }}
                            </td>
                            <td class="border-t px-6 py-4 text-center">
                                {{ driver.vehicle }}
                            </td>    
    
                            <td class="border-t px-6 py-4 text-center">
                                <div class="flex"> 
                                    <PhoneIcon class="w-3 mr-2 text-blue-500"/> {{ driver.phone }} </div>
                                <div class="flex"> 
                                <EnvelopeIcon class="w-3 mr-2 text-blue-500"/>{{ driver.email }}</div>
                            </td>
                            <td class="border-t px-6 py-4 text-center">
                                <!-- <a type="button" :href="route('clients.edit', client.id)" -->
                                <a type="button" :href="route('driver.edit', driver.id)" 
                                    class="inline-flex items-center px-2 py-1 border border-gray-200 rounded-md text-gray-800 bg-gray-100 
                                            hover:bg-blue-400 hover:text-white" >
                                    <PencilIcon class="h-4 w-4  mr-2 " aria-hidden="true" />Editar</a>
                                
                                <!-- <a type="button" href="#" class="ml-2 inline-flex items-center p-1 border border-gray-200 rounded-md text-white bg-gray-100 
                                            hover:bg-gray-300">
                                    <ChevronRightIcon @click="open = true" class="h-4 w-4 text-gray-700" aria-hidden="true" /></a> -->
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
    
            const drivers = [
                { id: '1' ,
                driver_type: 'Empresa',
                driver_services: 'Translado, Excursión',
                vehicle: 'Mercedes Benz Sprinter',
                name: 'Jorge Machado',
                cellphone: '+54 9 1234 5678',
                email: 'jorgem@gmail.com'
                },
                { id: '2' ,
                driver_type: 'Particular',
                driver_services: 'Excursión',
                vehicle: 'Renaul Partner',
                name: 'Luis Apellido',
                cellphone: '+54 9 1234 5678',
                email: 'jorgem@gmail.com'   
                },
                { id: '3' ,
                driver_type: 'Empresa',
                driver_services: 'Translado',
                vehicle: 'Mercedes Benz Sprinter',
                name: 'Jose Sosa',
                cellphone: '+54 9 1234 5678',
                email: 'jorgem@gmail.com'
                },
                { id: '4' ,
                driver_type: 'Particular',
                driver_services: 'Translado, Excursión',
                vehicle: 'Chevrolet Spin',
                name: 'Joe Doe',
                cellphone: '+54 9 1234 5678',
                email: 'jorgem@gmail.com'
                },
                { id: '5' ,
                driver_type: 'Empresa',
                driver_services: 'Excursión',
                vehicle: 'Mercedes Benz Sprinter',
                name: 'Marcelo Perez',
                cellphone: '+54 9 1234 5678',
                email: 'jorgem@gmail.com'
                },
    
            ]
    
            return {
                open: false,
                drivers: [],
                toastMessage: "",
                labelType: "info",
                message: "",
                showToast: false,
            }
        },
        methods: {
            async getDrivers() {
    
                const get = `${route('drivers.list')}`
    
                const response = await fetch(get, { method: 'GET' })
                this.drivers = await response.json()
    
            },
            clearMessage() {
                this.toastMessage = ""
            },
        },
    
        created() {
            this.getDrivers()
        },
        // mounted() {
        //     if (this.toast) {
        //         if (this.toast['status'] == 200) {
        //             this.message = this.toast['message']
        //             this.showToast = true
        //         } else {
        //             this.labelType = "danger"
        //             this.toastMessage = this.toast['message']
        //         }
        //     }
        // }
    
    })
    </script>
    
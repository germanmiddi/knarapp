<template>
    <!-- eslint-disable -->
        <div class="w-full">
            <header class="">
                <div class="flex justify-between max-w-7xl mx-auto py-6 px-10">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
                       <ChevronLeftIcon class="w-5 mr-2 rounded-full hover:bg-white" @click="goBack" /> Choferes - Crear Chofer
                    </h2>
                    <button class="btn-blue" @click="submit">
                        Guardar
                    </button>
                </div>
            </header>
    
            <Toast :toast="this.toastMessage" :type="this.labelType" @clear="clearMessage"></Toast>
    
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">                        
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Información</h3>
                                    <p class="mt-1 text-sm text-gray-600">Indique los datos del chofer.</p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="#" method="POST">
                                    <div class="grid grid-cols-6 gap-6">
    
   
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="driver_types_id"
                                                class="block text-sm font-medium text-gray-700">Tipo Chofer</label>
                                            <select id="driver_types_id" name="driver_types_id" v-model="form.driver_types_id"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option v-for="type in DriverTypes" :key="type.id" :value="type.id">
                                                    {{ type.name }}</option>
                                            </select>
                                        </div>
    
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="fullname"
                                                class="block text-sm font-medium text-gray-700">Nombre</label>
                                            <input type="text" name="name" id="name" v-model="form.name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="fullname"
                                                class="block text-sm font-medium text-gray-700">Apellido</label>
                                            <input type="text" name="fullname" id="fullname" v-model="form.lastname"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
    
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="text" name="email" id="email" v-model="form.email"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
    
    
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="cellphone"
                                                class="block text-sm font-medium text-gray-700">Whatsapp / Celular</label>
                                            <input type="text" name="cellphone" id="cellphone"
                                                v-model="form.cellphone"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="address"
                                                class="block text-sm font-medium text-gray-700">Dirección</label>
                                            <input type="text" name="address" id="address"
                                                v-model="form.address"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="vehicle"
                                                class="block text-sm font-medium text-gray-700">Vehículo</label>
                                            <input type="text" name="vehicle" id="vehicle"
                                                v-model="form.vehicle"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
    
   
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="notes"
                                                class="block text-sm font-medium text-gray-700">Notas</label>
                                            <textarea type="text" rows=5 name="notes" id="notes"
                                                v-model="form.notes"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"> </textarea>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
     
            </div>
    
        </div> 
    </template>
    
    
    <script>
    
    import { defineComponent } from 'vue'
    import Icons from '@/Layouts/Components/Icons.vue'
    import Toast from '@/Layouts/Components/Toast.vue'
    // import GoogleMap from '../../../Layouts/Components/GoogleMap.vue'
    // import VueGoogleAutocomplete from "vue-google-autocomplete"
    import {
             ChevronLeftIcon
            } from '@heroicons/vue/24/outline'
    
    import { Inertia } from '@inertiajs/inertia';
    export default defineComponent({
        props: {
            DriverTypes:Object,
        },
    
        components: {
            Icons,
            Toast,
            ChevronLeftIcon,
            Inertia        
        },
    
        data() {
            return {
                form: {},
                toastMessage: ""
            }
        },
    
        methods: {
            goBack() {
               Inertia.visit(document.referrer);
            },
            clearMessage() {
                this.toastMessage = ""
            },
    
            submit() {
                this.$inertia.post(route('driver.store'), this.form)
            },
        },
        created() {
            //this.getCity()
        }
    })
    </script>
    
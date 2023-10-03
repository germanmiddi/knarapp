<template>
    <!-- eslint-disable -->
        <div class="w-full">
            <header class="">
                <div class="flex justify-between max-w-7xl mx-auto py-6 px-10">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
                       <ChevronLeftIcon class="w-5 mr-2 rounded-full hover:bg-white" @click="goBack" /> Choferes - Editar Chofer
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
                                            <label for="client_type_id"
                                                class="block text-sm font-medium text-gray-700">Tipo Chofer</label>
                                            <select id="client_type_id" name="client_type_id" v-model="form.driver_types_id"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option v-for="type in driverTypes" 
                                                             :key="type.id" 
                                                             :value="type.id"
                                                             :bind:select="type.id == form.driver_types_id" class="capitalize">
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

            <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-3">
                                <div class="px-4 sm:px-0 flex justify-between items-center mb-3">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Lista de Servicios</h3>
                                    <!-- <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 w-96  shadow-sm sm:text-sm border-gray-300 rounded-md"  placeholder="Buscar"/> -->
                                    <!-- <button @click.prevent="getAllServices" class="btn-blue">Tomar listas</button> -->
                                    <!-- <button class="btn-blue"> Nuevo Servicio</button> -->
                                </div>
                            </div>
                        </div>                        
                        <div class="md:col-span-3 mt-5">
                            <table class="w-full whitespace-nowrap">
                                <tr class="text-left font-bold bg-blue-500 text-white text-sm">
                                    <th class="px-6 py-3 text-center">Tipo</th>
                                    <th class="px-6 py-3 text-left">Detalle</th>
                                    <th class="px-6 py-3 text-center">Espera</th>
                                    <th class="px-6 py-3 text-center">Equipaje</th>
                                    <th class="px-6 py-3 text-center">Guia</th>
                                    <th class="px-6 py-3 text-center">Cant Pax</th>
                                    <th class="px-6 py-3 text-center">Duración</th>
                                    <th class="px-6 py-3 text-center">Costo</th>
                                    <th class="px-6 py-3 text-center">Activo</th>
                                    <!-- <th class="px-6 py-3 text-center">Acciones</th> -->
                                </tr>
                                <DriverServiceListItem v-for="service in serviceBase" 
                                                       :key="service.id" 
                                                       :driver_id="form.id"
                                                       :service=service 
                                                       @update-item="updateServiceList"
                                                       @toggle-active="toggleActiveService" 
                                                       @destroy-item="destroyItem" 
                                                       @toast-message="setMessage"/>                                                       
                                                       
                                
                            </table>
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
    import DriverServiceListItem from './DriverServiceListItem.vue' 
    // import GoogleMap from '../../../Layouts/Components/GoogleMap.vue'
    // import VueGoogleAutocomplete from "vue-google-autocomplete"
    import {
             ChevronLeftIcon
            } from '@heroicons/vue/24/outline'
    
    import { Inertia } from '@inertiajs/inertia';
    export default defineComponent({
        props: {
            driverTypes: Object,
            driver: Object,
            serviceBase: Object,
        },
    
        components: {
            Icons,
            Toast,
            ChevronLeftIcon,
            Inertia,
            DriverServiceListItem        
        },
    
        data() {
            return {
                form: {},
                toastMessage: "",
                labelType:    "info",   
                loadingActive: false,             
            }
        },
    
        methods: {
            goBack() {
               Inertia.visit(document.referrer);
            },
            setMessage(message){
                console.log(message)
                this.toastMessage = message.message;
                this.labelType = message.type;
            },            
            clearMessage() {
                this.toastMessage = ""
            },

            updateServiceList(data){
                console.log(data)
                this.serviceBase.forEach((item, index) => {
                    if (item.id == data.servicepricelistsbase_id) {
                        this.serviceBase[index].dsp_id        = data.id
                        this.serviceBase[index].dsp_price     = data.price
                        this.serviceBase[index].dsp_active    = data.active
                        this.serviceBase[index].dsp_driver_id = data.driver_id
                    }
                });
            },
            toggleActiveService(data){
                this.serviceBase.forEach((item, index) => {
                    if (item.dsp_id == data.dsp_id) {
                        this.serviceBase[index].dsp_active = data.dsp_active
                    }
                });
            },

            submit() {
                this.$inertia.post(route('driver.update'), this.form)
            },
        },
        created() {
            this.form = this.driver
        }
    })
    </script>
    
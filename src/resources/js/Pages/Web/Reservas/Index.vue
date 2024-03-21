<template>
    <!-- eslint-disable -->
    <div class="w-full">
        <header class="">
            <div class="flex justify-between max-w-7xl mx-auto py-6 px-10">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
                    <ChevronLeftIcon class="w-5 mr-2 rounded-full hover:bg-white" @click="goBack" /> Solicitudes - Crear
                    Solicitud
                </h2>
                <div class="space-x-2">
                    <button class="btn-blue" @click="submit">
                        Guardar
                    </button>

                </div>
            </div>
        </header>

        <Toast :toast="this.toastMessage" :type="this.labelType" @clear="clearMessage"></Toast>

        <div class="w-full">
            <div class="grid grid-cols-5 gap-4 max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="col-span-2">
                    <!-- Right column content -->
                    <div class="shadow bg-white sm:rounded-md px-4 py-5 sm:p-6 grid grid-cols-1 gap-6 mb-6">
                        
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Datos de pasajeros</h3>
                        <div class="">
                            <label for="pax_name"
                                class="block text-sm font-medium text-gray-700">Nombre Pasajero</label>
                            <input type="text" name="pax_name" id="pax_name"
                                v-model="form.pax_name"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="">
                            <label for="pax_email"
                                class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" name="pax_email" id="pax_email"
                                v-model="form.pax_email"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="border-t border-gray-200 ">  
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mt-8 mb-6">Servicios solicitados:</h3>
                        <div v-if="services.length == 0" >
                            <div class="text-sm text-gray-300">Aún no hay servicios creados</div>
                        </div>
                        
                        <div v-else>
                            <ServicesCard class="bg-white shadow sm:rounded-md px-4 py-5 sm:p-6 mb-4"
                                v-for="service in services" 
                                :key="service.id" 
                                :service="service" />
                        </div>
                    </div>
                </div>

                <div class="col-span-3">
                    <!-- Left column content -->
                    <div class="shadow sm:rounded-md px-4 py-5 bg-white sm:p-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Ingrese el Servicio</h3>
                        <ServicesForm 
                            :serviceTypes="service_types"
                            :locations="locations" 
                            @createService="createService"
                            @updateService="updateService" 
                            
                            />
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>


<script>

import { defineComponent, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia';

import Icons from '@/Layouts/Components/Icons.vue'
import Toast from '@/Layouts/Components/Toast.vue'
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

import ServicesForm from './ServicesForm.vue'
import ServicesCard from './ServicesCard.vue'

import {
    ChevronLeftIcon,
    PencilIcon,
    TrashIcon
} from '@heroicons/vue/24/outline'


export default defineComponent({
    props: {
        locations: Object,
        service_types: Object
    },

    components: {
        Icons,
        Toast,
        PencilIcon,
        TrashIcon,
        ChevronLeftIcon,
        Inertia,
        Datepicker,
        ServicesForm,
        ServicesCard
    },

    setup() {

        const format = (date) => {
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            return `${day}/${month}/${year}`;
        }

        // const startTime = ref({ hours: 9, minutes: 0 });

        return {
            format,
            // startTime
        }
    },


    data() {

        return {
            form: {},
            toastMessage: "",
            showNewService: true,
            services: [],
            serviceUpdate: {},
            serviceUpdateIndex: "",
            servicesTypesLoading: false

        }
    },

    methods: {

        updateService(service) {
            console.log(service)
            this.services[this.serviceUpdateIndex] = service
            this.serviceUpdateIndex = ""
            this.serviceUpdate = {}
        },

        fillUpdateService(service) {
            console.log(service)
            this.serviceUpdateIndex = this.services.indexOf(service)
            this.serviceUpdate = service
            this.showNewService = true
        },

        deleteService(service) {

            let index = this.services.indexOf(service)
            this.services.splice(index, 1)
        },

        createService(service) {
            console.log(service)
            this.services.push(service)

        },

        getServices() { },

        goBack() {
            Inertia.visit(document.referrer);
        },

        clearMessage() {
            this.toastMessage = ""
        },

        submit() {
            this.form.services = this.services
            this.$inertia.post(route('reservas.store'), this.form)
        },
    },
})
</script>
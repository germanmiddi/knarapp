<template>
<!-- eslint-disable -->
    <div class="w-full">
        <header class="">
            <div class="flex justify-between max-w-7xl mx-auto py-6 px-10">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
                   <ChevronLeftIcon class="w-5 mr-2 rounded-full hover:bg-white" @click="goBack" /> Solicitudes - Crear Solicitud
                </h2>
                <div class="space-x-2" >
                    <!-- <button class="btn-blue" @click="showNewService = !showNewService">
                        Agregar Servicio
                    </button> -->
                    <button class="btn-blue" @click="submit" >
                        Guardar
                    </button>

                </div>
            </div>
        </header>

        <Toast :toast="this.toastMessage" :type="this.labelType" @clear="clearMessage"></Toast>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">                        
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Datos Generales</h3>
                                    <p class="mt-1 text-sm text-gray-600">Indique los datos generales del servicio.</p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="#" method="POST">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="client_type"
                                                class="block text-sm font-medium text-gray-700">Cliente</label>
                                            <select id="client_type" name="client_type" v-model="form.client_id"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option disabled value="">Seleccione un Cliente</option>
                                                <option v-for="client in clients" :key="client.id" :value="client.id">
                                                    {{ client.company_name }}
                                                </option>

                                            </select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="responsible"
                                                class="block text-sm font-medium text-gray-700">Responsable</label>
                                            <input type="text" name="responsible" id="responsible" v-model="form.responsible"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="observations"
                                                class="block text-sm font-medium text-gray-700">Notas</label>
                                            <textarea type="text" rows=5 name="observations" id="observations"
                                                v-model="form.observations"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"> </textarea>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Servicios</h3>
                                    <p class="mt-1 text-sm text-gray-600">Detalle de los servicios requeridos.</p>
                                </div>
                            </div>

                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <div class="w-full flex justify-end">
                                    <button class="btn-blue" @click="addService">
                                        Agregar Servicio
                                    </button>
                                </div>

                            </div>

                            <div class="md:col-span-3">
                                <FormServices :service="service"
                                          :locations="locations" 
                                          :client="form.client_id" 
                                          @createService="createService"/>
                            </div>

                            <div class="md:col-span-3">
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                    <div class="px-4 py-5 sm:px-6">
                                      <h3 class="text-lg leading-6 font-medium text-gray-900">Servicio nro: 1</h3>
                                    </div>
                                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                      <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                        <div class="sm:col-span-1">
                                          <dt class="text-sm font-medium text-gray-500">Full name</dt>
                                          <dd class="mt-1 text-sm text-gray-900">Margot Foster</dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                          <dt class="text-sm font-medium text-gray-500">Application for</dt>
                                          <dd class="mt-1 text-sm text-gray-900">Backend Developer</dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                          <dt class="text-sm font-medium text-gray-500">Email address</dt>
                                          <dd class="mt-1 text-sm text-gray-900">margotfoster@example.com</dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                          <dt class="text-sm font-medium text-gray-500">Salary expectation</dt>
                                          <dd class="mt-1 text-sm text-gray-900">$120,000</dd>
                                        </div>
                                        <div class="sm:col-span-2">
                                          <dt class="text-sm font-medium text-gray-500">About</dt>
                                          <dd class="mt-1 text-sm text-gray-900">Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.</dd>
                                        </div>

                                      </dl>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                </div>
            </div>
 
        </div>

         <!-- <Services v-for="(service, index) in services" :key="index"
                  :service="service"
                  :locations="locations" 
                  :client="form.client_id" 
                  @createService="createService"  /> -->
    </div> 
</template>


<script>

import { defineComponent, ref } from 'vue'
import Icons from '@/Layouts/Components/Icons.vue'
import Toast from '@/Layouts/Components/Toast.vue'
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import FormServices from '@/Pages/Manager/Requests/FormServices.vue'

import {
         ChevronLeftIcon
        } from '@heroicons/vue/24/outline'

import { Inertia } from '@inertiajs/inertia';
export default defineComponent({
    props: {
        clients: Object,
        locations: Object,
    },

    components: {
        Icons,
        Toast,
        ChevronLeftIcon,
        Inertia,
        Datepicker,
        FormServices                
    },

    setup() {

        const format = (date) => {
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            return `${day}/${month}/${year}`;
        }

        const startTime = ref({ hours: 9, minutes: 0 });

        return {
            format,
            startTime
        }
    },


    data() {
    
        return {
            form: {},
            toastMessage: "",
            showNewService: false,
            services:[],      

        }
    },

    methods: {
        formatDate(date) {
            const formattedDate = new Date(date).toLocaleDateString('es-AR', {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric'
            });
            return formattedDate;
        },

        formatTime(time) {
            const formattedTime = new Date(`1970-01-01T${time}`).toLocaleTimeString('es-AR', {
                hour: 'numeric',
                minute: 'numeric'
            });
            return formattedTime;
        },        

        addService() {
            this.services.push({})
        },

        getServices(){
        },

        goBack() {
           Inertia.visit(document.referrer);
        },
        clearMessage() {
            this.toastMessage = ""
        },

        submit() {
            this.$inertia.post(route('request.store'), this.form)
        },
    },
    created() {
        //this.getCity()
    }
})
</script>

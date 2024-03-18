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
    
            <div class="max-w-7xl mx-auto pt-10 pb-60 sm:px-6 lg:px-8">
                <div class="shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">                        
                        <!-- <div class="border-b border-gray-900/10 pb-12">
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
                                                    @change="getServicesTypes"
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
                        </div> -->
    
                        <div class="pt-8">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">Servicios</h3>
                                        <p class="mt-1 text-sm text-gray-600">Detalle de los servicios requeridos.</p>
                                    </div>
                                </div>
    
                                <div class="mt-5 md:mt-0 md:col-span-2">
    
                                    <Services v-show="showNewService" 
                                             :locations="locations" 
                                             :client="form.client_id" 
                                             :serviceTypes="service_types"
                                             :servicesTypesLoading="servicesTypesLoading"
                                             :service="serviceUpdate"
                                             @createService="createService"
                                             @updateService="updateService"  />
    
                                    <div v-for="service in services" :key="service.id" class="bg-gray-50 sm:rounded-lg">
                                        <div class="px-4 py-5 sm:px-6 mt-8">
                                            
                                            <div class="flex items-center justify-between mb-8">
                                                <div>
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{service.service.name}}</h3>
                                                    <div class="mt-1 max-w-2xl text-sm text-gray-500">Fecha: {{formatDate(service.date)}} - Hora: {{ formatTime(service.time) }}</div>
                                                </div> 
                                                <div class="flex items-center">
                                                    <button @click="fillUpdateService(service)" ><PencilIcon class="w-5 text-blue-500" /></button>
                                                    <button class="ml-2" @click="deleteService(service)"><TrashIcon class="w-5 text-red-500" /></button>
                                                </div>
                                            </div>
                                            
                                        
                                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
                                                <div class="col-span-3">
                                                    <div class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                                        <div class="sm:col-span-1">
                                                            <dt class="text-sm font-medium text-gray-500">Origen</dt>
                                                            <dd class="mt-1 text-sm text-gray-900">{{service.location_from}}</dd>
                                                        </div>
                                                        <div class="sm:col-span-1">
                                                            <dt class="text-sm font-medium text-gray-500">Destino</dt>
                                                            <dd class="mt-1 text-sm text-gray-900">{{service.location_to}}</dd>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="sm:col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">Guia</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">
                                                        {{service.guia == 1 ? 'Con Guia' : 'Sin Guia'}}
                                                    </dd>
                                                </div>
                                                <div class="sm:col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">Nombre Guia</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{service.guide_name}}</dd>
                                                </div>
                                                <div class="sm:col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">Nro Vuelo</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{service.flight_number}}</dd>
                                                </div>
                                                <div class="sm:col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">Pasajeros</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{service.cant_pax}}</dd>
                                                </div>
                                                <div class="sm:col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">Equipaje</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ service.equipaje == 1 ? 'Con Equipaje' : 'Sin Equipaje' }}</dd>
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
        </div> 
    </template>
    
    
    <script>
    
    import { defineComponent, ref } from 'vue'
    import Icons from '@/Layouts/Components/Icons.vue'
    import Toast from '@/Layouts/Components/Toast.vue'
    import Datepicker from '@vuepic/vue-datepicker'
    import '@vuepic/vue-datepicker/dist/main.css'
    import Services from './Services.vue'
    
    import { ChevronLeftIcon,
             PencilIcon,
             TrashIcon
            } from '@heroicons/vue/24/outline'
    
    import { Inertia } from '@inertiajs/inertia';
    export default defineComponent({
        props: {
            // clients: Object,
            locations: Object,
            servicepricelist: Object,
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
            Services                
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
                services:[],
                serviceUpdate: {},
                serviceUpdateIndex: "",
                services_types: [],
                servicesTypesLoading: false
                // services: [{
                //             // "date":"[native Date Thu May 11 2023 14:26:00 GMT-0300 (Argentina Standard Time)]",
                //             // "time":{"hours":9,"minutes":0,"seconds":0},"cant_pax":3,"guia":"1","equipaje":"1",
                //             // "service":{"id":30,"client_id":1,"detail":"Transfer Ezeiza / Palermo o Viceversa","type":"TRF VAN","wait_time":1,"baggage":true,"guide":true,"passenger_capacity":6,"duration":null,"price":137,"active":true,"created_by":1,"deleted_at":null,"created_at":null,"updated_at":null},
                //             // "guide_name":"asdasd",
                //             // "flight_number":"asdasd",
                //             // "location_from":"Aeropuerto Internacional Ministro Pistarini (Ezeiza)",
                //             // "location_to":"Hotel Pulitzer Buenos Aires"
                //         }],
    
                
    
            }
        },
    
        methods: {
    
            updateService(service){
                console.log(service)
                this.services[this.serviceUpdateIndex] = service
                this.serviceUpdateIndex = ""
                this.serviceUpdate = {}
            },
    
            fillUpdateService(service){
                console.log(service)
                this.serviceUpdateIndex = this.services.indexOf(service)
                this.serviceUpdate = service
                this.showNewService = true
            },
    
            deleteService(service){
    
                let index = this.services.indexOf(service)
                this.services.splice(index, 1)
            },
            
            async getServicesTypes(){
    
                this.servicesTypesLoading = true
                let get = `${route('services.get_services_types_by_client')}?client_id=${this.form.client_id}`  ;
                
                let response = await fetch(get, {method: 'GET'})             
    
                if (response.status == 200){
                    this.services_types = await response.json()
                    console.log(this.services_types)
                }
                this.servicesTypesLoading = false
            },
    
            formatDate(date) {
                const formattedDate = new Date(date).toLocaleDateString('es-AR', {
                    year: 'numeric',
                    month: 'numeric',
                    day: 'numeric'
                });
                return formattedDate;
            },
    
            formatTime(time) {
                // Obtiene las horas, minutos y segundos de la variable
                const { hours, minutes } = time;
    
                // Formatea las horas y minutos a dos dígitos con ceros iniciales
                const formattedHours = String(hours).padStart(2, '0');
                const formattedMinutes = String(minutes).padStart(2, '0');
    
                // Retorna la hora formateada como "hh:mm"
                return `${formattedHours}:${formattedMinutes}`;
            },
    
            // formatTime(time) {
            //     const formattedTime = new Date(`1970-01-01T${time}`).toLocaleTimeString('es-AR', {
            //         hour: 'numeric',
            //         minute: 'numeric'
            //     });
            //     return formattedTime;
            // },        
    
            createService(service) {    
                console.log(service)
                this.services.push(service)
    
            },
    
            getServices(){},
    
            goBack() {
               Inertia.visit(document.referrer);
            },
    
            clearMessage() {
                this.toastMessage = ""
            },
    
            submit() {
                this.form.services = this.services
                this.$inertia.post(route('request.store'), this.form)
            },
        },
    })
    </script>
    
<template>
    <!-- eslint-disable -->
        <div class="w-full">
            <header class="">
                <div class="flex justify-between max-w-7xl mx-auto py-6 px-10">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
                       <ChevronLeftIcon class="w-5 mr-2 rounded-full hover:bg-white" @click="goBack" /> Solicitud - Editar Solicitud
                    </h2>
                    <div class="space-x-2" >
                        <!-- <button class="btn-blue" @click="showNewService = !showNewService">
                            Agregar Servicio
                        </button> -->
                        <a class="btn-blue" :href="route('services')" >
                            Guardar
                        </a>
    
                    </div>
                </div>
            </header>
    
            <Toast :toast="this.toastMessage" :type="this.labelType" @clear="clearMessage"></Toast>
    
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">                        
                        <div class="pb-12">
                            <div class="md:grid md:grid-cols-3 md:gap-10">
                                <div class="md:col-span-1">
                                    <div>
                                        <div class="px-4 sm:px-0">
                                          <h3 class="text-base font-semibold leading-7 text-gray-900">Información general de solicitud</h3>
                                          <!-- <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Detalles de la reserva</p> -->
                                        </div>
                                        <div class="mt-6 border-t border-gray-100">
                                          <dl class="divide-y divide-gray-100">
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                              <dt class="text-sm font-medium leading-6 text-gray-900">Cliente</dt>
                                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">ATP</dd>
                                            </div>
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                              <dt class="text-sm font-medium leading-6 text-gray-900">Recibido</dt>
                                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">01/07/2023</dd>
                                            </div>
                                            <!-- <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                              <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
                                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">margotfoster@example.com</dd>
                                            </div> -->
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                              <dt class="text-sm font-medium leading-6 text-gray-900">Responsable</dt>
                                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">Gisela</dd>
                                            </div>
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                              <dt class="text-sm font-medium leading-6 text-gray-900">Notas</dt>
                                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> 2 Aguas</dd>
                                            </div>
                                          </dl>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-span-2">
                                    <div>
                                        <div class="px-4 sm:px-0 flex justify-between items-center">
                                            <h3 class="text-base font-semibold leading-7 text-gray-900">Detalle del Viaje</h3>
                                            <div class="bg-yellow-200 text-yellow-700 px-4 py-2 rounded-lg text-xs tracking-wider">EN CURSO</div>
                                        </div>     
                                        <div v-for="service in services" :key="service.id" class="bg-gray-50 sm:rounded-lg">
                                            <div class="px-4 py-5 sm:px-6 mt-3  ">
                                                <div class="flex justify-between items-center ">
                                                    <a :href="route('service.edit', 4)" class="text-lg leading-6 font-medium text-gray-900 hover:underline">{{service.service.detail}}</a>
                                                    <div class="text-xs bg-green-200 text-green-900 rounded px-2 py-1">{{service.status}}</div>
                                                </div>

                                                <p class="mt-1 max-w-2xl text-sm text-gray-500 mb-8">Fecha: {{formatDate(service.date)}}</p>
                                            
                                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">Origen</dt>
                                                        <dd class="mt-1 text-sm text-gray-900">{{service.location_from}}</dd>
                                                    </div>
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">Destino</dt>
                                                        <dd class="mt-1 text-sm text-gray-900">{{service.location_to}}</dd>
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
                                                        <dt class="text-sm font-medium text-gray-500">Chofer</dt>
                                                        <dd class="mt-1 text-sm text-gray-900">{{service.driver}}</dd>
                                                    </div>
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">Total</dt>
                                                        <dd class="mt-1 text-sm text-gray-900">{{service.total}}</dd>
                                                    </div>    
                                                </dl>
                                            </div>
                                        </div>         
                                        <!-- <div>
                                            <div class="px-4 sm:px-0 mt-12 flex justify-between items-center">
                                              <h3 class="text-base font-semibold leading-7 text-gray-900">Items del Viaje</h3>
                                              <button class="btn-blue" @click="showNewItem =! showNewItem">Nuevo Item</button>
                                            </div>
                                            
                                            <div class="mt-8" v-show="showNewItem">
                                                <form @submit.prevent="addItem" class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-5 sm:gap-4">
                                                    <div class="col-span-2">
                                                      <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
                                                      <input v-model="newItem.description" type="text" name="description" id="description" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <div class="col-span-2">
                                                      <label for="price" class="block text-sm font-medium text-gray-700">Precio:</label>
                                                      <input v-model="newItem.price" type="number" name="price" id="price" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <div class="col-span-1">
                                                      <button type="submit" class="btn-blue w-full mt-6">Agregar Item</button>
                                                    </div>
                                                  </form>
                                            </div>       

                                            <div class="mt-8 border-t border-gray-100">
                                              <dl class="divide-y divide-gray-100">

                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                                                    v-for="item in items" :key="item.id" >
                                                  <dt class="text-sm font-medium leading-6 text-gray-900 sm:col-span-2 pl-5">{{ item.description }}</dt>
                                                  <dd class="mt-1 pr-8 text-sm leading-6 text-gray-700 sm:mt-0 text-right">$ {{ item.price }}</dd>
                                                </div>
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt class="text-base font-bold leading-6 text-gray-900 sm:col-span-2 text-right pl-5">Total:</dt>
                                                    <dd class="mt-1 pr-8 text-base leading-6 font-bold text-gray-900 sm:mt-0 text-right">$ {{ calculateTotal().toFixed(2) }}</dd>
                                                  </div>
                                              </dl>
                                            </div>
                                        </div>                                     -->

                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
     
            </div>
    
             <Services v-show="showNewService" 
                      :locations="locations" 
                      :client="form.client_id" 
                      @createService="createService"  />
        </div> 
    </template>
    
    
    <script>
    
    import { defineComponent, ref } from 'vue'
    import Icons from '@/Layouts/Components/Icons.vue'
    import Toast from '@/Layouts/Components/Toast.vue'
    import Datepicker from '@vuepic/vue-datepicker'
    import '@vuepic/vue-datepicker/dist/main.css'
    import Services from '@/Pages/Manager/Requests/Services.vue'
    
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
            Services                
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
                items: [
                    {description: "Transfer Ezeiza / Hotel Céntrico o Viceversa", price: 43},
                    {description: "Tiempo de espera: 1hs", price: 17},
                ],
                showNewItem: false,
                form: {},
                toastMessage: "",
                showNewService: false,
                services: [{
                            "date":"2023-07-21",
                            "time":{"hours":9,"minutes":0,"seconds":0},"cant_pax":3,"guia":"1","equipaje":"1",
                            "service":{"id":30,"client_id":1,"detail":"Transfer Ezeiza / Palermo o Viceversa","type":"TRF VAN","wait_time":1,"baggage":true,"guide":true,"passenger_capacity":6,"duration":null,"price":137,"active":true,"created_by":1,"deleted_at":null,"created_at":null,"updated_at":null},
                            "guide_name":"",
                            "flight_number":"AA 1210",
                            "location_from":"Aeropuerto Internacional Ministro Pistarini (Ezeiza)",
                            "location_to":"Hotel Colonial",
                            "status":"FINALIZADO",
                            "driver": "Marcelo Perez",
                            "total": "$ 60,00"
                        },
                        {
                            "date":"2023-07-31",
                            "time":{"hours":9,"minutes":0,"seconds":0},"cant_pax":3,"guia":"1","equipaje":"1",
                            "service":{"id":30,"client_id":1,"detail":"Transfer Ezeiza / Palermo o Viceversa","type":"TRF VAN","wait_time":1,"baggage":true,"guide":true,"passenger_capacity":6,"duration":null,"price":137,"active":true,"created_by":1,"deleted_at":null,"created_at":null,"updated_at":null},
                            "guide_name":"",
                            "flight_number":"AA 1234",
                            "location_from":"Hotel Colonial",
                            "location_to":"Aeropuerto Internacional Ministro Pistarini (Ezeiza)",
                            "status":"EN CURSO",
                            "driver": "Jose Sosa",
                            "total": "$ - "
                        },
                ],
    
                newItem: {
                    description: "",
                    price: null,
                },
    
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
    
            createService(service) {
                
                console.log(service)
                this.services.push(service)
    
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
                this.$inertia.post(route('client.store'), this.form)
            },
            calculateTotal() {
                return this.items.reduce((total, item) => total + item.price, 0);
            }, 

            addItem() {
                // Validar que se haya ingresado una descripción y un precio
                if (!this.newItem.description || !this.newItem.price) {
                return;
                }

                // Agregar el nuevo item a la lista de items
                this.items.push({
                description: this.newItem.description,
                price: parseFloat(this.newItem.price),
                });

                // Limpiar el formulario
                this.newItem.description = "";
                this.newItem.price = null;

            }

        },
        created() {
            //this.getCity()
        }
    })
    </script>
    
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
                                    <div v-if="request">
                                        <RequestDetail :request="request" />
                                    </div>
                                 
                                </div>
                                <div class="col-span-2">
                                    <div>
                                        <div class="px-4 sm:px-0 flex justify-between items-center">
                                            <h3 class="text-base font-semibold leading-7 text-gray-900">Servicios Solicitados</h3>
                                            <div class="text-sm">ESTADO GENERAL 
                                                <span class="bg-yellow-200 text-yellow-700 px-4 py-1 rounded-lg text-xs tracking-wider uppercase">
                                                 {{ request.status.name }}</span>
                                            </div>
                                        </div>  

                                        <ServiceCard v-for="service in request.request_services" 
                                                     :key="service.id" 
                                                     :service="service"
                                                     :servicePriceList="servicePriceList" 
                                                     :drivers="drivers"
                                                     class="bg-gray-50 sm:rounded-lg" />
                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
     
            </div>
    
             <!-- <Services v-show="showNewService" 
                      :locations="locations" 
                      :client="form.client_id" 
                      @createService="createService"  /> -->
        </div> 
    </template>
    
    
    <script>
    
    import { defineComponent, ref } from 'vue'
    import { Inertia } from '@inertiajs/inertia';

    import Toast from '@/Layouts/Components/Toast.vue'
    import Datepicker from '@vuepic/vue-datepicker'
    import '@vuepic/vue-datepicker/dist/main.css'
    
    import ServiceCard from './ServiceCard.vue'
    import RequestDetail from './RequestDetail.vue'
    
    import Icons from '@/Layouts/Components/Icons.vue'
    import { ChevronLeftIcon } from '@heroicons/vue/24/outline'
    
    export default defineComponent({
        props: {
            drivers: Object,
            servicePriceList: Object, 
            locations: Object,
            request: Object
        },
    
        components: {
            Icons,
            Toast,
            ChevronLeftIcon,
            Inertia,
            Datepicker,
            ServiceCard,
            RequestDetail                
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

    })
    </script>
    
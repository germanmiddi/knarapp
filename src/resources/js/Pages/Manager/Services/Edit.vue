<template>
    <!-- eslint-disable -->
        <div class="w-full">
            <header class="">
                <div class="flex justify-between max-w-7xl mx-auto py-6 px-10">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
                       <ChevronLeftIcon class="w-5 mr-2 rounded-full hover:bg-white" @click="goBack" /> Viajes - Editar Viaje
                    </h2>
                    <div class="space-x-2" >
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
                                    <RequestInfo :request="requestService.request" />
                                </div>
                                <div class="col-span-2">
                                    <ServiceCard :service="requestService" 
                                                 :servicePriceList="requestService.servicePriceList" />
                                                                     
                                    <ServiceItems 
                                        :requestService="requestService"
                                        :items="requestService.request_services_items" 
                                        @updateRequestService="handleUpdateRequestService"/>
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
    import RequestInfo from '@/Layouts/Request/RequestInfo.vue'
    import ServiceItems from './ServiceItems/List.vue'
    import ServiceCard from './ServiceCard.vue'

    import Datepicker from '@vuepic/vue-datepicker'
    import '@vuepic/vue-datepicker/dist/main.css'
    
    import {
             ChevronLeftIcon
            } from '@heroicons/vue/24/outline'
    
    import { Inertia } from '@inertiajs/inertia';
    export default defineComponent({
        props: {
            clients: Object,
            locations: Object,
            requestService: Object,
        },
    
        components: {
            Icons,
            Toast,
            ChevronLeftIcon,
            Inertia,
            Datepicker,     
            RequestInfo,
            ServiceItems,
            ServiceCard        
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
                // showNewItem: false,
                // toastMessage: "",
                // newItem: {
                //     description: "",
                //     price: null,
                // },
    
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
    
            goBack() {
               Inertia.visit(document.referrer);
            },
            clearMessage() {
                this.toastMessage = ""
            },
        }
    })
    </script>
    
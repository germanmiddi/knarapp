<template>
    <!-- eslint-disable -->
    <div class="px-4 py-5 sm:px-6 mt-3  mb-8">
        <div class="flex justify-between items-center ">
            <div class="text-xl ">{{ service.service_type_description}}</div>
            <div class="flex items-center">
                <button @click="fillUpdateService(service)" ><PencilIcon class="w-5 text-blue-500" /></button>
                <button class="ml-2" @click="deleteService(service)"><TrashIcon class="w-5 text-red-500" /></button>
            </div>
            <!-- <div class="text-xs rounded px-2 py-1 uppercase" :class="labelStatus[service.status.name]">{{service.status.name}}</div> -->
        </div>

        <div class="mt-1 text-base text-gray-900 mb-8 flex items-center">
            <CalendarDaysIcon class="h-4 mr-2 text-indigo-500" /> <span> {{formatDate(service.date)}} </span>
            <ClockIcon class="h-4 ml-5 mr-2 text-indigo-500" /> <span> {{ service.time.hours }}:{{ service.time.minutes }} </span>
        </div>
        
        
        <div class="grid grid-cols-2 gap-x-4 gap-y-4">
            <div class="col-span-2">
                <dt class="text-xs font-medium text-gray-500">Origen</dt>
                <dd class="mt-1 text-sm text-gray-900">{{service.location_from.name}}</dd>
            </div>
            <div class="col-span-2">
                <dt class="text-xs font-medium text-gray-500">Destino</dt>
                <dd class="mt-1 text-sm text-gray-900">{{service.location_to.name}}</dd>
            </div>
          

            <div class="col-span-2 border-t border-gray-200 w-full"></div>
            
            <div class="col-span-2">
                <div class="grid grid-cols-3">
                    <div class="col-span-3 sm:col-span-1">
                        <dt class="text-xs font-medium text-gray-500">Pasajeros</dt>
                        
                        <dd class="mt-1">
                            <input v-model="service.pax_cant" disabled
                            class="w-1/2 text-right mt-1 block py-1 px-3 border border-gray-200 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />                                
                        </dd>
                    </div>

                    <div class="col-span-3 sm:col-span-1">
                        <dt class="text-xs font-medium text-gray-500">Guia</dt>
                        
                        <dd class="mt-1">
                            <Switch v-model="service.guide" disabled
                                    :class="service.guide ? 'bg-blue-400' : 'bg-gray-200'"
                                    class="relative inline-flex h-6 w-11 items-center rounded-full">
                                    <span :class="service.guide ? 'translate-x-6' : 'translate-x-1'"
                                        class="inline-block h-4 w-4 transform rounded-full bg-white transition"/>
                            </Switch> 
                        </dd>
                    </div>

                    <div class="col-span-3 sm:col-span-1">
                        <dt class="text-xs font-medium text-gray-500">Equipaje</dt>
                        <dd class="mt-1">
                            <Switch v-model="service.baggage"
                                    disabled
                                    :class="service.baggage ? 'bg-blue-400' : 'bg-gray-200'"
                                    class="relative inline-flex h-6 w-11 items-center rounded-full">
                                    <span :class="service.baggage ? 'translate-x-6' : 'translate-x-1'"
                                        class="inline-block h-4 w-4 transform rounded-full bg-white transition"/>
                            </Switch> 
                        </dd>
                    </div>                        
                </div>
            </div>
<!--             
            <div class="col-span-2 sm:col-span-1">
                <dt class="text-xs font-medium text-gray-500">Guia</dt>
                
                <dd class="mt-1">
                    <Switch v-model="service.guide" disabled
                            :class="service.guide ? 'bg-blue-400' : 'bg-gray-200'"
                            class="relative inline-flex h-6 w-11 items-center rounded-full">
                            <span :class="service.guide ? 'translate-x-6' : 'translate-x-1'"
                                class="inline-block h-4 w-4 transform rounded-full bg-white transition"/>
                    </Switch> 
                </dd>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <dt class="text-xs font-medium text-gray-500">Equipaje</dt>
                <dd class="mt-1">
                    <Switch v-model="service.baggage"
                            disabled
                            :class="service.baggage ? 'bg-blue-400' : 'bg-gray-200'"
                            class="relative inline-flex h-6 w-11 items-center rounded-full">
                            <span :class="service.baggage ? 'translate-x-6' : 'translate-x-1'"
                                class="inline-block h-4 w-4 transform rounded-full bg-white transition"/>
                    </Switch> 
                </dd>
            </div> -->

            <div class="col-span-2">
                <dt class="text-xs font-medium text-gray-500">Nro Vuelo</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    <input v-model="service.flight_number" :disabled="service.flight_number == null"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                            :class="{'bg-gray-50': 'service.flight_number == null'}"/>
                </dd>
            </div>    
           
         
        </div>

    </div>
    <!-- {{ service }} -->
</template>

<script>

import { PencilIcon,
         TrashIcon,
         CalendarDaysIcon,
         ClockIcon
        } from '@heroicons/vue/24/outline'

export default {
    props: {
        service: Object
    },

    components: {
        PencilIcon,
        TrashIcon,
        CalendarDaysIcon,
        ClockIcon
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
            // Obtiene las horas, minutos y segundos de la variable
            const { hours, minutes } = time;

            // Formatea las horas y minutos a dos dígitos con ceros iniciales
            const formattedHours = String(hours).padStart(2, '0');
            const formattedMinutes = String(minutes).padStart(2, '0');

            // Retorna la hora formateada como "hh:mm"
            return `${formattedHours}:${formattedMinutes}`;
        },
        
    },
}
</script>

<style>

</style>
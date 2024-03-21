<template>
       <div >

            <div class="flex items-center justify-between mb-8">
                <div>
                    <!-- <h3 class="text-lg leading-6 font-medium text-gray-900">{{service.service.name}}</h3> -->
                    <div class="mt-1 max-w-xl text-bold text-xl text-gray-900">
                        <span class="text-sm text-gray-500">Fecha:</span> {{formatDate(service.date)}} - 
                        <span class="text-sm text-gray-500">Hora:</span>  {{ formatTime(service.time) }}</div>
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
                            <dd class="mt-1 text-sm text-gray-900">{{service.location_from.name}}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Destino</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{service.location_to.name}}</dd>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Guia</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{service.guia == 1 ? 'Con Guia' : 'Sin Guia'}}
                    </dd>
                </div>
                <!-- <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Nombre Guia</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{service.guide_name}}</dd>
                </div> -->
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



</template>

<script>

import { PencilIcon,
         TrashIcon
        } from '@heroicons/vue/24/outline'

export default {
    props: {
        service: Object
    },

    components: {
        PencilIcon,
        TrashIcon
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
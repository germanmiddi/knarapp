<template>
    <div class="mb-8 ">
        <div class="px-4 py-5 sm:px-6 mt-3  ">
            <div class="flex justify-between items-center ">
                <div class="text-xl ">{{ service.service_type.description}}</div>
                <div class="text-xs rounded px-2 py-1 uppercase" :class="labelStatus[service.status.name]">{{service.status.name}}</div>
            </div>
    
            <div class="mt-1 text-base text-gray-900 mb-8 flex items-center">
                <CalendarDaysIcon class="h-4 mr-2 text-indigo-500" /> <span> {{formatDate(service.date)}} </span>
                <ClockIcon class="h-4 ml-5 mr-2 text-indigo-500" /> <span> {{ service.time }} </span>
            </div>
            
            
            <div class="grid grid-cols-2 gap-x-4 gap-y-4">
                <!-- {{servicePriceList}}
                {{drivers}} -->
                <div class="col-span-2">
                    <dt class="text-xs font-medium text-gray-500">Origen</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{service.from.name}}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-xs font-medium text-gray-500">Destino</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{service.to.name}}</dd>
                </div>
    
                <div class="col-span-2 border-t border-gray-200 w-full"></div>
    
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
                </div>

                <div class="col-span-2">
                    <dt class="text-xs font-medium text-gray-500">Nro Vuelo</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <input v-model="service.flight_number" :disabled="service.flight_number == null"
                               class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                               :class="{'bg-gray-50': 'service.flight_number == null'}"/>
                    </dd>
                </div>    
    
                
                <div class="col-span-2">
                    <dt class="text-xs font-medium text-gray-500">Servicio</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <select v-model="service.servicepricelists_id"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option v-for="price_list_item in price_list" :value="price_list_item.id" :key="price_list_item.id">{{ buildOptionService(price_list_item) }}</option>
                        </select>
                    </dd>
                </div>
                <div class="col-span-2 sm:col-span-2">
                    <dt class="text-xs font-medium text-gray-500">Chofer</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <select v-model="service.driver_id"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option v-for="driver in drivers" :value="driver.id" :key="driver.id">{{ `${driver.name} ${driver.lastname}` }}</option>
                        </select>
                    </dd>                
                </div>
                <div v-if="service.guide" class="col-span-2 sm:col-span-2">
                    <dt class="text-xs font-medium text-gray-500">Nombre Guia</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <input v-model="service.guide_name"
                               class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                       
                    </dd>                
                </div>            
                <!-- <div class="col-span-2 sm:col-span-1">
                    <dt class="text-xs font-medium text-gray-500">Total</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{service.total}}</dd>
                </div>     -->
            </div>
    
        </div>
        <div class="flex justify-between w-full px-6 py-4 bg-gray-50 rounded-b-lg border-t  border-gray-300">
            <div><button v-if="service.status_id == 1" @click="cancelService(service.id)" class="btn-outline-red">Cancelar</button></div>   
            <button v-if="service.status_id == 1" @click="confirmService()" class="btn-blue">Confirmar</button>
            <button v-else-if="service.status_id == 2 || service.status_id == 3" class="btn-blue">Finalizar</button>
            <button v-else-if="service.status_id == 4 || service.status_id == 5" class="btn-blue">Re Abrir</button>
        </div>

    </div>  
      
</template>

<script>

import { ref } from 'vue'
import { CalendarDaysIcon, ClockIcon } from '@heroicons/vue/24/outline'
import { Switch } from '@headlessui/vue'

const labelStatus = {
    'pendiente'  : 'bg-yellow-100 text-yellow-800 border border-yellow-400', // Amarillo para indicar espera o en proceso
    'confirmado' : 'bg-green-100 text-green-800 border border-green-500',    // Verde para confirmación, típicamente asociado con éxito
    'en viaje'   : 'bg-blue-100 text-blue-800 border border-blue-400',       // Azul, da una sensación de movimiento o acción
    'finalizado' : 'bg-gray-100 text-gray-800 border border-gray-400',       // Gris, neutral y comúnmente usado para estados completados
    'cancelado'  : 'bg-red-100 text-red-800 border border-red-500',          // Rojo para cancelación, claro indicativo de alerta o parada
};


export default {

    props: {
        service: {
            type: Object,
            required: true
        },
        servicePriceList: {
            type: Object,
            required: true
        },
        drivers: {
            type: Object,
            required: true
        }
    },

    components: {
        CalendarDaysIcon,
        ClockIcon,
        Switch
    },

    setup(props) {

        const service = ref(props.service);
        const drivers = ref(props.drivers);
        
        const formatDate = (date) => new Date(date).toLocaleDateString();

        const price_list = props.servicePriceList.filter((spl) => {
            console.log(spl.services_type_id, service.value.services_type_id)

            return spl.services_type_id === service.value.services_type_id;
        });

        
        return {
            service,
            formatDate,
            labelStatus,
            price_list,
            drivers
        }
    },
    methods: {
        buildOptionService(price_list_item) {
            
            const guia = price_list_item.servicepricelistbase.guide ? ' | Guia' : '';
            const equipaje = price_list_item.servicepricelistbase.baggage ? ' | Equipaje' : '';
            const pax = price_list_item.servicepricelistbase.passenger_capacity ? ` | Pax: ${price_list_item.servicepricelistbase.passenger_capacity}` : '';
            const price = price_list_item.price ? price_list_item.price : 0;

            return `${price_list_item.service.name} ${guia} ${equipaje} ${pax} | USD ${price_list_item.price}`;
        },
        
        async confirmService(){
            const confirm = window.confirm('¿Está seguro de confirmar el servicio?');
            if (confirm) {

                const url = route('requestservice.confirm', this.service);

                const response = await axios.post(url);

                const data = response.data;
                alert(data.message);

            }
        },

        async cancelService(service_id) {
            
            const confirm = window.confirm('¿Está seguro de cancelar el servicio?');
            if (confirm) {
                const url = route('requestservice.cancel', service_id);

                const response = await axios.get(url);

                const data = response.data;
                alert(data.message);

            }

        }
    }

}


</script>

<style>

</style>
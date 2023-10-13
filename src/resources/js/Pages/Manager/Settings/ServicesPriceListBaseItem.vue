<template>
<!-- eslint-disable -->
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100 text-sm ">
            <td class="border-t px-4 py-2 text-left">{{service.services.service_type.description}}</td>
            <td class="border-t px-4 py-2 text-left">{{service.services.name}}</td>
            <td class="border-t px-4 py-2 text-center">{{service.passenger_capacity}}</td>
            <td class="border-t px-4 py-2 text-center">{{service.wait_time}} <span class="text-xs text-gray-600">hs</span></td>
            <td class="border-t px-4 py-2 text-center">{{service.baggage}}</td>
            <td class="border-t px-4 py-2 text-center">{{service.guide}}</td>
            <td class="border-t px-4 py-2 text-center">{{service.duration}} <span class="text-xs text-gray-600">hs</span></td>
            <td class="border-t px-4 py-2 text-center"><span class="text-xs text-gray-600">$</span> {{service.price}}</td>
            <td class="border-t px-4 py-2 text-center"><span class="text-xs text-gray-600">$</span> {{service.cost}}</td>
            <td class="border-t px-4 py-2 text-center">
                <div v-if="loading" class="flex justify-center">
                    <Icons name="loading" class="animate-spin w-6 h-6 text-gray-500" />
                </div> 
                <div v-else class="flex justify-center">
                    <button class="inline-flex items-center px-2 py-1 border border-gray-200 rounded-md text-gray-800 bg-gray-100 
                            hover:bg-blue-400 hover:text-white"
                        @click="fillFormUpdate(service)">
                        <PencilIcon class="h-3 w-3  mr-2 " aria-hidden="true" /> Editar </button>
                    <button class="ml-2 inline-flex items-center px-2 py-1 border border-gray-200 rounded-md text-gray-800 bg-gray-100 
                            hover:bg-blue-400 hover:text-white"
                        @click="deleteService(service)">
                        <TrashIcon class="h-3 w-3  mr-2 " aria-hidden="true" /> Borrar </button>
                </div>  
            </td>
    </tr>
                                
</template>

<script>
import { PencilIcon, 
         TrashIcon
        } from '@heroicons/vue/24/outline';

import Icons from '@/Layouts/Components/Icons.vue'

export default {
    props: {
            service: {
                type: Object,
                required: true
            }
    },

    components: {
        Icons,
        PencilIcon,
        TrashIcon
    },

    data(){
        return {
            loading: false,
        }
    },
    methods: {

        // fillFormUpdate(service){
        //     this.form.id            = service.id
        //     this.form.tipo_servicio = service.services.service_type.id
        //     this.form.services_id   = service.services.id
        //     this.form.passenger_capacity = service.passenger_capacity
        //     this.form.wait_time     = service.wait_time
        //     this.form.baggage       = service.baggage 
        //     this.form.guide         = service.guide
        //     this.form.duration      = service.duration
        //     this.form.price         = service.price
        //     this.form.cost          = service.cost

        // },
        
        fillFormUpdate(service){
            alert('fillFormUpdate child')
            this.$emit('fillFormUpdate', service)
        },

        async deleteService(service){
            this.loading = true
            let response = await fetch(route('services_price_list_base.delete'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(service)
            })

            if (response.ok) {
                this.$emit('getServicesPriceListBase')
            }else{
                const responseData = await response.json();
                alert(responseData.message)
            }
            this.loading = false

        },
    
    },

}
</script>

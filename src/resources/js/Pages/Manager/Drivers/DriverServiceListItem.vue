<template>
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100 text-xs">
        <td class="border-t px-6 py-4 text-left">  {{ service.services.service_type.description }}</td>
        <td class="border-t px-6 py-4 text-left">{{ service.services.name }}</td>
        <td class="border-t px-6 py-4 text-center">{{ service.wait_time }} Hs.</td>

        <!-- <td class="border-t px-6 py-4 text-center">{{ service.baggage }}</td> -->
        <td class="border-t px-6 py-4 text-center">
            <CheckCircleIcon v-if="service.baggage == 1" 
                    class="w-6 text-green-500"/>
            <MinusCircleIcon v-else 
                class="w-6 text-gray-500" />
        </td>

        <!-- <td class="border-t px-6 py-4 text-center">{{ service.guide }}</td> -->
        <td class="border-t px-6 py-4 text-center">
            <CheckCircleIcon v-if="service.guide == 1" 
                    class="w-6 text-green-500"/>
            <MinusCircleIcon v-else 
                class="w-6 text-gray-500" />
        </td>

        <td class="border-t px-6 py-4 text-center">{{ service.passenger_capacity }}</td>
        <td class="border-t px-6 py-4 text-center">{{ service.duration }} Hs.</td>

        <td v-if="service.dsp_price && !showCostInput" @click="showCostInput = true" class="border-t px-6 py-4 text-right">USD {{ service.dsp_price }}</td>

        <td v-if="service.dsp_price == null && !showCostInput" class="border-t px-6 py-4 text-center" colspan="2">
            <button @click="showCostInput = true" class="bg-blue-400 text-white px-2 py-1 rounded text-sm mr-1">Asignar Servicio</button></td>
        
        <td v-if="showCostInput" class="border-t py-4 px-2 text-right" colspan="2">
            <div v-if="loadingNewPrice" class="flex justify-center">
                <Icons name="loading" class="animate-spin w-6 h-6 text-gray-500" />
            </div> 
            <div v-else class="flex items-center">
                <input  type="number"
                       class="w-16 text-right text-xs border border-gray-100 rounded-md px-1 mr-1 h-6
                              focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300"    
                       v-model="new_dsp_price" />
                <button @click="submitNewCost(service)" class="bg-blue-400 text-white px-2 py-1 rounded text-xs mr-1">Guardar</button>
                <button @click="new_dsp_price = 0; showCostInput = false " class="bg-red-400 text-white px-1 py-1 rounded text-sm "><XCircleIcon class="w-4"/></button>                       
            </div>    
        </td>
        
        <td v-if="service.dsp_active !=  null" class="border-t px-2 py-4 text-center"> 
            <div v-if="loading" class="flex justify-center">
                <Icons name="loading" class="animate-spin w-6 h-6 text-gray-500" />
            </div> 
            <div v-else class="cursor-pointer flex justify-center">
                <Switch v-model="service.dsp_active"
                        @click="toggleActive(service.dsp_id)"
                        :class="service.dsp_active ? 'bg-blue-600' : 'bg-gray-200'"
                        class="relative inline-flex h-6 w-11 items-center rounded-full">
                        <span class="sr-only">Enable notifications</span>
                        <span :class="service.dsp_active ? 'translate-x-6' : 'translate-x-1'"
                              class="inline-block h-4 w-4 transform rounded-full bg-white transition"/>
                </Switch>                

                <!-- <CheckCircleIcon v-if="service.dsp_active == 1" 
                    @click="toggleActive(service.dsp_id)"
                    class="w-6 text-green-500"/>
                <MinusCircleIcon v-else 
                    @click="toggleActive(service.dsp_id)"
                    class="w-6 text-gray-500" /> -->
            </div>    
        </td>  
        

    </tr>
</template>

<script>
import { CheckCircleIcon, MinusCircleIcon, XCircleIcon } from '@heroicons/vue/24/outline' 
import Icons from '@/Layouts/Components/Icons.vue'
import { Switch } from '@headlessui/vue'

export default {

    components: {
        CheckCircleIcon,
        MinusCircleIcon,
        XCircleIcon,
        Icons,
        Switch
    },

    props: {
        service: {
            type: Object,
            required: true
        },
        driver_id: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            enabled: false,
            edit: "",
            editMode: false,
            loading: false,
            loadingNewPrice: false,
            showCostInput: false,
            new_dsp_price: 0
        }
    },

    methods: {
        deleteItem() {
            this.$emit('delete-item', this.item)
        },

        async submitNewCost(service){
            this.loadingNewPrice = true
            const response = await axios.post(route('drivers_service_price.store' ), 
                                                {service  : service,
                                                 driver_id: this.driver_id,
                                                 cost: this.new_dsp_price } );

            if (response.status == 200) {

                this.$emit('update-item', response.data)

                this.$emit('toast-message', {
                    message: response.data.message,
                    type: "success"
                })

            } else {

                this.$emit('toast', {
                    message: response.data.message,
                    type: "danger"
                })

            }
            this.loadingNewPrice = false
            this.showCostInput = false

        },

        async toggleActive(id){
            
            if(id == null){
                this.$emit('toast-message', {
                    message: 'Se debe definir el costo del servicio',
                    type: "danger"
                })
                return
            }
            
            // this.loading = true
            
            const response = await axios.post(route('drivers_service_price.toggleActive' ), {id : id} ); 
            
            if (response.status == 200) {

                this.$emit('toggle-active', response.data)

                this.$emit('toast-message', {
                    message: response.data.message,
                    type: "success"
                })

            } else {

                this.$emit('toast', {
                    message: response.data.message,
                    type: "danger"
                })

            }
            this.loading = false
                            
        },

        destroyItem(id){
            this.$emit('destroy-item',id)
        }


    },    

    
}
</script>

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        appearance: none;
        margin: 0;
    }

</style>
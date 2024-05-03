<template>
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100 text-xs ">
        <td class="border-t px-6 py-4 text-left">  {{ service.services.service_type.description }}</td>
        <td class="border-t px-6 py-4 text-left">{{ service.services.name }}</td>
        <td class="border-t px-6 py-4 text-center">{{ service.wait_time }} Hs.</td>
        
        <td class="border-t px-6 py-4 text-center">
            <CheckCircleIcon v-if="service.baggage == 1" 
                    class="w-6 text-green-500"/>
            <MinusCircleIcon v-else 
                class="w-6 text-gray-500" />
        </td>

        <td class="border-t px-6 py-4 text-center">
            <CheckCircleIcon v-if="service.guide == 1" 
                    class="w-6 text-green-500"/>
            <MinusCircleIcon v-else 
                class="w-6 text-gray-500" />
        </td>
        <td class="border-t px-6 py-4 text-center">{{ service.passenger_capacity }}</td>
        <td class="border-t px-6 py-4 text-center">{{ service.duration }}</td>
        
        <!-- Si el precio tiene un valor asignado, se muestra el precio y se puede editar -->
        <td v-if="service.csp_price && !showPriceInput" 
            @click="showPriceInput = true; new_csp_price = service.csp_price " 
            class="border-t px-6 py-4 text-right">USD {{ service.csp_price }}</td>

        <!-- Si el precio del servicio es null, se muestra un boton para asignar el servicio     -->
        <td v-if="service.csp_price == null && !showPriceInput" class="border-t px-6 py-4 text-center" colspan="2">
            <button @click="showPriceInput = true; new_csp_price = service.price" class="bg-blue-400 text-white px-2 py-1 rounded text-sm mr-1">Asignar Servicio</button></td>

        <td v-if="showPriceInput" class="border-t py-4 px-2 text-right" colspan="2">
            <div v-if="loadingNewPrice" class="flex justify-center">
                <Icons name="loading" class="animate-spin w-6 h-6 text-gray-500" />
            </div> 
            <div v-else class="flex items-center">
                <input  type="number"
                       class="w-16 text-right text-xs border border-gray-100 rounded-md px-1 mr-1 h-6
                              focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300"    
                       v-model="new_csp_price" />
                <button @click="submitNewPrice(service)" class="bg-blue-400 text-white px-2 py-1 rounded text-xs mr-1">Guardar</button>
                <button @click="new_csp_price = 0; showPriceInput = false " class="bg-red-400 text-white px-1 py-1 rounded text-sm "><XCircleIcon class="w-4"/></button>                       
            </div>    
        </td>
        
        <td v-else-if="service.csp_active !=  null" class="border-t px-2 py-4 text-center"> 
            <div v-if="loading" class="flex justify-center">
                <Icons name="loading" class="animate-spin w-6 h-6 text-gray-500" />
            </div> 
            <div v-else class="cursor-pointer flex justify-center">
                <Switch v-model="service.csp_active"
                        @click="toggleActive(service.csp_id)"
                        :class="service.csp_active ? 'bg-blue-600' : 'bg-gray-200'"
                        class="relative inline-flex h-6 w-11 items-center rounded-full">
                        <span :class="service.csp_active ? 'translate-x-6' : 'translate-x-1'"
                              class="inline-block h-4 w-4 transform rounded-full bg-white transition"/>
                </Switch>                

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
        client_id: {
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
            showPriceInput: false,
            new_csp_price: 0
        }
    },

    methods: {

        async submitNewPrice(service){

            //check if cost is greater than 0
            if(this.new_csp_price <= 0){
                this.$emit('toast-message', {
                    message: 'El precio del servicio debe ser mayor a 0',
                    type: "danger"
                })
                return
            }

            this.loadingNewPrice = true
            const response = await axios.post(route('clients_service_list.store' ), 
                                                {service  : service,
                                                 client_id: this.client_id,
                                                 cost: this.new_csp_price } );

            if (response.status == 200) {

                this.$emit('update-item', response.data)

                this.$emit('toast-message', {
                    message: response.data.message,
                    type: "success"
                })

            } else {

                this.$emit('toast-message', {
                    message: response.data.message,
                    type: "danger"
                })

            }
            this.loadingNewPrice = false
            this.showPriceInput = false

        },

        async toggleActive(id){
            
            if(id == null){
                this.$emit('toast-message', {
                    message: 'Se debe definir el precio del servicio',
                    type: "danger"
                })
                return
            }
            
            // this.loading = true
            
            const response = await axios.post(route('clients_service_list.toggleActive' ), {id : id} ); 
            
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
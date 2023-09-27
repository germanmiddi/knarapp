<template>
<!-- eslint-disable -->
    <div class="max-w-8xl mx-auto py-5 sm:px-4 lg:px-6">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-3">
                            <div class="px-4 sm:px-0 flex justify-between items-center mb-3">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Lista de Servicios</h3>
                                <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 w-96  shadow-sm sm:text-sm border-gray-300 rounded-md"  placeholder="Buscar"/>
                                <button class="btn-blue">Nuevo Servicio</button>
                            </div>
                            <div>
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="col-span-12 sm:col-span-2 ">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Tipo</label>
                                        <select v-model="form.tipo_servicio" id="tipo_servicio" name="tipo_servicio"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option v-for="row in tipoServicio.data" :key="row.id" :value="row.id">
                                                {{ row.description }}</option>
                                        </select>
                                    </div>

                                    <div class="col-span-12 sm:col-span-5 ">
                                        <label for="servicio" class="block text-sm font-medium text-gray-700">Servicio</label>
                                        <select v-model="form.services_id" id="servicio_id" name="servicio_id"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option v-for="row in servicio.data" :key="row.id" :value="row.id">
                                                {{ row.name }}</option>
                                        </select>                                        
                                    </div>

                                    
                                    <div class="col-span-12 sm:col-span-2">
                                        <label for="passenger_capacity" class="block text-sm font-medium text-gray-700">Pax</label>
                                        <input v-model="form.passenger_capacity" id="passenger_capacity" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                                    </div>
                                    
                                    <div class="col-span-12 sm:col-span-2">
                                        <label for="wait_time" class="block text-sm font-medium text-gray-700">Espera</label>
                                        <input v-model="form.wait_time" id="wait_time" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                                    </div>
                                    
                                    <div class="col-span-12 sm:col-span-1 ">
                                        <label for="baggage" class="block text-sm font-medium text-gray-700">Equipaje</label>
                                        <input v-model="form.baggage" type="checkbox" name="baggage" id="baggage" 
                                        class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
                                    </div>

                                    <div class="col-span-12 sm:col-span-1 ">
                                        <label for="guide" class="block text-sm font-medium text-gray-700">Guia</label>
                                        <input v-model="form.guide" type="checkbox" name="guide" id="guide" 
                                        class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
                                    </div>

                                    <div class="col-span-12 sm:col-span-2">
                                        <label for="duration" class="block text-sm font-medium text-gray-700">Duración</label>
                                        <input v-model="form.duration" id="duration" type="number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                                    </div>

                                    <div class="col-span-12 sm:col-span-2">
                                        <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                                        <input v-model="form.price" id="price" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                                    </div>   

                                    <div class="col-span-12 sm:col-span-2">
                                        <label for="cost" class="block text-sm font-medium text-gray-700">Costo</label>
                                        <input v-model="form.cost" id="cost" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                                    </div>   
                                                                        
                                    <div class="col-span-12 sm:col-span-2">
                                        <label for="price" class="block text-transparent text-sm font-medium text-gray-700">Boton guardar</label>
                                        <button @click="submit" class="btn-blue mt-1">Guardar</button>
                                    </div>    
                                </div>                                
                            </div> 
                        </div>
                    </div>                        
                    <div class="md:col-span-3 mt-5">
                        <div class="overflow-x-auto">
                            <table class="w-full whitespace-nowrap">
                                <tr class="text-left font-bold bg-blue-500 text-white text-sm">
                                    <th class="px-5 py-2 text-center">Tipo</th>
                                    <th class="px-5 py-2 text-center">Servicio</th>
                                    <th class="px-5 py-2 text-center">Pax</th>
                                    <th class="px-5 py-2 text-center">Espera</th>
                                    <th class="px-5 py-2 text-center">Equipaje</th>
                                    <th class="px-5 py-2 text-center">Guia</th>
                                    <th class="px-5 py-2 text-center">Duración</th>
                                    <th class="px-5 py-2 text-center">Precio</th>
                                    <th class="px-5 py-2 text-center">Costo</th>
                                    <th class="px-5 py-2 text-center">Acciones</th>
                                </tr>
                                <tr v-for="service in services.data" :key="service.id"
                                    class="hover:bg-gray-100 focus-within:bg-gray-100 text-sm ">
                                        <td class="border-t px-4 py-2 text-left">{{service.services.service_type.description}}</td>
                                        <td class="border-t px-4 py-2 text-left">{{service.services.name}}</td>
                                        <td class="border-t px-4 py-2 text-center">{{service.passenger_capacity}}</td>
                                        <td class="border-t px-4 py-2 text-center">{{service.wait_time}} <span class="text-xs text-gray-600">hs</span></td>
                                        <td class="border-t px-4 py-2 text-center">{{service.baggage}}</td>
                                        <td class="border-t px-4 py-2 text-center">{{service.guide}}</td>
                                        <td class="border-t px-4 py-2 text-center">{{service.duration}} <span class="text-xs text-gray-600">hs</span></td>
                                        <td class="border-t px-4 py-2 text-center"><span class="text-xs text-gray-600">$</span> {{service.price}}</td>
                                        <td class="border-t px-4 py-2 text-center"><span class="text-xs text-gray-600">$</span> {{service.cost}}</td>
                                        <td class="border-t px-4 py-2 text-center">Editar </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
         </div>
</template>

<script>

export default {

    data(){
            // const services = [
            //     {
            //         detail: 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            //         type: 'TRF',
            //         wait_time: 1,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 4,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            //         type: 'TRF VAN',
            //         wait_time: 1,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 7,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            //         type: 'TRF COMBI',
            //         wait_time: 1,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 19,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            //         type: 'TRF MINUBUS',
            //         wait_time: 1,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 24,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            //         type: 'TRF',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 2,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            //         type: 'TRF VAN',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 6,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            //         type: 'TRF COMBI',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 12,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            //         type: 'TRF MINUBUS',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 17,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Palermo o Viceversa',
            //         type: 'TRF',
            //         wait_time: 1,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 4,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Palermo o Viceversa',
            //         type: 'TRF VAN',
            //         wait_time: 1,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 7,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Palermo o Viceversa',
            //         type: 'TRF COMBI',
            //         wait_time: 1,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 19,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Palermo o Viceversa',
            //         type: 'TRF MINUBUS',
            //         wait_time: 1,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 24,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Palermo o Viceversa',
            //         type: 'TRF',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 2,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Palermo o Viceversa',
            //         type: 'TRF VAN',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 6,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Palermo o Viceversa',
            //         type: 'TRF COMBI',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 12,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Ezeiza / Palermo o Viceversa',
            //         type: 'TRF MINUBUS',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 17,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Buquebus / Hotel o Viceversa',
            //         type: 'TRF',
            //         wait_time: 0,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 4,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Buquebus / Hotel o Viceversa',
            //         type: 'TRF VAN',
            //         wait_time: 0,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 7,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Buquebus / Hotel o Viceversa',
            //         type: 'TRF COMBI',
            //         wait_time: 0,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 19,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Buquebus / Hotel o Viceversa',
            //         type: 'TRF MINUBUS',
            //         wait_time: 0,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 24,
            //         duration: null,
            //     },    
            //     {
            //         detail: 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            //         type: 'TRF',
            //         wait_time: 0,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 4,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            //         type: 'TRF VAN',
            //         wait_time: 0,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 7,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            //         type: 'TRF COMBI',
            //         wait_time: 0,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 19,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            //         type: 'TRF MINUBUS',
            //         wait_time: 0,
            //         baggage: 0,
            //         guide: 0,
            //         passenger_capacity: 24,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            //         type: 'TRF',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 2,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            //         type: 'TRF VAN',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 6,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            //         type: 'TRF COMBI',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 12,
            //         duration: null,
            //     },
            //     {
            //         detail: 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            //         type: 'TRF MINUBUS',
            //         wait_time: 1,
            //         baggage: 1,
            //         guide: 1,
            //         passenger_capacity: 17,
            //         duration: null,
            //     },                
            
            // ];

        return {
            tipoServicio: [],
            servicio:[],
            services: [],
            form:{
                baggage : false,
                guide : false
            }
        }
    },

    methods: {
        async getServicesPriceListBase() {
            
            let response = await fetch(route('services_price_list_base.list'), { method: 'GET' })
            this.services = await response.json()

        },
        async getDatas(){

            let response_st = await fetch(route('services_type.list'), { method: 'GET' })
            this.tipoServicio = await response_st.json()

            let response_serv = await fetch(route('services.list'), { method: 'GET' })
            this.servicio = await response_serv.json()

        },

        async submit(){

            if( this.form.tipo_servicio == null 
                || this.form.services_id == null 
                || this.form.wait_time == null 
                || this.form.duration == null 
                || this.form.price == null){
                alert('Debe completar todos los campos')
                return
            }

            let response = await fetch(route('services_price_list_base.store'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(this.form)
            })

            this.getServicesPriceListBase()
            // this.form = {}

        }
    },

    created() {
        this.getDatas()
        this.getServicesPriceListBase();
    },

}
</script>

<style>

</style>
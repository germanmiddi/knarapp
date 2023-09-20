<template>
<!-- eslint-disable -->
    <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-3">
                            <div class="px-4 sm:px-0 flex justify-between items-center mb-3">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Tipo de Servicios</h3>
                                <!-- <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 w-96  shadow-sm sm:text-sm border-gray-300 rounded-md"  placeholder="Buscar"/>
                                <button class="btn-blue">Nuevo Servicio</button> -->
                                
                            </div>
                        </div>
                    </div>                        
                    <div class="md:col-span-3 mt-5">
                        <div class="overflow-x-auto">
                            <table class="w-full whitespace-nowrap">
                                <tr class="text-left font-bold bg-blue-500 text-white">
                                    <th class="px-6 py-3 text-center">Descripción</th>
                                </tr>
                                <tr v-for="service in services.data" :key="service.id"
                                    class="hover:bg-gray-100 focus-within:bg-gray-100 text-sm ">
                                        <td class="border-t px-4 py-2 text-left">{{service.description}}</td>

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
         return {
            services:[],
        }
    },

    methods: {
        async getServices() {
            
            let response = await fetch(route('services_type.list'), { method: 'GET' })
            this.services = await response.json()

        },
    },

    created() {
        this.getServices();
    },

}
</script>

<style>

</style>
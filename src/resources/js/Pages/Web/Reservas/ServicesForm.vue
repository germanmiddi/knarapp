<template>
    <div>
        <div class="px-4 py-5 bg-white sm:p-6">                        
            <div class="grid grid-cols-1 gap-6">
                <div class="col-span-1">
                    <label class="text-base font-medium text-gray-900">Tipo</label>
                    <fieldset class="mt-4">
                        <div class="space-y-4">
                            <div v-for="service_type in serviceTypes" :key="service_type.id" class="flex items-center">
                                <input :id="service_type.id" name="service_type" type="radio" :checked="service_type.id === 1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                                <label :for="service_type.id" class="ml-3 block text-sm font-medium text-gray-700">
                                    {{ service_type.description }}
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                
                <div class="col-span-1">
                    <label for="date" class="block text-sm font-medium text-gray-700">Fecha:</label>

                    <Datepicker id="date" class="w-full mt-1" v-model="form.date"
                        :enableTimePicker="false" :monthChangeOnScroll="false"
                        :minDate="new Date(new Date().setDate(new Date().getDate() - 1))"
                        autoApply :format="format"></Datepicker>
                </div>

                <div class="col-span-1">
                    <label for="time" class="block text-sm font-medium text-gray-700">Hora:</label>

                    <Datepicker id="time" class="w-full mt-1" v-model="form.time"
                        :startTime="startTime" timePicker>
                    </Datepicker>
                </div>


                <div class="col-span-1">
                    <label for="pax_cant"
                        class="block text-sm font-medium text-gray-700">Cant. Pasajeros</label>
                    <input type="number" name="pax_cant" id="pax_cant"
                        v-model="form.pax_cant"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                
                <div class="col-span-1">
                    <label for="guia"
                        class="block text-sm font-medium text-gray-700">Guia</label>
                    <div class="flex items-center"> 
                        <div class="mr-3">
                            <div class="cursor-pointer flex justify-center">
                                <Switch v-model="form.guia"
                                        @click="form.guia = !form.guia"
                                        :class="form.guia ? 'bg-blue-600' : 'bg-gray-200'"
                                        class="relative inline-flex h-6 w-11 items-center rounded-full">
                                        <span :class="form.guia ? 'translate-x-6' : 'translate-x-1'"
                                                class="inline-block h-4 w-4 transform rounded-full bg-white transition"/>
                                </Switch>                
                            </div>
                        </div>                      
                        <!-- <div class="w-4/5">
                            <input type="text" name="guide_name" id="guide_name" v-model="form.guide_name" placeholder="Nombre de guia"
                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div> -->
                    </div>
                </div>

                <div class="col-span-1">
                    <label for="equipaje" class="block text-sm font-medium text-gray-700">Equipaje</label>
                    <div class="flex items-left mt-2">
                        <div class="cursor-pointer flex justify-center">
                            <Switch v-model="form.bagagge"
                                    @click="form.bagagge = !form.bagagge"
                                    :class="form.bagagge ? 'bg-blue-600' : 'bg-gray-200'"
                                    class="relative inline-flex h-6 w-11 items-center rounded-full">
                                    <span :class="form.bagagge ? 'translate-x-6' : 'translate-x-1'"
                                            class="inline-block h-4 w-4 transform rounded-full bg-white transition"/>
                            </Switch>                
                        </div>
                    </div>    
                </div>                                    


                <!-- <div class="col-span-1">
                    <label for="service_id"
                        class="block text-sm font-medium text-gray-700">Servicio</label>
                    
                    <div v-if="services.length == 0 && !loadingServices" class="text-gray-500">No hay servicios para mostrar</div>    
                    <div v-if="loadingServices"><Icons class="w-5 mt-1" name="loading" /></div>
                    <select v-if="!loadingServices && services.length > 0" id="service_id" name="service_id" v-model="form.service" 
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option disabled value="">Seleccione un Servicio</option>
                        <option v-for="service in services" :key="service.id" :value="service">
                            {{ service.name }}
                        </option>
                    </select>
                </div> -->

                <div class="col-span-1">
                    <label for="location_from" class="block text-sm font-medium text-gray-700">Origen:</label>
                    <div style="position: relative; z-index: 1">
                        <LocationSelect :key="`location-from-${locationKey}`" 
                                        :locations="locations" 
                                        @update:selected="updateSelectedLocation" 
                                        :locationType="1"/>
                    </div>
                </div>

                <div class="col-span-1">
                    <label for="location_to" class="block text-sm font-medium text-gray-700">Destino:</label>
                    <LocationSelect :key="`location-to-${locationKey}`" 
                                    :locations="locations" 
                                    @update:selected="updateSelectedLocation" 
                                    :locationType="2" />
                </div>



                <div class="col-span-1">
                    <label for="flight_number"
                        class="block text-sm font-medium text-gray-700">Nro Vuelo</label>
                    <input type="text" name="flight_number" id="flight_number" v-model="form.flight_number"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex justify-between items-center">
            <button @click="clearForm" class="btn-outline-red">Limpiar</button> 
            <button v-if="showUpdateButton" @click="updateService" class="btn-blue">MODIFICAR</button>
            <button v-else @click="createService" class="btn-blue">AGREGAR</button> 
        </div>                
    </div>
</template>

<script>


import { defineComponent, ref } from 'vue'
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import Icons from '@/Layouts/Components/Icons.vue'
import LocationSelect from '../../Manager/Requests/LocationSelect.vue'
import { Switch } from '@headlessui/vue'

export default {

    props: {
        locations: Object,
        client: String,
        serviceTypes: Object,
        service: Object,
        servicesTypesLoading: Boolean,
        serviceTypes: Object
    },
    
    components: {
        Datepicker,
        Icons,
        LocationSelect,
        Switch
    },

    data(){
        return {
            // services_types: "",
            form:{
                guia: false,
                bagagge: false,
            },
            services: {},
            showUpdateButton: false,
            loadingServices: false,
            locationKey: 0,
            enabled: false
        }
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
            startTime,
            
        }
    },
    // un watch para que cuando se envie el service, se asigne el service al form
    watch: {
        service: function (val) {
            this.form = val
            this.showUpdateButton = true
        }
    },

    methods: {
        clearForm(){
            this.form = {}
            this.locationKey++
            this.showUpdateButton = false
        },

        updateService(){
            if(this.form.service === undefined ){
                return 
            }else{
                this.$emit('updateService', this.form)
                this.form = {}
                this.showUpdateButton = false
            }
        },

        createService(){
            console.log('createService')
            this.$emit('createService', this.form)
            this.clearForm()

        },

        updateSelectedLocation(selected, locationType) {
            console.log(selected, locationType)
            if (locationType === 1) {
                this.form.location_from = selected;
            } else if (locationType === 2) {
                this.form.location_to = selected;
            }
        },
    },

}
</script>

<style>

</style>
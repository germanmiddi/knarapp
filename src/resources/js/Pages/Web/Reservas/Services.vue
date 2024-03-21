<template>
    <div class="shadow sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">                        
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-2">
                    <label class="text-base font-medium text-gray-900">Tipo</label>
                    <fieldset class="mt-4">
                        <div class="space-y-4">
                        <div v-for="service_type in serviceTypes" :key="service_type.id" class="flex items-center">
                            <input :id="service_type.id" name="notification-method" type="radio" :checked="service_type.id === 1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                            <label :for="service_type.id" class="ml-3 block text-sm font-medium text-gray-700">
                            {{ service_type.description }}
                            </label>
                        </div>
                        </div>
                    </fieldset>
                </div>
<!-- 
                <div class="col-span-6 sm:col-span-2">
                    <label for="service_type"
                        class="block text-sm font-medium text-gray-700">Tipo</label>
                    <div v-if="servicesTypesLoading"><Icons class="w-5 mt-1" name="loading" /></div>
                    <select v-else id="service_type" name="service_type" @change="getServices" v-model="form.service_type"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option v-for="(description, id) in servicesTypes" :key="id" :value="id">{{ description }}</option>
                    </select>
                </div>        -->

                
                <div class="col-span-6 sm:col-span-2">
                    <label for="date" class="block text-sm font-medium text-gray-700">Fecha:</label>

                    <Datepicker id="date" class="w-full mt-1" v-model="form.date"
                        :enableTimePicker="false" :monthChangeOnScroll="false"
                        :minDate="new Date(new Date().setDate(new Date().getDate() - 1))"
                        autoApply :format="format"></Datepicker>
                </div>

                <div class="col-span-6 sm:col-span-2">
                    <label for="time" class="block text-sm font-medium text-gray-700">Hora:</label>

                    <Datepicker id="time" class="w-full mt-1" v-model="form.time"
                        :startTime="startTime" timePicker>
                    </Datepicker>
                </div>


                <div class="col-span-6 sm:col-span-2">
                    <label for="cellphone"
                        class="block text-sm font-medium text-gray-700">Pasajeros</label>
                    <input type="number" name="cant_pax" id="cant_pax" @keyup="getServices"
                        v-model="form.cant_pax"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                
                <div class="col-span-6 sm:col-span-2">
                    <label for="guia"
                        class="block text-sm font-medium text-gray-700">Guia</label>
                    <select id="guia" name="guia" @change="getServices" v-model="form.guia"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0">Sin Guia</option>
                        <option value="1">Con Guia</option>
                    </select>
                    <div class="cursor-pointer flex justify-center">
                        <Switch v-model="service.csp_active"
                                @click="toggleActive(service.guia)"
                                :class="service.guia ? 'bg-blue-600' : 'bg-gray-200'"
                                class="relative inline-flex h-6 w-11 items-center rounded-full">
                                <span :class="service.csp_active ? 'translate-x-6' : 'translate-x-1'"
                                      class="inline-block h-4 w-4 transform rounded-full bg-white transition"/>
                        </Switch>                
                    </div>                      
                </div>                                    

                <div class="col-span-6 sm:col-span-2">
                    <label for="equipaje"
                        class="block text-sm font-medium text-gray-700">Equipaje</label>
                    <select id="equipaje" name="equipaje" @change="getServices" v-model="form.equipaje"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0">Sin Equipaje</option>
                        <option value="1">Con Equipaje</option>
                    </select>
                </div>                                    


                <div class="col-span-6 sm:col-span-6">
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
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <label for="location_from" class="block text-sm font-medium text-gray-700">Origen:</label>

                    <div style="position: relative; z-index: 1">
                        <LocationSelect :key="`location-from-${locationKey}`" :locations="locations" @update:selected="updateSelectedLocation" :locationType="1"/>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <label for="location_to" class="block text-sm font-medium text-gray-700">Destino:</label>
                    <LocationSelect :key="`location-to-${locationKey}`" :locations="locations" @update:selected="updateSelectedLocation" :locationType="2" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="guide_name"
                        class="block text-sm font-medium text-gray-700">Nombre Guia</label>
                    <input type="text" name="guide_name" id="guide_name" v-model="form.guide_name"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="flight_number"
                        class="block text-sm font-medium text-gray-700">Nro Vuelo</label>
                    <input type="text" name="flight_number" id="flight_number" v-model="form.flight_number"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <!-- <div class="col-span-6 sm:col-span-6">
                    <label for="location_from" class="block text-sm font-medium text-gray-700">Origen:</label>
                    <input type="text" list="locations_from" v-model="form.location_from" id="location_from" 
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <datalist id="locations_from">
                    <option v-for="loc in locations" :value="loc.name" :key="loc.id" >{{ loc.name }}</option>
                    </datalist>
                </div>

                <div class="col-span-6 sm:col-span-6">
                    <label for="location_to" class="block text-sm font-medium text-gray-700">Destino:</label>
                    <input type="text" list="locations_to" v-model="form.location_to" id="location_to"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <datalist id="locations_to">
                    <option v-for="loc in locations" :value="loc.name" :key="loc.id" >{{ loc.name }}</option>
                    </datalist>
                </div> -->
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
            form:{},
            services: {},
            showUpdateButton: false,
            loadingServices: false,
            locationKey: 0
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

            if(this.form.service === undefined ){
                return 
            }else{
                this.$emit('createService', this.form)
                this.form = {}
            }
        },

        async getServices(){
            
            if (this.client === undefined) {
                return
            }

            this.loadingServices = true
            let filter = `client_id=${this.client}`


            if (this.form.service_type !== undefined) {
				filter += `&service_type=${this.form.service_type}`
			}

            if (this.form.cant_pax > 0) {
				filter += `&pax=${this.form.cant_pax}`
			}

            // let type = typeof(this.form.guia)
            // console.log(type)

            if (this.form.guia !== undefined) {
				filter += `&guia=${this.form.guia}`
			}

            if (this.form.equipaje !== undefined) {
				filter += `&equipaje=${this.form.equipaje}`
			}


            let get = `${route('services.filter')}?${filter}`  ;

            let response = await fetch(get, {method: 'GET',})             

            if (response.status == 200){
                this.services = await response.json()
            }
            this.loadingServices = false

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
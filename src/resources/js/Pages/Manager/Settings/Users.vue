<template>
    <!-- eslint-disable -->
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-3">
                                <div class="px-4 sm:px-0 flex justify-between items-center mb-3">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Lista de Servicios</h3>                              
                                </div>
                            </div>
                        </div>   
                        <div>
                            <!-- <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 sm:col-span-4 ">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Tipo</label>
                                    <select v-model="form.tipo_servicio" id="tipo_servicio" name="tipo_servicio"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option v-for="row in tipoServicio.data" :key="row.id" :value="row.id">
                                                {{ row.description }}</option>
                                    </select>
                                </div>
    
                                <div class="col-span-12 sm:col-span-4">
                                    <label for="service" class="block text-sm font-medium text-gray-700">Servicio</label>
                                    <input v-model="form.name" id="service" name="service" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >        
                                </div>
    
                                <div class="col-span-12 sm:col-span-3">
                                    <label for="price" class="block text-transparent text-sm font-medium text-gray-700">Boton guardar</label>
                                    <div v-if="form.id" class="flex items-ceter">
                                        <button  @click="update" class="btn-blue mr-2 mt-1">Guardar</button>
                                        <button  @click="form = {}" class="btn-warning mt-1 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none  disabled:opacity-25 transition">Cancelar</button>
                                    </div>    
                                    
                                    <button v-else @click="submit" class="btn-blue mt-1">Crear Servicio</button>
                                </div>    
                            </div>                                 -->
                        </div> 
    
                        <div class="md:col-span-3 mt-5">
                            <div class="overflow-x-auto">
                                <table class="w-full whitespace-nowrap">
                                    <tr class="text-left font-bold bg-blue-500 text-white">
                                        <th class="px-6 py-3 text-left">Nombre</th>
                                        <th class="px-6 py-3 text-left">E-Mail</th>
                                        <th class="px-6 py-3 text-center">Rol</th>
                                        <th class="px-6 py-3 text-center">Active</th>
                                        <th class="px-6 py-3 text-center">Acción</th>
        
                                    </tr>
                                    <tr v-for="user in users.data" :key="user.id"
                                        class="hover:bg-gray-100 focus-within:bg-gray-100 text-sm ">
                                            <td class="border-t px-4 py-2 text-left">{{user.name}}</td>
                                            <td class="border-t px-4 py-2 text-left">{{user.email}}</td>
                                            <td class="border-t px-4 py-2 text-center">{{user.roles[0].name}}</td>
                                            <td class="border-t px-4 py-2 text-center">{{user.is_active}}</td>
                                            <td class="border-t px-4 py-2 text-center">
                                                <button class="inline-flex items-center px-2 py-1 border border-gray-200 rounded-md text-gray-800 bg-gray-100 hover:bg-blue-400 hover:text-white"
                                                        @click="fillForm(user)">
                                                            <PencilIcon class="h-3 w-3  mr-2 " aria-hidden="true" /> Editar </button>
                                            </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
    </template>
    
    <script>
    
    import { PencilIcon } from '@heroicons/vue/24/outline'

    export default {
        
        components: {
            PencilIcon
        },
        data(){
            return {
                users:[],
                tipoServicio:[],
                form:{},
            }
        },
    
        methods: {
            async getUsers() {
                let url = route('settings.users.list')
                
                let response_st = await fetch( url , { method: 'GET' })
                this.users = await response_st.json()
            },
    
            // async submit() {
            //     let response = await fetch(route('settings.services.store'), {
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json',
            //             'Accept': 'application/json',
            //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')                    
            //         },
            //         body: JSON.stringify(this.form)
            //     })
    
            //     this.form = {}
            //     this.getServices()
            // },
    
            // async update() {
            //     let response = await fetch(route('settings.users.list'), {
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json',
            //             'Accept': 'application/json',
            //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')                    
            //         },
            //         body: JSON.stringify(this.form)
            //     })
    
            //     this.form = {}
            //     this.getServices()
            // },
        },
    
        created() {
            this.getUsers();
        },
    
    }
    </script>
    
<template>
    <div>
        <div class="px-4 sm:px-0 mt-12 flex justify-between items-center">
          <h3 class="text-base font-semibold leading-7 text-gray-900">Items del Viaje</h3>
          <button class="btn-blue" @click="showNewItem =! showNewItem">Nuevo Item</button>
        </div>
        
        <div class="mt-8" v-show="showNewItem">
            <form class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-5 sm:gap-4">
                <div class="col-span-2">
                  <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
                  <input v-model="newItem.description" type="text" name="description" id="description" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-2">
                  <label for="price" class="block text-sm font-medium text-gray-700">Precio:</label>
                  <input v-model="newItem.price" type="number" name="price" id="price" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-1">
                  <button @click.prevent="addItem" class="btn-blue w-full mt-6">Agregar Item</button>
                </div>
              </form>
        </div>       

        <div class="mt-8 border-t border-gray-100">
          <dl class="divide-y divide-gray-100">

            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                v-for="item in items" :key="item.id" >
                <dt class="text-sm font-medium leading-6 text-gray-900 sm:col-span-2 pl-5 flex justify-between">
                    <div>{{ item.description }}</div>
                </dt>

                
                <dd class="flex items-center justify-end pr-2">
                    <span class="mr-2 font-sm">$ {{ item.price }}</span>
                    <div class="flex">
                        <Menu as="div" class="inline-node relative">
                            <div>
                                <MenuButton class="border border-gray-200 p-1 rounded-full hover:bg-gray-100">
                                    <EllipsisVerticalIcon class="w-4 text-gray-700" aria-hidden="true"/>
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition ease-out duration-100"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="origin-top-left absolute z-50 right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <a href="#" @click.prevent="fillForm(item.id)" class="text-gray-900 block px-4 py-2 text-sm pointer-events hover:bg-gray-100 text-left">
                                            Editar</a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a href="#" @click.prevent="deleteItem(item.id)" class="text-gray-900 block px-4 py-2 text-sm pointer-events hover:bg-gray-100 text-left">
                                            Borrar</a>
                                        </MenuItem>
                                    </div>

                                </MenuItems>
                            </transition>
                        </Menu>
                        
                        <!-- <a type="button" href="#" class="ml-2 inline-flex items-center p-1 border border-gray-200 rounded-md text-white bg-gray-100 
                                    hover:bg-gray-300">
                            <ChevronRightIcon @click="open = true" class="h-4 w-4 text-gray-700" aria-hidden="true" /></a> -->
                    </div>
                </dd>
                    

                <!-- <dd class="mt-1 pr-8 text-base leading-6 text-gray-700 sm:mt-0 flex flex-col items-end ">
                    <span >$ {{ item.price }}</span>
                    
                    <div class="flex gap-1">
                        <div class="bg-gray-100 p-2 rounded-lg text-xs  hover:bg-gray-200 flex">
                            <PencilIcon class="w-3 mr-1 text-blue-400"/>Editar</div>
                        <div class="bg-gray-100 p-2 rounded-lg text-xs  hover:bg-gray-200 flex">
                            <TrashIcon class="w-3 mr-1 text-red-400"/>Borrar</div>
                    </div>            
                </dd> -->
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-base font-bold leading-6 text-gray-900 sm:col-span-2 text-right pl-5">Total:</dt>
                <dd class="mt-1 pr-8 text-base leading-6 font-bold text-gray-900 sm:mt-0 text-right">$ {{ total }}</dd>
              </div>
          </dl>
        </div>
    </div>    
</template>

<script>
import { TrashIcon, PencilIcon, EllipsisVerticalIcon } from '@heroicons/vue/24/outline';
import {Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'

export default {
    props:{
        items:{
            type: Object,
            required: true
        },
        requestService:{
            type: Object,
            required: true
        },
    },
    components: {
        TrashIcon,
        PencilIcon,
        EllipsisVerticalIcon,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,        
    },

    data() {
        
        return {
            editableService: this.requestService,
            showNewItem: false,
            toastMessage: "",
            newItem: {
                description: "",
                price: null,
            },
            total: this.requestService.total

        }
    },    
    methods:{

        async addItem() {
            // Validar que se haya ingresado una descripción y un precio
            if (!this.newItem.description || !this.newItem.price) {
                return;
            }
            
            const url = route('requestServicesItem.store')
            const data = {
                request_service_id: this.requestService.id,
                request_id: this.requestService.requests_id,

                description: this.newItem.description,
                price: this.newItem.price,
            }

            const response = await axios.post(url, data)

            alert(response.data.message)
            
            console.log(this.total)
            this.total = response.data.total
            console.log(response.data.total)

            // Agregar el nuevo item a la lista de items
            this.items.push({
                description: this.newItem.description,
                price: parseFloat(this.newItem.price),
            });
            // Limpiar el formulario
            this.newItem.description = "";
            this.newItem.price = null;
        }
    }
}
</script>

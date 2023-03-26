<template>
    <div class="content flex-grow flex flex-col justify-between" >
        <!-- :class="[store.sidebarCollapse ? 'md:pl-16 lg:pl-64' : 'md:pl-16' ]"> -->
    
        <div class="md:hidden relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:border-none">
        <button type="button" class="px-4 border-r border-gray-200 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden" @click="store.mobileSidebar = true">
            <span class="sr-only">Open sidebar</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
        </button>
        </div>

        <!-- <div class="m-5"> -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">            
            <!-- <div class="content flex-grow flex flex-col justify-between">
            </div>                   -->
                <!-- Component Start -->

                <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-2 w-full max-w-6xl mt-5 md:mt-8">
                    
                    <div class="col-span-3 mx-6 text-3xl font-bold"><h1>Datos Mes:</h1></div>

                    <div class="col-span-3 md:col-span-1 card rounded-xl shadow">
                        <div class="card-body px-2 py-5 flex items-center" >
                            <div class="">
                                <Icons name="shopping-cart" class="w-10 h-10 mx-4 text-indigo-500"></Icons>
                            </div>    
                            <div class="flex-grow flex flex-col px-2">
                                <div class="text-sm text-gray-500">Cantidad Pedidos</div>
                                <div class="flex items-center justify-between">
                                    <div class="font-bold text-2xl"></div>
                                    <span class="text-green-600 text-sm font-bold bg-green-100 py-1 px-2 rounded-xl"> %</span>
                                </div>
                            </div>   
                        </div>
                        <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                            <div class="mx-4 text-indigo-500 font-bold">
                                <!-- <a :href="route('order.list')">Ver todo</a> -->
                            </div>    
                        </div>
                    </div>

                    <div class="col-span-3 md:col-span-1 card rounded-xl shadow">
                        <div class="card-body px-2 py-5 flex items-center" >
                            <div class="">
                                <Icons name="file" class="w-10 h-10 mx-4 text-sky-500"></Icons>
                            </div>    
                            <div class="flex-grow flex flex-col px-2">
                                <div class="text-sm text-gray-500">Cantidad Facturas Emitidas</div>
                                <div class="flex items-center justify-between">
                                    <div class="font-bold text-2xl"></div>
                                    <span class="text-green-600 text-sm font-bold bg-green-100 py-1 px-2 rounded-xl"> %</span>
                                </div>
                            </div>   
                        </div>
                        <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                            <div class="mx-4 text-sky-500 font-bold">
                                <!-- <a :href="route('order.list')">Ver todo</a> -->
                            </div>    
                        </div>
                    </div>

                    <div class="col-span-3 md:col-span-1 card rounded-xl shadow">
                        <div class="card-body px-2 py-5 flex items-center" >
                            <div class="">
                                <Icons name="truck" class="w-10 h-10 mx-4 text-blue-500"></Icons>
                            </div>    
                            <div class="flex-grow flex flex-col px-2">
                                <div class="text-sm text-gray-500">Cantidad de Guías</div>
                                <div class="flex items-center justify-between">
                                    <div class="font-bold text-2xl"></div>
                                    <span class="text-green-600 text-sm font-bold bg-green-100 py-1 px-2 rounded-xl"></span>
                                </div>
                            </div>   
                        </div>
                        <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                            <div class="mx-4 text-blue-500 font-bold">
                                <!-- <a :href="route('order.list')">Ver todo</a> -->
                            </div>    
                        </div>
                    </div>
                    
                </div>
                <!-- Component End  -->
        </div>
    </div>  
</template>

<script>
    import Icons from '@/Layouts/Components/Icons.vue'
    import store from '@/store.js'
    import { Bars3Icon } from '@heroicons/vue/24/outline'

    export default {
        props:{

        },
        components: {
            Icons,
            Bars3Icon
        },
        data() {
            return {
                store,        
            }
        }
    }
</script>
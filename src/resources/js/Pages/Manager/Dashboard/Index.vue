<template>
    <div class="w-full" >
        
        <div >
            <!-- <div class="md:hidden "> it is SMALL  </div>
            <div class="sm:hidden md:block lg:hidden"> it is Medium  </div>
            <div class="md:hidden lg:block"> it is Large  </div>
            <div class="hidden lg:block"> it is Extra Large  </div> -->


        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">            
            <div class="grid grid-cols-4 gap-2 w-full max-w-7xl mt-5 md:mt-8">
                
                <div class="col-span-4 mx-6 text-3xl font-bold"><h1>Estadísticas de Febrero:</h1></div>

                <div class="col-span-2 lg:col-span-1 card rounded-xl shadow">
                    <div class="card-body px-2 py-5 flex items-center" >
                        <div class="">
                            <CalendarIcon class="w-10 h-10 mx-4 text-indigo-500" />
                        </div>    
                        <div class="flex-grow flex flex-col px-2">
                            <div class="text-sm text-gray-500">Solicitudes</div>
                            <div class="flex items-center justify-between">
                                <div class="font-bold text-2xl">100</div>
                                <span class="text-green-600 text-sm font-bold bg-green-100 py-1 px-2 rounded-xl"> 30%</span>
                            </div>
                        </div>   
                    </div>
                    <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                        <div class="mx-4 text-indigo-500 font-bold">
                            <a href="#">Ver todo</a>
                        </div>    
                    </div>
                </div>

                <div class="col-span-2 lg:col-span-1 card rounded-xl shadow">
                    <div class="card-body px-2 py-5 flex items-center" >
                        <div class="">
                            <Icons name="file" class="w-10 h-10 mx-4 text-sky-500"></Icons>
                        </div>    
                        <div class="flex-grow flex flex-col px-2">
                            <div class="text-sm text-gray-500">Viajes Realizados</div>
                            <div class="flex items-center justify-between">
                                <div class="font-bold text-2xl">80</div>
                                <span class="text-green-600 text-sm font-bold bg-green-100 py-1 px-2 rounded-xl"> 20%</span>
                            </div>
                        </div>   
                    </div>
                    <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                        <div class="mx-4 text-sky-500 font-bold">
                            <a href="#">Ver todo</a>
                        </div>    
                    </div>
                </div>

                <div class="col-span-2 lg:col-span-1 card rounded-xl shadow">
                    <div class="card-body px-2 py-5 flex items-center" >
                        <div class="">
                            <Icons name="mapmarkertime" class="w-10 h-10 mx-4 text-blue-500"></Icons>
                        </div>    
                        <div class="flex-grow flex flex-col px-2">
                            <div class="text-sm text-gray-500">Excursiones</div>
                            <div class="flex items-center justify-between">
                                <div class="font-bold text-2xl">36</div>
                                <span class="text-green-600 text-sm font-bold bg-green-100 py-1 px-2 rounded-xl"> 10%</span>
                            </div>
                        </div>   
                    </div>
                    <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                        <div class="mx-4 text-blue-500 font-bold">
                            <a href="#">Ver todo</a>
                        </div>    
                    </div>
                </div>

                <div class="col-span-2 lg:col-span-1 card rounded-xl shadow">
                    <div class="card-body px-2 py-5 flex items-center" >
                        <div class="">
                            <Icons name="tranfer" class="w-10 h-10 mx-4 text-blue-500"></Icons>
                        </div>    
                        <div class="flex-grow flex flex-col px-2">
                            <div class="text-sm text-gray-500">Traslados</div>
                            <div class="flex items-center justify-between">
                                <div class="font-bold text-2xl">44</div>
                                <span class="text-red-600 text-sm font-bold bg-red-100 py-1 px-2 rounded-xl"> -5%</span>
                            </div>
                        </div>   
                    </div>
                    <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                        <div class="mx-4 text-blue-500 font-bold">
                            <a href="#">Ver todo</a>
                        </div>    
                    </div>
                </div>
                
            </div>
        </div>
    </div>  
</template>

<script>
    import Icons from '@/Layouts/Components/Icons.vue'
    import store from '@/store.js'
    import { Bars3Icon,
             XMarkIcon,
             CalendarIcon
            } from '@heroicons/vue/24/outline'

    export default {
        props:{

        },
        components: {
            Bars3Icon,
            CalendarIcon     
        },
    
        setup(){
            
        },

        data() {

            const orders = [
                {
                    id: '1',
                    fecha : '25/02/2023',
                    hora: '10:30',
                    client: 'Agencia ABC',
                    origen : 'Ezeiza',
                    destino: 'Hotel Colonial',
                    pasajeros: '4',
                    status: 'PROGRAMADO',
                },
                {
                    id: '2',
                    fecha : '27/02/2023',
                    hora: '07:00',
                    client: 'Agencia ABC',
                    origen : 'Hotel Alvear',
                    destino: 'Estancia La Linda',
                    pasajeros: '4',
                    status: 'PROGRAMADO',
                },
                {
                    id: '3',
                    fecha : '27/02/2023',
                    hora: '07:00',
                    client: 'Agencia ABC',
                    origen : 'Hotel Alvear',
                    destino: 'Estancia La Linda',
                    pasajeros: '4',
                    status: 'PROGRAMADO',
                },
                {
                    id: '3',
                    fecha : '',
                    hora: '',
                    client: '',
                    origen : '',
                    destino: '',
                    pasajeros: '',
                    status: '',
                },

            ];



            return {
                store,    
                btnTextMap: '', 
                filterBtn: true,
                showFilter: true,
                orders: orders,
                filter: {
                    street: "",
                    client: "",
                    driver: "",
                    status: "TODOS",
                    date: [
                        new Date(new Date().getTime() - 7 * 24 * 60 * 60 * 1000 - 3600000 * 3),
                        new Date(new Date().getTime() - 3600000 * 3)
                    ]
                    //new Date(this.form.date + "T00:00:00.000-03:00")
                },                   
            }
        },
        methods:{
            // showMap() {
            //     this.showFilter = !this.showFilter
            //     if (this.showFilter) {
            //         this.btnTextMap = 'Ver Listado'
            //     } else {
            //         this.btnTextMap = 'Ver Mapa'
            //     }
            // },
        }
    }
</script>
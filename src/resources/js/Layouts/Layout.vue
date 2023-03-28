<template>
  
  <div class="min-h-screen bg-gray-100">

    <Navbar />

    <!-- Page Heading -->
    <!-- <header class="bg-white shadow" v-if="$slots.header"> -->
    <!-- <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <slot name="heading"></slot>
        </div>
    </header> -->

    <!-- <Sidebar /> -->
    

      <!-- <div class="content flex-grow flex flex-col justify-between" 
        :class="[store.sidebarCollapse ? 'md:pl-16 lg:pl-64' : 'md:pl-16' ]">
        soy el top bar
        </div> -->
     <slot></slot>


  </div>

</template>

<script>
    import Sidebar from '@/Layouts/Sidebar/Sidebar.vue'
    import Navbar  from '@/Layouts/Navbar/Navbar.vue'
    import store from '@/store.js'


    export default {
        components: {
            Sidebar,
            Navbar        
        },  
        data() {
            return {
                store,        
            }
        }        
    }
</script>

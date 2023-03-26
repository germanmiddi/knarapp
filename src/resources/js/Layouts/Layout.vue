<template>
  
  <div class="min-h-full">

    <Navbar />

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

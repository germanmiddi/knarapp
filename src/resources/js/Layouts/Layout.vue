<template>
  
    <div class="min-h-screen bg-gray-100">

        <Navbar />
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

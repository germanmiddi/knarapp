import { reactive } from 'vue'

const store = reactive({

    sidebarCollapse: true,
    miniSidebarCollapse: false,
    collapseSidebar(){
        this.sidebarCollapse = !this.sidebarCollapse
        this.miniSidebarCollapse = !this.miniSidebarCollapse
    },
    mobileSidebar: false,
    showNavbar: true,
    hideSidebar : function() {
        this.sidebarCollapse = false
        this.miniSidebarCollapse = false
        this.showNavbar = true
    }

})

export default store
<template>
  <div v-if="store.showNavbar" class="min-h-full hidden md:block">
    <Disclosure as="nav" class="bg-white border-b border-gray-200" v-slot="{ open }">
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex">
            <div class="flex-shrink-0 flex items-center">
              <img src="/images/logo-knar.png" class="w-28" alt="">
            </div>
            <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
              <a v-for="item in navigation" :key="item.name" 
                 :href="route(item.href)" 
                 :class="[route().current(item.href) ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium']" 
                 :aria-current="route().current(item.href) ? 'page' : undefined">
                {{ item.name }}
              </a>
              <div @click="logout" class="flex items-center px-2 py-2 hover:text-red-600 hover:bg-gray cursor-pointer text-gray-500 ">
                <PowerIcon class="mr-2 flex-shrink-0 h-4 w-4" />
                <span  class="text-xs font-medium hidden lg:block">Cerrar Sesión</span>
              </div> 
            </div>
          </div>
          <div class="text-xs text-gray-600">
            Hola {{ $page.props.user.name  }}<br>
            {{ $page.props.userRoles[0].name }}
             
          </div>
          <!-- <div class="hidden sm:ml-6 sm:flex sm:items-center">

            <Menu as="div" class="ml-3 relative">
              <div>
                <MenuButton class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <img class="h-8 w-8 rounded-full" :src="user.imageUrl" alt="" />
                  <div> </div>
                </MenuButton>
              </div>
              <transition enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                  <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                    <a :href="route(item.href)" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                      {{ item.name }}
                    </a>
                  </MenuItem>
                </MenuItems>
              </transition>
            </Menu>
          </div> -->
        </div>
      </div>

    </Disclosure>
  </div>
  
</template>



<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { RocketLaunchIcon, PowerIcon } from '@heroicons/vue/24/outline'
import store from '@/store.js'

const navigation = [
  { name: 'Dashboard', href: 'dashboard', current: true },
  { name: 'Solicitudes', href: 'request', current: false },
  { name: 'Viajes', href: 'services', current: false },
  { name: 'Clientes', href: 'client', current: false },
  { name: 'Choferes', href: 'drivers', current: false },
  // { name: 'Servicios', href: 'client', current: false },
  // { name: 'Reportes', href: 'client', current: false },
  { name: 'Configuración', href: 'setting', current: false },
]

export default {
  components: {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    RocketLaunchIcon,
    MenuItems,
    PowerIcon
    // BellIcon,
    // MenuIcon,
    // XIcon,
  },
  setup() {
    return {
      navigation,
      store
    }
  },
  methods: {
    logout() {
      this.$inertia.post(route('logout'));
    }
  }
}
</script>

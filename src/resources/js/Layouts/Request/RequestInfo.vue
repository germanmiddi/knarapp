<template>
    <div>
        <div class="px-4 sm:px-0">
          <h3 class="text-base font-semibold leading-7 text-gray-900">Información General de solicitud</h3>
          <!-- <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Detalles de la reserva</p> -->
        </div>
        <div class="mt-6 border-t border-gray-100">
          <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-xs font-medium leading-6 text-gray-900">Cliente</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ request.client.company_name }}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-xs font-medium leading-6 text-gray-900">Recibido</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ formatDate(request.created_at) }}</dd>
            </div>
            <!-- <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">margotfoster@example.com</dd>
            </div> -->
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-xs font-medium leading-6 text-gray-900">Responsable</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ request.client.fullname}}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-xs font-medium leading-6 text-gray-900">Notas</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> 2 Aguas</dd>
            </div>
          </dl>
        </div>
    </div>   
</template>

<script>
import { ref } from 'vue'


export default {
    props: {
        request: {
            type: Object,
            required: true
        }
    },
    setup(props) {
        
        const request = ref(props.request);
                
  
        const formatDate = (date) => {
            return new Date(date).toLocaleDateString();
        }

        return {
            request,
            formatDate
        }
    }
}

</script>

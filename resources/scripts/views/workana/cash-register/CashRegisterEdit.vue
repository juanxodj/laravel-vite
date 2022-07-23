<template>
  <BasePageHeading title="Cajas">
    <template #extra>
      <router-link :to="{ name: 'cash-register' }">
        <button type="button" class="btn btn-alt-primary" v-click-ripple>
          <i class="fa fa-arrow-left-long opacity-50 me-1"></i>
          Regresar
        </button>
      </router-link>
    </template>
  </BasePageHeading>

  <div class="content">
    <BaseBlock :title="`Editar Caja #${route.params.id}`">
      <form @submit.prevent="updateData" class="mb-4">
        <div class="row">
          <div class="col-md-12">
            <label class="form-label">Descripción</label>
            <input type="text" class="form-control" v-model="form.description">
          </div>
          <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </div>
      </form>
    </BaseBlock>
  </div>
</template>

<script setup lang="ts">
import { CashRegister } from '@/scripts/models/cash-register.model'
import { onMounted, reactive } from 'vue'
import { Toast } from "@/scripts/mixins/toast"
import { useRoute, useRouter } from 'vue-router'
import api from '@/scripts/services/api'

onMounted(() => {
  editData()
})

const initialForm = {
  description: ""
}
const form = reactive<CashRegister>({ ...initialForm })
const route = useRoute()
const router = useRouter()

function editData() {
  api.get(`/cash-registers/${route.params.id}`)
    .then((res) => {
      if (res.status === 200) {
        Object.assign(form, res.data.data)
      }
    })
    .catch((err) => {
      console.log(err.response.data.errors)
    })
}

function updateData() {
  api.put(`/cash-registers/${route.params.id}`, form)
    .then(() => {
      Object.assign(form, initialForm)
      router.push({ name: 'cash-register' })
      Toast.fire({
        icon: 'success',
        title: 'Actualizado Correctamente'
      })
    })
    .catch((err) => {
      console.log(err.response.data.errors)
    })
}
</script>

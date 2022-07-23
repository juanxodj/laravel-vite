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
    <BaseBlock title="Agregar Caja">
      <form @submit.prevent="addData" class="mb-4">
        <div class="row">
          <div class="col-md-12">
            <label class="form-label">Descripción</label>
            <input type="text" class="form-control" v-model="form.description">
          </div>
          <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </form>
    </BaseBlock>
  </div>
</template>

<script setup lang="ts">
import { CashRegister } from '@/scripts/models/cash-register.model'
import { reactive } from 'vue'
import { Toast } from "@/scripts/mixins/toast"
import { useRouter } from 'vue-router'
import api from '@/scripts/services/api'

const initialForm = {
  description: ""
}
const form = reactive<CashRegister>({ ...initialForm })
const router = useRouter()

function addData() {
  api.post(`/cash-registers`, form)
    .then((res) => {
      Object.assign(form, res.data.data)
      router.push({ name: 'cash-register' })
      Toast.fire({
        icon: 'success',
        title: 'Guardado Correctamente'
      })
    })
    .catch((err) => {
      console.log(err.response.data.errors)
    });
}
</script>

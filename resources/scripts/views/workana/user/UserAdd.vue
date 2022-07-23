<template>
  <BasePageHeading title="Usuarios">
    <template #extra>
      <router-link :to="{ name: 'user' }">
        <button type="button" class="btn btn-alt-primary" v-click-ripple>
          <i class="fa fa-arrow-left-long opacity-50 me-1"></i>
          Regresar
        </button>
      </router-link>
    </template>
  </BasePageHeading>

  <div class="content">
    <BaseBlock title="Agregar Usuarios">
      <form @submit.prevent="addData" class="mb-4">
        <div class="row">
          <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" v-model="form.name">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" v-model="form.email">
          </div>
          <div class="col-md-6">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" v-model="form.password">
          </div>
          <div class="col-md-6">
            <label class="form-label">Activo</label>
            <select class="form-select" v-model="form.is_active">
              <option :value="true">Si</option>
              <option :value="false">No</option>
            </select>
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
import { User } from '@/scripts/models/user.model'
import { reactive } from 'vue'
import { Toast } from "@/scripts/mixins/toast"
import { useRouter } from 'vue-router'
import api from '@/scripts/services/api'

const initialForm = {
  name: "",
  email: "",
  password: "",
  is_active: true
}
const form = reactive<User>({ ...initialForm })
const router = useRouter()

function addData() {
  api.post(`/users`, form)
    .then((res) => {
      Object.assign(form, res.data.data)
      router.push({ name: 'user' })
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

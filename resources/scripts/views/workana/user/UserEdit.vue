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
    <BaseBlock :title="`Editar Producto #${route.params.id}`">
      <form @submit.prevent="updateData" class="mb-4">
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
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </div>
      </form>
    </BaseBlock>
  </div>
</template>

<script setup lang="ts">
import { User } from '@/scripts/models/user.model'
import { onMounted, reactive } from 'vue'
import { Toast } from "@/scripts/mixins/toast"
import { useRoute, useRouter } from 'vue-router'
import api from '@/scripts/services/api'

onMounted(() => {
  editData()
})

const initialForm = {
  name: "",
  email: "",
  password: "",
  is_active: true
}
const form = reactive<User>({ ...initialForm })
const route = useRoute()
const router = useRouter()

function editData() {
  api.get(`/users/${route.params.id}`)
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
  api.put(`/users/${route.params.id}`, form)
    .then(() => {
      Object.assign(form, initialForm)
      router.push({ name: 'user' })
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

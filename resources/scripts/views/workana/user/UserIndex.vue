<template>
  <IndexView :title="title" :title-block="titleBlock" :fields-search="fieldsSearch" :route-fetch="routeFetch"
    :route-name="routeName" :columns="columns" :model-name="modelName" />
</template>

<script setup lang="ts">
import IndexView from '@/scripts/components/IndexView.vue'

const title = "Usuarios"
const titleBlock = "Lista de Usuarios"
const fieldsSearch = ['name', 'email', 'is_active']
const routeFetch = 'users'
const routeName = 'user'
const modelName = 'User'
const columns = [
  {
    name: "Nombre",
    field: "name",
    sort: "",
  },
  {
    name: "Correo Electrónico",
    field: "email",
    sort: "",
  },
  {
    name: "Activo",
    field: "is_active",
    sort: "",
  },
  {
    name: "Acciones",
    field: "action",
    sort: "",
  },
];
</script>

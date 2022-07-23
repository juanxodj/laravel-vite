<template>
  <IndexView :title="title" :title-block="titleBlock" :fields-search="fieldsSearch" :route-fetch="routeFetch"
    :route-name="routeName" :columns="columns" :model-name="modelName" />
</template>

<script setup lang="ts">
import IndexView from '@/scripts/components/IndexView.vue'

const title = "Productos"
const titleBlock = "Lista de Productos"
const fieldsSearch = ['description', 'price']
const routeFetch = 'products'
const routeName = 'product'
const modelName = 'Product'
const columns = [
  {
    name: "Descripción",
    field: "description",
    sort: "",
  },
  {
    name: "Precio",
    field: "price",
    sort: "",
  },
  {
    name: "Acciones",
    field: "action",
    sort: "",
  },
];
</script>

<template>
  <IndexView :title="title" :title-block="titleBlock" :fields-search="fieldsSearch" :route-fetch="routeFetch"
    :route-name="routeName" :columns="columns" :model-name="modelName" />
</template>

<script setup lang="ts">
import IndexView from '@/scripts/components/IndexView.vue'

const title = "Cajas"
const titleBlock = "Lista de Cajas"
const fieldsSearch = ['description']
const routeFetch = 'cash-registers'
const routeName = 'cash-register'
const modelName = 'CashRegister'
const columns = [
  {
    name: "Descripción",
    field: "description",
    sort: "",
  },
  {
    name: "Acciones",
    field: "action",
    sort: "",
  },
];
</script>

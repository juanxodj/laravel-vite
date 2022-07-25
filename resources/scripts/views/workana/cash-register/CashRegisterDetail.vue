<template>
  <IndexView :title="title" :title-block="titleBlock" :fields-search="fieldsSearch" :route-fetch="routeFetch"
    :route-name="routeName" :columns="columns" :model-name="modelName" />
</template>

<script setup lang="ts">
import IndexView from '@/scripts/components/IndexView.vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const title = "Detalle de Caja"
const titleBlock = "Historial de Caja"
const fieldsSearch = ['opening', 'closing', 'initial_balance', 'ending_balance', 'status']
const routeFetch = `cash-registers/${route.params.id}/detail`
const routeName = 'cash-register.detail'
const modelName = 'CashRegister'
const columns = [
  {
    name: "Apertura",
    field: "opening",
    sort: "",
  },
  {
    name: "Cerrado",
    field: "closing",
    sort: "",
  },
  {
    name: "Balance Inicial",
    field: "initial_balance",
    sort: "",
  },
  {
    name: "Balance Final",
    field: "ending_balance",
    sort: "",
  },
  {
    name: "Estado",
    field: "status",
    sort: "",
  },
  {
    name: "Acciones",
    field: "action",
    sort: "",
  },
];
</script>

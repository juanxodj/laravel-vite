<template>
  <BasePageHeading title="Movimientos" />

  <div class="content">
    <BaseBlock title="Agregar Movimiento">
      <form @submit.prevent="addData" class="mb-4">
        <div class="row">
          <div class="col-md-4">
            <label class="form-label">Tipo</label>
            <select class="form-select" v-model="form.type">
              <option value="income" selected>Ingreso</option>
              <option value="expenses">Egreso</option>
            </select>
          </div>
          <div class="col-md-8">
            <label class="form-label">Productos</label>
            <select class="form-select" v-model="form.product_id">
              <template v-for="data in dataFetched.product">
                <option :value="data.id">{{ `${data.description} - ${data.price}` }}</option>
              </template>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Caja</label>
            <select class="form-select" v-model="form.cash_register_detail_id">
              <template v-for="data in dataFetched.cashRegister">
                <option :value="data.id">{{ data.cash_register.description }}</option>
              </template>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Cantidad</label>
            <input type="number" class="form-control" step="0.02" v-model="form.quantity">
          </div>
          <div class="col-md-6">
            <label class="form-label">Monto</label>
            <input type="number" class="form-control" step="0.02" v-model="form.amount">
          </div>
          <div class="col-md-6">
            <label class="form-label">Total</label>
            <input type="number" class="form-control" step="0.02" v-model="total" readonly>
          </div>

          <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </div>
      </form>
    </BaseBlock>
  </div>
</template>

<script setup lang="ts">
import { Movement } from '@/scripts/models/movement.model'
import { reactive } from 'vue'
import { Toast } from "@/scripts/mixins/toast"
import api from '@/scripts/services/api'

const initialForm = {
  type: "income",
  quantity: 1,
  amount: 0,
  cash_register_detail_id: 1,
  product_id: 1,
  total: 0
}
const form = reactive<Movement>({ ...initialForm })
const dataFetched = ref([])
const total = computed(() => form.quantity * form.amount)

onMounted(() => {
  getData()
});

watch(
  () => form.product_id,
  (selection) => {
    var found = dataFetched.value.product.find(e => e.id === selection);
    form.amount = found.price
  }
);

const getData = async () => {
  const { data } = await api.get(`/movements`);
  dataFetched.value = data;
}

function addData() {

  if (dataFetched.value.cashRegister.length === 0) {
    Toast.fire({
      icon: 'error',
      title: 'No hay ninguna caja abierta'
    })
  }

  form.total = total
  api.post(`/movements`, form)
    .then(() => {
      Toast.fire({
        icon: 'success',
        title: 'Guardado Correctamente'
      })
      Object.assign(form, initialForm)
    })
    .catch((err) => {
      console.log(err.response)
    });
}
</script>

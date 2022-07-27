<template>
  <BasePageHeading :title="title">
    <template #extra>
      <button type="button" class="btn btn-alt-primary" @click="modalShow('modalCashRegister')"
        v-if="route.name === 'cash-register.detail'">
        <i class="fa fa-plus opacity-50 me-1"></i>
        Abrir Caja
      </button>
      <router-link :to="{ name: `${routeName}.add` }" v-else>
        <button type="button" class="btn btn-alt-primary" v-click-ripple>
          <i class="fa fa-plus opacity-50 me-1"></i>
          Agregar
        </button>
      </router-link>
    </template>
  </BasePageHeading>

  <div class="content">
    <BaseBlock :title="titleBlock" content-full>
      <Dataset v-slot="{ ds }" :ds-data="dataFetched.reverse()" :ds-sortby="sortBy" :ds-search-in="fieldsSearch">
        <div class="row" :data-page-count="ds.dsPagecount">
          <div id="datasetLength" class="col-md-8 py-2">
            <DatasetShow />
          </div>
          <div class="col-md-4 py-2">
            <DatasetSearch ds-search-placeholder="Buscar..." />
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb-0">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th v-for="(th, index) in cols" :key="th.field" :class="['sort', th.sort]"
                      @click="onSort($event, index)">
                      {{ th.name }} <i class="gg-select float-end"></i>
                    </th>
                  </tr>
                </thead>
                <DatasetItem tag="tbody" class="fs-sm">
                  <template #default="{ row, rowIndex }">
                    <tr>
                      <th scope="row">{{ rowIndex + 1 }}</th>
                      <template v-for="field in fieldsSearch">
                        <td>{{ row[`${field}`] }}</td>
                      </template>
                      <td>
                        <div class="btn-group">
                          <div v-if="route.name === 'cash-register'">
                            <router-link :to="{
                              name: `${routeName}.detail`,
                              params: { id: row.id }
                            }">
                              <button type="button" class="btn btn-sm btn-alt-secondary">
                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                              </button>
                            </router-link>
                          </div>
                          <div
                            v-else-if="route.name === 'cash-register.detail' && row.status === 'open' && row.settlement === null">
                            <button type="button" class="btn btn-sm btn-alt-secondary"
                              @click="modalShow('settlementModal', row.id)">
                              <i class="fa-solid fa-money-bill"></i>
                            </button>
                          </div>
                          <div v-else-if="route.name === 'cash-register.detail' && row.status != 'close'">
                            <button type="button" class="btn btn-sm btn-alt-secondary"
                              @click="closeCashRegister(row.id)">
                              <i class="fa-solid fa-circle-arrow-down"></i>
                            </button>
                          </div>
                          <div v-if="route.name === 'cash-register.detail'">
                            <button type="button" class="btn btn-sm btn-alt-secondary"
                              @click="modalShow('modalDetailMovements', row.movements)">
                              Detalle
                            </button>
                          </div>
                          <div v-if="route.name === 'cash-register.detail'">
                            <button type="button" class="btn btn-sm btn-alt-secondary"
                              @click="modalShow('modalReportMovements')">
                              <!-- <i class="fa-solid fa-chart-bar"></i> -->
                              Reporte
                            </button>
                          </div>
                          <router-link :to="{
                            name: `${routeName}.edit`,
                            params: { id: row.id }
                          }" v-if="route.name != 'cash-register.detail'">
                            <button type="button" class="btn btn-sm btn-alt-secondary">
                              <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                          </router-link>
                          <button type="button" class="btn btn-sm btn-alt-secondary" @click.prevent="destroy(row.id)"
                            v-if="route.name != 'cash-register.detail'">
                            <i class="fa fa-fw fa-times"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </template>
                </DatasetItem>
              </table>
            </div>
          </div>
        </div>
        <div class="d-flex flex-md-row flex-column justify-content-between align-items-center">
          <DatasetInfo class="py-3 fs-sm" />
          <DatasetPager class="flex-wrap py-3 fs-sm" />
        </div>
      </Dataset>
    </BaseBlock>
  </div>

  <!-- Modal Open Cash Register -->
  <div class="modal fade" id="modalCashRegister" tabindex="-1" aria-labelledby="modalCashRegisterLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCashRegisterLabel">Abrir Caja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="openCashRegister" class="mb-4">
            <div class="row">
              <div class="col-md-12">
                <label class="form-label">Saldo Inicial</label>
                <input type="number" step="0.01" class="form-control" v-model="initialFormCashRegister.initial_balance">
              </div>
              <div class="col-md-12 mt-3 text-end">
                <button type="submit" class="btn btn-primary">Abrir</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Movements -->
  <div class="modal fade" id="modalDetailMovements" tabindex="-1" aria-labelledby="modalDetailMovementsLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDetailMovementsLabel">Detalle de Movimientos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Descripción</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Monto</th>
                <th scope="col">Ingreso</th>
                <th scope="col">Egreso</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(detail, index) in movementsDetail">
                <th scope="row">{{ ++index }}</th>
                <td>{{ detail.product.description }}</td>
                <td>{{ detail.quantity }}</td>
                <td>{{ detail.amount }}</td>
                <template v-if="detail.type === 'income'">
                  <td>{{ detail.total }}</td>
                  <td>-</td>
                </template>
                <template v-else>
                  <td>-</td>
                  <td>{{ detail.total }}</td>
                </template>
              </tr>
            </tbody>
            <tfoot>
              <td colspan="2" class="text-center">TOTAL</td>
              <td>{{ totalQuantity }}</td>
              <td>-</td>
              <td>{{ totalIncome.toFixed(2) }}</td>
              <td>{{ totalExpense.toFixed(2) }}</td>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Settlement -->
  <div class="modal fade" id="settlementModal" tabindex="-1" aria-labelledby="settlementModalLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="settlementModalLabel">Arqueo de Caja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="settlementCashRegister" class="mb-4">
            <div class="row">
              <div class="col-md-4">
                <label class="form-label">200</label>
                <input type="number" class="form-control" v-model="form.bill_200">
              </div>
              <div class="col-md-4">
                <label class="form-label">100</label>
                <input type="number" class="form-control" v-model="form.bill_100">
              </div>
              <div class="col-md-4">
                <label class="form-label">50</label>
                <input type="number" class="form-control" v-model="form.bill_50">
              </div>
              <div class="col-md-4">
                <label class="form-label">20</label>
                <input type="number" class="form-control" v-model="form.bill_20">
              </div>
              <div class="col-md-4">
                <label class="form-label">10</label>
                <input type="number" class="form-control" v-model="form.bill_10">
              </div>
              <div class="col-md-4">
                <label class="form-label">5</label>
                <input type="number" class="form-control" v-model="form.bill_5">
              </div>
              <div class="col-md-4">
                <label class="form-label">1</label>
                <input type="number" class="form-control" v-model="form.bill_1">
              </div>
              <div class="col-md-12 mt-3">
                Total: {{ total }}
              </div>
              <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Liquidar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Report -->
  <div class="modal fade" id="modalReportMovements" tabindex="-1" aria-labelledby="modalReportMovementsLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalReportMovementsLabel">Reporte General</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
/* import { CashRegister } from '@/scripts/models/cash-register.model' */
import { onMounted, ref, onUnmounted } from 'vue'
import api from '@/scripts/services/api'
import Swal from "sweetalert2"
import { Toast } from "@/scripts/mixins/toast"
import {
  Dataset,
  DatasetItem,
  DatasetInfo,
  DatasetPager,
  DatasetSearch,
  DatasetShow,
} from "vue-dataset"
import { useRoute } from 'vue-router'

const initialForm = {
  bill_200: 0,
  bill_100: 0,
  bill_50: 0,
  bill_20: 0,
  bill_10: 0,
  bill_5: 0,
  bill_1: 0,
  total: 0,
}
const form = reactive({ ...initialForm })
const total = computed(() => (form.bill_200 * 200) + (form.bill_100 * 100) + (form.bill_50 * 50) + (form.bill_20 * 20) + (form.bill_10 * 10) + (form.bill_5 * 5) + (form.bill_1 * 1))

const props = defineProps({
  title: String,
  titleBlock: String,
  fieldsSearch: Array,
  routeFetch: String,
  routeName: String,
  columns: Array,
  modelName: String
})
const route = useRoute()

/* const dataFetched: Ref<CashRegister[]> = ref([]) */
const dataFetched = ref([])

const initialFormCashRegister = {
  opening: new Date(),
  initial_balance: 0,
  status: "open"
}

// Helper variables
const cols = reactive(props.columns);
let tooltipTriggerList = [];
let tooltipList = [];

// Sort by functionality
const sortBy = computed(() => {
  return cols.reduce((acc, o) => {
    if (o.sort) {
      o.sort === "asc" ? acc.push(o.field) : acc.push("-" + o.field);
    }
    return acc;
  }, []);
});

// On sort th click
function onSort(event, i) {
  let toset;
  const sortEl = cols[i];

  if (!event.shiftKey) {
    cols.forEach((o) => {
      if (o.field !== sortEl.field) {
        o.sort = "";
      }
    });
  }

  if (!sortEl.sort) {
    toset = "asc";
  }

  if (sortEl.sort === "desc") {
    toset = event.shiftKey ? "" : "asc";
  }

  if (sortEl.sort === "asc") {
    toset = "desc";
  }

  sortEl.sort = toset;
}

// Apply a few Bootstrap 5 optimizations
onMounted(() => {
  console.log("Route Name: " + route.name)
  getData()
  // Remove labels from
  document.querySelectorAll("#datasetLength label").forEach((el) => {
    el.remove();
  });

  // Replace select classes
  let selectLength = document.querySelector("#datasetLength select");

  selectLength.classList = "";
  selectLength.classList.add("form-select");
  selectLength.style.width = "80px";

  // Grab all tooltip containers..
  tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );

  // ..and init them
  tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => {
    return new window.bootstrap.Tooltip(tooltipTriggerEl, {
      container: tooltipTriggerEl.dataset.bsContainer || "#page-container",
      animation:
        tooltipTriggerEl.dataset.bsAnimation &&
          tooltipTriggerEl.dataset.bsAnimation.toLowerCase() == "true"
          ? true
          : false,
    });
  });
});

onUnmounted(() => {
  tooltipList.forEach((tooltip) => tooltip.dispose());
});

const getData = async () => {
  const { data } = await api.get(`/${props.routeFetch}`);
  dataFetched.value = data;
}

function destroy(id: number | undefined) {
  Swal.fire({
    title: '¿Estás segurx de eliminar?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      api.delete(`/${props.routeFetch}/${id}`)
        .then((res) => {
          if (res.status === 200) {
            Toast.fire({
              icon: 'success',
              title: 'Eliminado correctamente'
            })
            getData();
          }
        })
        .catch((error) => {
          Toast.fire({
            icon: 'error',
            title: error.message
          })
        });
    }
  })
}

function openCashRegister() {
  api.post(`/cash-registers/${route.params.id}/open`, initialFormCashRegister)
    .then(() => {
      Toast.fire({
        icon: 'success',
        title: 'Caja Abierta Correctamente'
      })
      modalHide('modalCashRegister')
      getData()
    })
    .catch((err) => {
      Toast.fire({
        icon: 'error',
        title: err.response.data.message
      })
    });
}

function settlementCashRegister() {
  form.total = total
  Swal.fire({
    title: '¿Estás segurx de liquidar caja?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      api.post(`/cash-registers/${idDetail.value}/settlement`, form)
        .then(() => {
          Toast.fire({
            icon: 'success',
            title: 'Arqueo de Caja agregado correctamente'
          })
          getData()
          modalHide('settlementModal')
        })
        .catch((err) => {
          Toast.fire({
            icon: 'error',
            title: err.response.data.message
          })
        });
    }
  })
}

function closeCashRegister(id: number) {
  Swal.fire({
    title: '¿Estás segurx de cerrar caja?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      api.post(`/cash-registers/${id}/close`)
        .then(() => {
          Toast.fire({
            icon: 'success',
            title: 'Caja Cerrada Correctamente'
          })
          getData();
        })
        .catch((err) => {
          Toast.fire({
            icon: 'error',
            title: err.response.data.message
          })
        });
    }
  })
}

const movementsDetail = ref([]);
const totalIncome = ref(0);
const totalExpense = ref(0);
const totalQuantity = ref(0);
const idDetail = ref(0);

function calcMovements(movements) {
  movementsDetail.value = movements

  totalQuantity.value = movementsDetail.value
    .reduce((sum, record) => sum + record.quantity, 0)

  totalIncome.value = movementsDetail.value
    .filter(({ type }) => type === 'income')
    .reduce((sum, record) => sum + parseFloat(record.total), 0)

  totalExpense.value = movementsDetail.value
    .filter(({ type }) => type === 'expenses')
    .reduce((sum, record) => sum + parseFloat(record.total), 0)
}

function modalShow(modalName: string, data?) {
  if (modalName === 'modalDetailMovements') calcMovements(data)
  if (modalName === 'settlementModal') idDetail.value = data
  var myModal = new bootstrap.Modal(document.getElementById(modalName))
  myModal.show()
}

function modalHide(modalName: string) {
  var myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById(modalName));
  myModal.hide();
}
</script>

<style lang="scss" scoped>
.gg-select {
  box-sizing: border-box;
  position: relative;
  display: block;
  transform: scale(1);
  width: 22px;
  height: 22px;
}

.gg-select::after,
.gg-select::before {
  content: "";
  display: block;
  box-sizing: border-box;
  position: absolute;
  width: 8px;
  height: 8px;
  left: 7px;
  transform: rotate(-45deg);
}

.gg-select::before {
  border-left: 2px solid;
  border-bottom: 2px solid;
  bottom: 4px;
  opacity: 0.3;
}

.gg-select::after {
  border-right: 2px solid;
  border-top: 2px solid;
  top: 4px;
  opacity: 0.3;
}

th.sort {
  cursor: pointer;
  user-select: none;

  &.asc {
    .gg-select::after {
      opacity: 1;
    }
  }

  &.desc {
    .gg-select::before {
      opacity: 1;
    }
  }
}
</style>

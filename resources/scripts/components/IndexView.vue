<template>
  <BasePageHeading :title="title">
    <template #extra>
      <router-link :to="{ name: `${routeName}.add` }">
        <button type="button" class="btn btn-alt-primary" v-click-ripple>
          <i class="fa fa-plus opacity-50 me-1"></i>
          Agregar
        </button>
      </router-link>
    </template>
  </BasePageHeading>

  <div class="content">
    <BaseBlock :title="titleBlock" content-full>
      <Dataset v-slot="{ ds }" :ds-data="dataFetched" :ds-sortby="sortBy" :ds-search-in="fieldsSearch">
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
                          <router-link :to="{
                            name: `${routeName}.edit`,
                            params: { id: row.id }
                          }">
                            <button type="button" class="btn btn-sm btn-alt-secondary">
                              <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                          </router-link>
                          <button type="button" class="btn btn-sm btn-alt-secondary" @click.prevent="destroy(row.id)">
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
</template>

<script setup lang="ts">
/* import { CashRegister } from '@/scripts/models/cash-register.model' */
import { onMounted, Ref, ref } from 'vue'
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

const props = defineProps({
  title: String,
  titleBlock: String,
  fieldsSearch: Array,
  routeFetch: String,
  routeName: String,
  columns: Array,
  modelName: String
})

/* const dataFetched: Ref<CashRegister[]> = ref([]) */
const dataFetched = ref([])

// Helper variables
const cols = reactive(props.columns);

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
          //console.log(error.response.data.message)
          Toast.fire({
            icon: 'error',
            title: error.message
          })
        });
    }
  })
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

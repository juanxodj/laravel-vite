<template>
  <BasePageHeading title="Cajas">
    <template #extra>
      <button type="button" class="btn btn-alt-primary" v-click-ripple>
        <i class="fa fa-plus opacity-50 me-1"></i>
        Agregar
      </button>
    </template>
  </BasePageHeading>

  <div class="content">
    <BaseBlock title="Lista de Cajas">
      <template #options>
        <button type="button" class="btn-block-option">
          <i class="si si-settings"></i>
        </button>
      </template>

      <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>Descripción</th>
              <th class="text-center" style="width: 100px">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <td class="text-center">
                {{ user.id }}
              </td>
              <td class="fs-sm">
                {{ user.description }}
              </td>
              <td class="text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-alt-secondary">
                    <i class="fa fa-fw fa-pencil-alt"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-alt-secondary">
                    <i class="fa fa-fw fa-times"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </BaseBlock>
  </div>
</template>

<script setup lang="ts">
// Example data
const users = reactive([
  {
    id: 1,
    description: "Caja 01",
  },
  {
    id: 2,
    description: "Caja 02",
  },
]);
</script>

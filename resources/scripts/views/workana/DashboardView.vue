<template>
  <BasePageHeading title="Dashboard" subtitle="Welcome Admin!">
    <template #extra>
      <button type="button" class="btn btn-alt-primary" v-click-ripple @click="logout">
        <i class="fa fa-plus opacity-50 me-1"></i>
        Cerrar Sessión
      </button>
    </template>
  </BasePageHeading>

  <div class="content">
    <div class="row items-push">
      <div class="col-xl-12">
        <BaseBlock title="Block" class="h-100 mb-0">
          <p>
            This is a backend layout based page which you can use as a base for
            your backend pages.
          </p>
          <p>
            We created a custom Backend layout variation (
            <code>layouts/variations/BackendStarter.vue</code>) to showcase how
            easily you can add extra layout variations and override the default
            content of the partial elements.
          </p>
        </BaseBlock>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useUserStore } from "@/scripts/stores/user";
import { useRouter } from "vue-router";

const router = useRouter();
const userStore = useUserStore();

async function logout() {
  userStore.logout();
  router.push({ name: "login" });
}


</script>

<template>
  <!-- Page Content -->
  <div class="hero-static d-flex align-items-center">
    <div class="content">
      <div class="row justify-content-center push">
        <div class="col-md-8 col-lg-6 col-xl-4">
          <!-- Sign In Block -->
          <BaseBlock title="Iniciar Sesión" class="mb-0">
            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
              <h1 class="h2 mb-1">OneUI</h1>
              <p class="fw-medium text-muted">Bienvenido, por favor inicie sesión.</p>

              <!-- Sign In Form -->
              <form @submit.prevent="onSubmit">
                <div class="py-3">
                  <div class="mb-4">
                    <input type="email" class="form-control form-control-alt form-control-lg" id="login-email"
                      name="login-email" placeholder="Correo Electrónico" :class="{
                        'is-invalid': v$.email.$errors.length,
                      }" v-model="form.email" @blur="v$.email.$touch" />
                    <div v-if="v$.email.$errors.length" class="invalid-feedback animated fadeIn">
                      Por favor, introduzca su correo electrónico
                    </div>
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control form-control-alt form-control-lg" id="login-password"
                      name="login-password" placeholder="Contraseña" :class="{
                        'is-invalid': v$.password.$errors.length,
                      }" v-model="form.password" @blur="v$.password.$touch" />
                    <div v-if="v$.password.$errors.length" class="invalid-feedback animated fadeIn">
                      Por favor, introduzca su contraseña
                    </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-md-6 col-xl-5">
                    <button type="submit" class="btn w-100 btn-alt-primary">
                      <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i>
                      Iniciar
                    </button>
                  </div>
                </div>
              </form>
              <!-- END Sign In Form -->
            </div>
          </BaseBlock>
          <!-- END Sign In Block -->
        </div>
      </div>
      <div class="fs-sm text-muted text-center">
        <strong>{{ store.app.name + " " + store.app.version }}</strong> &copy;
        {{ store.app.copyright }}
      </div>
    </div>
  </div>
  <!-- END Page Content -->
</template>

<script setup lang="ts">
import { reactive, computed } from "vue";
import { useTemplateStore } from "@/scripts/stores/template";

// Vuelidate, for more info and examples you can check out https://github.com/vuelidate/vuelidate
import useVuelidate from "@vuelidate/core";
import { required, minLength } from "@vuelidate/validators";
import { useUserStore } from "@/scripts/stores/user";
import { useRouter } from "vue-router";

// Main store and Router
const store = useTemplateStore();
const userStore = useUserStore();
const router = useRouter();

// Input form variables
const form = reactive({
  email: "admin@laravel.io",
  password: "123456",
});

// Validation rules
const rules = computed(() => {
  return {
    email: {
      required,
      minLength: minLength(3),
    },
    password: {
      required,
      minLength: minLength(5),
    },
  };
});

// Use vuelidate
const v$ = useVuelidate(rules, form);

// On form submission
async function onSubmit() {
  const result = await v$.value.$validate();

  if (!result) {
    // notify user form is invalid
    return;
  }

  const res = await userStore.login(form.email, form.password);
  if (res === 200) {
    router.push({ name: "dashboard" });
  }
}
</script>

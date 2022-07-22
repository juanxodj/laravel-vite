<template>
  <!-- Sign In Block -->
  <div class="block block-rounded mb-0">
    <div class="block-header block-header-default">
      <h3 class="block-title">Iniciar Sesión</h3>
      <div class="block-options">
        <a class="btn-block-option fs-sm" href="op_auth_reminder.html">¿Has olvidado tu contraseña?</a>
        <a class="btn-block-option" href="op_auth_signup.html" data-bs-toggle="tooltip" data-bs-placement="left"
          title="New Account">
          <font-awesome-icon icon="fa-solid fa-user-plus" />
        </a>
      </div>
    </div>
    <div class="block-content">
      <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
        <h1 class="h2 mb-1">CiberEspacio</h1>
        <p class="fw-medium text-muted">Bienvenido, por favor inicie sesión.</p>
        <form class="js-validation-signin" action="be_pages_auth_all.html" @submit.prevent="submit">
          <div class="py-3">
            <div class="mb-4">
              <input type="email" class="form-control form-control-alt form-control-lg" id="login-email"
                name="login-email" placeholder="Email" v-model="form.email" />
            </div>
            <div class="mb-4">
              <input type="password" class="form-control form-control-alt form-control-lg" id="login-password"
                name="login-password" placeholder="Password" v-model="form.password" />
            </div>
            <div class="mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="login-remember" name="login-remember" />
                <label class="form-check-label" for="login-remember">Recuérdame</label>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-6 col-xl-5">
              <button type="submit" class="btn w-100 btn-alt-primary">
                <font-awesome-icon icon="fa-solid fa-right-to-bracket" />
                Iniciar Sesión
              </button>
            </div>
          </div>
        </form>
        <!-- END Sign In Form -->
      </div>
    </div>
  </div>
  <!-- END Sign In Block -->
</template>

<script setup lang="ts">
import { Toast } from './../../mixins/toast'
import { Login } from './../../models/login.model'
//import { useUserStore } from "@/stores/user"

const form: Login = reactive({
  email: "jlsc92@gmail.com",
  password: "123456"
})

const submit = () => {
  Toast.fire({
    icon: 'error',
    title: 'Error'
  })
}
</script>

<style>
</style>

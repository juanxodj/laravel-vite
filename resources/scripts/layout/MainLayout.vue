<template>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <div class="col-auto px-0">
        <div id="sidebar" class="collapse collapse-horizontal show border-end">
          <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
            <a class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar">
              <font-awesome-icon icon="fa-solid fa-caret-right" class="me-2" />
              <router-link to="/">Inicio</router-link>
            </a>
            <a class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar">
              <font-awesome-icon icon="fa-solid fa-caret-right" class="me-2" />
              <router-link to="/hello-world">Hello World</router-link>
            </a>
            <a class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar">
              <font-awesome-icon icon="fa-solid fa-caret-right" class="me-2" />
              <router-link :to="{ name: 'table' }">Table</router-link>
            </a>
          </div>
        </div>
      </div>
      <main class="col ps-md-2 pt-2">
        <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"
          class="border rounded-3 p-1 text-decoration-none">
          <font-awesome-icon icon="fa-solid fa-align-justify" /> Menú
        </a>
        <div class="page-header pt-3">
          <h2>Bootstrap 5 Sidebar Menu - Simple</h2>
        </div>
        <p class="lead">A offcanvas "push" vertical nav menu example.</p>
        <hr>
        <div class="row">
          <div class="col-12">
            <router-view />
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
</script>

<style>
#sidebar-nav {
  width: 160px;
}
</style>

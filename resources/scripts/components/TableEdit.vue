<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        Update Student
      </div>
      <div class="card-body">
        <form class="row g-3" @submit.prevent="updateData">
          <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="form.name" required>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" v-model="form.email" required>
          </div>
          <div class="col-md-6">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" placeholder="Enter phone" v-model="form.phone" required>
          </div>
          <div class="col-md-6">
            <label for="inputState" class="form-label">State</label>
            <select id="inputState" class="form-select" v-model="form.gender" required>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { reactive, ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { Student } from "./../models/student.model"
import api from "./../services/api"

const initialForm = {
  name: "",
  email: "",
  phone: "",
  gender: ""
};
const form = reactive<Student>({ ...initialForm });
const errors = ref([{}])
const route = useRoute()
const router = useRouter()

onMounted(() => {
  editData()
})

function editData() {
  api.get(`/students/${route.params.id}`)
    .then((res) => {
      if (res.status === 200) {
        Object.assign(form, res.data.data);
      }
    })
    .catch((err) => {
      errors.value = err.response.data.errors;
    });
}

function updateData() {
  api.put(`/students/${route.params.id}`, form)
    .then((res) => {
      if (res.status === 200) {
        /* form = "";
        errors = ""; */
        Object.assign(form, initialForm);
        router.push({ name: 'table' });
      }
    })
    .catch((err) => {
      errors.value = err.response.data.errors;
    });
}
</script>

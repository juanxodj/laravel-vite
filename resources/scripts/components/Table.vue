<template>
  <button type="button" class="btn btn-primary" @click="getStudents">Get Students</button>
  <table class="table table-hover table-responsive">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Gender</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="student in students">
        <th scope="row">{{ student.id }}</th>
        <td>{{ student.name }}</td>
        <td>{{ student.email }}</td>
        <td>{{ student.phone }}</td>
        <td>{{ student.gender }}</td>
        <td>
          <div class="btn-group" role="group">
            <router-link :to="{
              name: 'table.edit',
              params: { id: student.id }
            }">
              <button type="button" class="btn btn-warning">
                <font-awesome-icon icon="fa-solid fa-pen" />
              </button>
            </router-link>
            <button type="button" class="btn btn-danger" @click.prevent="deleteStudent(student.id)">
              <font-awesome-icon icon=" fa-solid fa-trash-can" />
            </button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script setup lang="ts">
import { ref, onMounted, Ref } from 'vue'
import Swal from "sweetalert2"
import api from "./../services/api"
import { Student } from "./../models/student.model"

const students: Ref<Student[]> = ref([])

onMounted(() => {
  getStudents()
})

const getStudents = async () => {
  const { data } = await api.get("/students");
  students.value = data.data;
}

function deleteStudent(id: number | undefined) {
  Swal.fire({
    title: 'Are You Sure To Delete?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Yes',
    denyButtonText: `Don't delete`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      api.delete("/students/" + id)
        .then((res) => {
          if (res.status === 200) {
            Swal.fire('Saved!', '', 'success')
            getStudents();
          }
        })
        .catch(() => { });
    } else if (result.isDenied) {
      Swal.fire('Changes are not saved', '', 'info')
    }
  })
}
</script>

<style scoped>
</style>

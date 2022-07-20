<template>
  <div>
    <div class="container">
      <div class="row mt-5">
        <div class="col-md-6 m-auto">
          <div class="card">
            <h5 class="card-header">
              <router-link :to="{ name: 'List' }" class="btn btn-sm btn-info">All Data</router-link>
            </h5>
            <div class="card-body">
              <form @submit.prevent="storeData">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                    placeholder="Enter name" v-model="form.name" />

                  <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" v-model="form.email" />

                  <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
                </div>

                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" aria-describedby="emailHelp"
                    placeholder="Enter Phone no." v-model="form.phone" />

                  <span v-if="errors.phone" class="text-danger">{{ errors.phone[0] }}</span>
                </div>

                <div class="form-group">
                  <label for="gender">Gender</label>
                  <select class="form-control" id="gender" v-model="form.gender">
                    <option value="" selected>
                      Select One
                    </option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>

                  <span v-if="errors.gender" class="text-danger">{{ errors.gender[0] }}</span>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
        gender: "",
      },

      errors: {},
    };
  },

  methods: {
    storeData() {
      axios
        .post("/api/students", this.form)
        .then((res) => {
          if (res.status === 201) {
            this.form = "";
            this.errors = "";
          }
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },
};
</script>

<template>
  <div>
    <section class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title float-right">
                  <router-link
                    :to="{ name: 'createCategory' }"
                    class="btn btn-primary"
                  >
                    <i class="fas fa-plus"></i> Add Category
                  </router-link>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="Category" class="table text-center">
                    <thead>
                      <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(category, i) in categories"
                        :key="category.id"
                      >
                        <td>{{ i + 1 }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.status ? "Active" : "Inactive" }}</td>
                        <td>
                          <div class="inline-flex">
                            <router-link
                              :to="{
                                name: 'editCategory',
                                params: { id: category.id },
                              }"
                              class="btn btn-primary"
                              >Edit</router-link
                            >
                            <button
                              class="btn btn-danger"
                              @click="deleteCategory(category.id)"
                            >
                              Delete
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
// import 'jquery/dist/jquery.min.js';
// import "datatables.net-dt/js/dataTables.dataTables";
// import "datatables.net-dt/css/jquery.dataTables.min.css";
// import $ from 'jquery';
export default {
  data() {
    return {
      categories: [],
    };
  },

  async created() {
    this.showLoader();
    await axios
      .get("/api/admin/category")
      .then((response) => {
        if (response.data.success) {
          this.categories = response.data.categories;
          this.myTable();
          this.hideLoader();
        } else {
          this.hideLoader();
        }
      })
      .catch((err) => {
        toastr.error(err);
      });
  },
  methods: {
    myTable() {
      $(document).ready(function () {
        $("#Category").DataTable();
      });
    },
    async deleteCategory(id) {
      this.showLoader();
      await axios.delete(`/api/admin/category/delete/${id}`).then((res) => {
        if (res.data.success) {
          let i = this.categories.map((data) => data.id).indexOf(id);
          this.categories.splice(i, 1);
          toastr.success(res.data.message);
        } else {
          toastr.error("Something Went Wrong");
        }
        this.hideLoader();
      });
    },
  },
};
</script>
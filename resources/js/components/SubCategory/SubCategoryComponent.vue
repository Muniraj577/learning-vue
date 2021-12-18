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
                    :to="{ name: 'createSubCategory' }"
                    class="btn btn-primary"
                  >
                    <i class="fas fa-plus"></i> Add SubCategory
                  </router-link>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="SubCategory" class="table text-center">
                    <thead>
                      <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(subcategory, i) in subcategories"
                        :key="subcategory.id"
                      >
                        <td>{{ i + 1 }}</td>
                        <td>{{ subcategory.name }}</td>
                        <td>{{ subcategory.category.name }}</td>
                        <td>
                          {{ subcategory.status ? "Active" : "Inactive" }}
                        </td>
                        <td>
                          <div class="inline-flex">
                            <router-link
                              :to="{
                                name: 'editSubCategory',
                                params: { id: subcategory.id },
                              }"
                              class="btn btn-primary"
                              >Edit</router-link
                            >
                            <button
                              class="btn btn-danger"
                              @click="deleteCategory(subcategory.id)"
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
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
// import $ from 'jquery';
export default {
  data() {
    return {
      subcategories: [],
    };
  },

  async created() {
    this.showLoader();
    await axios.get("/api/admin/subcategory").then((response) => {
      if (response.data.success) {
        this.subcategories = response.data.subcategories;
        this.myTable();
        this.hideLoader();
      } else {
          toastr.error('Something went wrong');
          this.hideLoader();
      }
    }).catch((err) =>{
        toastr.error(err);
        this.hideLoader();
    });
  },
  methods: {
    myTable() {
      $(document).ready(function () {
        $("#SubCategory").DataTable();
      });
    },
    async deleteCategory(id) {
      this.showLoader();
      await axios.delete(`/api/admin/subcategory/delete/${id}`).then((res) => {
        if (res.data.success) {
          let i = this.subcategories.map((data) => data.id).indexOf(id);
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
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
                    :to="{ name: 'createProduct' }"
                    class="btn btn-primary"
                  >
                    <i class="fas fa-plus"></i> Add Product
                  </router-link>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="Product" class="table text-center">
                    <thead>
                      <tr>
                        <th>S.N</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(product, i) in products"
                        :key="product.id"
                      >
                        <td>{{ i + 1 }}</td>
                        
                        <td><img :src="(product.image != null && product.image != 'default.png') ? '/images/products/'+product.image : '/images/default.png'" alt="" class="imgSize"></td>
                        <td>{{ product.title }}</td>
                        <td>{{ product.category.name }}</td>
                        <td>{{ product.subcategory.name ? product.subcategory.name : 'No subcategory' }}</td>
                        <td>
                          {{ product.status ? "Active" : "Inactive" }}
                        </td>
                        <td>
                          <div class="inline-flex">
                            <router-link
                              :to="{
                                name: 'editProduct',
                                params: { id: product.id },
                              }"
                              class="btn btn-primary"
                              >Edit</router-link
                            >
                            <button
                              class="btn btn-danger"
                              @click="deleteProduct(product.id)"
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
      products: [],
    };
  },

  async created() {
    this.showLoader();
    await axios.get("/api/admin/product").then((response) => {
      if (response.data.success) {
        this.products = response.data.products;
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
        $("#Product").DataTable();
      });
    },
    async deleteProduct(id) {
      this.showLoader();
      await axios.delete(`/api/admin/product/delete/${id}`).then((res) => {
        if (res.data.success) {
          let i = this.products.map((data) => data.id).indexOf(id);
          this.products.splice(i, 1);
          toastr.success(res.data.message);
        } else {
          toastr.error("Something Went Wrong");
        }
        this.hideLoader();
      }).catch((err) => {
          toastr.error(err);
      });
    },
  },
};
</script>
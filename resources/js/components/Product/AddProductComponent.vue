<template>
  <div>
    <section class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title float-right">
                  <button class="btn btn-primary">
                    <i class="fas fa-eye"></i> Products
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form
                  method="POST"
                  @submit.prevent="addProduct"
                  enctype="multipart/form-data"
                >
                  <div class="col-md-6">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label for="title">Product Title</label>
                          </div>
                          <div class="col-md-8">
                            <input
                              type="text"
                              name="title"
                              class="form-control"
                              v-model="product.title"
                              value=""
                              placeholder="Enter Product title"
                              id=""
                            />
                            <span
                              v-if="errors.title"
                              :class="['text-danger']"
                              >{{ errors.title[0] }}</span
                            >
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label for="categories">Select Category</label>
                          </div>
                          <div class="col-md-8">
                            <select
                              v-model="product.category_id"
                              class="form-control"
                              name="category_id"
                              id="category_id"
                              @change="getSubCategories(product.category_id)"
                            >
                              <option value="" selected>Select Category</option>
                              <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                              >
                                {{ category.name }}
                              </option>
                            </select>
                            <span
                              v-if="errors.category_id"
                              class="text-danger"
                              >{{ errors.category_id[0] }}</span
                            >
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label for="subcategory">Select Subcategory</label>
                          </div>
                          <div class="col-md-8">
                            <select
                              ref="subcategorySelect"
                              name="subcategory_id"
                              v-model="product.subcategory_id"
                              class="form-control"
                              id="subcategory"
                            >
                              <option value="">Select Subcategory</option>
                              <option
                                v-for="subcategory in subcategories"
                                :key="subcategory.id"
                                :value="subcategory.id"
                              >
                                {{ subcategory.name }}
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label for="price">Price</label>
                          </div>
                          <div class="col-md-8">
                            <input
                              v-model="product.price"
                              type="text"
                              name="price"
                              class="form-control"
                            />
                            <span class="text-danger" v-if="errors.price">{{
                              errors.price[0]
                            }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label for="status">Status</label>
                          </div>
                          <div class="col-md-8">
                            <select
                              ref="statusSelect"
                              name="status"
                              v-model="product.status"
                              class="form-control"
                              id="status"
                            >
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                            <span class="text-danger" v-if="errors.status">{{
                              errors.status[0]
                            }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label for="image">Upload Image</label>
                          </div>
                          <div class="col-md-8">
                            <input
                              v-on:change="onFileChange"
                              type="file"
                              class="form-control"
                              name="image"
                              id=""
                            />
                            <!-- <img src="" alt="" id="imgPreview" /> -->
                            <span class="text-danger" v-if="errors.image">{{
                              errors.image[0]
                            }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group text-center">
                      <button type="submit" class="btn btn-primary">
                        Submit
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  data() {
    return {
      categories: [],
      subcategories: [],
      product: {},
      image: "",
      errors: [],
      success: true,
    };
  },
  async created() {
    this.product.status = "1";
    this.product.category_id = "";
    this.product.subcategory_id = "";
    this.showLoader();
    this.getCategories();
    this.hideLoader();
  },
  methods: {
    async addProduct() {
      this.showLoader();
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      let data = new FormData();
      data.append("image", this.image);
      data.append("title", this.product.title);
      data.append("category_id", this.product.category_id);
      data.append("price", this.product.price);
      data.append("subcategory_id", this.product.subcategory_id);
      data.append("status", this.product.status);
      await this.axios
        .post("/api/admin/product/store", data, config)
        .then((response) => {
          if (response.data.success) {
            this.hideLoader();
            this.$router.push({ name: "product" });
            toastr.success(response.data.message);
          } else {
            this.errors = response.data.errors;
            this.success = false;
          }
          this.hideLoader();
        })
        .catch((err) => {
          toastr.error(err);
          this.success = false;
        })
        .finally(() => (this.loading = false));
    },

    onFileChange(e) {
      this.image = e.target.files[0];
    },
  },
  mounted: function () {
    var selectedStatus = this.$refs.statusSelect.children;
    var selectedSubCategories = this.$refs.subcategorySelect.children;

    if (selectedSubCategories.length) {
      this.product.subcategory_id = selectedSubCategories[0].value;
    }
    if (selectedStatus.length) {
      this.product.status = selectedStatus[0].value;
    }
  },
};
</script>

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
                    <i class="fas fa-eye"></i> SubCategories
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form
                  @submit.prevent="addSubCategory"
                  enctype="multipart/form-data"
                >
                  <div class="col-md-6">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label for="name">Name</label>
                          </div>
                          <div class="col-md-8">
                            <input
                              type="text"
                              name="name"
                              class="form-control"
                              v-model="subcategory.name"
                              value=""
                              placeholder="Enter category name"
                              id=""
                            />
                            <span v-if="errors.name" :class="['text-danger']">{{
                              errors.name[0]
                            }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label for="categories">Select Categories</label>
                          </div>
                          <div class="col-md-8">
                            <select
                              v-model="subcategory.category_id"
                              class="form-control"
                              name="category_id"
                              id="category_id"
                            >
                              <option value="" selected>Select Categories</option>
                              <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                              >
                                {{ category.name }}
                              </option>
                            </select>
                            <span v-if="errors.category_id" class="text-danger">{{ errors.category_id[0] }}</span>
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
                              v-model="subcategory.status"
                              class="form-control"
                              id="status"
                            >
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
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
      subcategory: {},
      errors: [],
      success: true,
    };
  },
  async created() {
    this.subcategory.status = "1";
    this.subcategory.category_id = '';
    showLoader();
    await this.axios
      .get("/api/admin/get-categories")
      .then((response) => {
          this.categories = response.data;
          hideLoader();
      })
      .catch((err) => {
        toastr.error(err);
        hideLoader();
      });
    hideLoader();
  },
  methods: {
    async addSubCategory() {
      showLoader();
      await this.axios
        .post("/api/admin/subcategory/store", this.subcategory)
        .then((response) => {
          if (response.data.success) {
            this.$router.push({ name: "subcategory" });
            toastr.success(response.data.message);
          } else {
            this.errors = response.data.errors;
            this.success = false;
          }
          hideLoader();
        })
        .catch((err) => {
          toastr.error(err);
          this.success = false;
        })
        .finally(() => (this.loading = false));
    },
  },
  mounted: function () {
    var selectedStatus = this.$refs.statusSelect.children;
    if (selectedStatus.length) {
      this.subcategory.status = selectedStatus[0].value;
    }
  },
};
</script>

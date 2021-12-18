<template>
  <div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title float-right">
                  <button class="btn btn-primary">
                    <i class="fas fa-eye"></i> Sub Categories
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form
                  @submit.prevent="updateSubCategory"
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
                              placeholder="Enter category name"
                              v-model="subcategory.name"
                              id="cat"
                            />
                            <span class="text-danger" v-if="errors.name">
                              {{ errors.name[0] }}
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label for="category_id">Select Category</label>
                          </div>
                          <div class="col-md-8">
                            <select
                              name="category_id"
                              v-model="subcategory.category_id"
                              class="form-control"
                              id="category_id"
                            >
                              <option value="">Select Category</option>
                              <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                            </select>
                            <span class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
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
                              name="status"
                              v-model="subcategory.status"
                              class="form-control"
                              id=""
                            >
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">
                          Submit
                        </button>
                      </div>
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
    showLoader();
    await axios
      .get(`/api/admin/subcategory/edit/${this.$route.params.id}`)
      .then((res) => {
        this.subcategory = res.data.subcategory;
        hideLoader();
      });
    this.getCategories();
  },
  methods: {
    async updateSubCategory() {
      showLoader();
      await axios
        .put(
          `/api/admin/subcategory/update/${this.$route.params.id}`,
          this.subcategory
        )
        .then((response) => {
          if (response.data.success) {
            this.$router.push({ name: "subcategory" });
            toastr.success(response.data.message);
          } else {
            this.errors = response.data.error;
            this.success = false;
          }
          hideLoader();
        })
        .finally(() => (this.loading = false));
    },

    getCategories(){
        this.axios.get('/api/admin/get-categories')
        .then((response) => {
            this.categories = response.data;
        }).catch((err) => {
            toastr.error(err);
        });
    }
  },
};
</script>

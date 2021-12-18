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
                    <i class="fas fa-eye"></i> Categories
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form
                  @submit.prevent="updateCategory"
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
                              v-model="category.name"
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
                            <label for="status">Status</label>
                          </div>
                          <div class="col-md-8">
                            <select
                              name="status"
                              v-model="category.status"
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
      category: {},
      errors: [],
      success: true,
    };
  },
  async created() {
    this.showLoader();
    await axios
      .get(
        `/api/admin/category/edit/${this.$route.params.id}`
      )
      .then((res) => {
        this.category = res.data;
        this.hideLoader();
      });
  },
  methods: {
    async updateCategory() {
      this.showLoader();
      await axios
        .put(
          `/api/admin/category/update/${this.$route.params.id}`,
          this.category
        )
        .then((response) => {
          if (response.data.success) {
            this.$router.push({ name: "category" });
            toastr.success(response.data.message);
          } else {
            this.errors = response.data.error;
            this.success = false;
          }
          this.hideLoader();
        }).finally(() => (this.loading = false));
    },
  },
};
</script>

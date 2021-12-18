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
                    <i class="fas fa-eye"></i> Categories
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form
                  @submit.prevent="addCategory"
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
                              v-model="category.name"
                              value=""
                              placeholder="Enter category name"
                              id="cat"
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
                            <label for="status">Status</label>
                          </div>
                          <div class="col-md-8">
                            <select
                              ref="statusSelect"
                              name="status"
                              v-model="category.status"
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
      category: {},
      errors: [],
      success: true,
    };
  },
  created() {
    this.category.status = "1";
  },
  methods: {
    async addCategory() {
      this.showLoader();
      await this.axios
        .post("/api/admin/category/store", this.category)
        .then((response) => {
          if (response.data.success) {
            this.$router.push({ name: "category" });
            toastr.success(response.data.message);
          } else {
            this.errors = response.data.error;
            this.success = false;
          }
          this.hideLoader();
        })
        .catch((err) => {
          toastr.error(err);
          this.success = false;
        })
        .finally(() => (this.loading = false));

      // .then((response) => this.$router.push({ name: "category" }))
      // .finally(() => (this.loading = false));
    },
  },
  mounted: function () {
    var selectedStatus = this.$refs.statusSelect.children;
    if (selectedStatus.length) {
      this.category.status = selectedStatus[0].value;
    }
  },
};
</script>

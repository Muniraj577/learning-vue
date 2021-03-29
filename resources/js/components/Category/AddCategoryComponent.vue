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
                              placeholder="Enter category name"
                              id="cat"
                            />
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
                              <option value="1" selected>Active</option>
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
      
    };
    
  },
  created(){
    this.category.status = '1'
  },
  methods: {
    addCategory() {
      this.axios
        .post("http://localhost:8000/api/admin/category/store", this.category)
        .then((response) => this.$router.push({ name: "category" }))
        .catch((err) => console.log(err))
        .finally(() => (this.loading = false));
    },
  },
  // mounted: function () {
  //   var selectedStatus = this.$refs.statusSelect.children;
  //   if(selectedStatus.length){
  //     this.category.status = selectedStatus[0].value;
  //   }
  // },
};
</script>

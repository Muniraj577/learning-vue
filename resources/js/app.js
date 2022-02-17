import VueRouter from "vue-router";
import { routes } from "./routes";
// import {categoryRoute} from './routes/category';
import VueAxios from "vue-axios";
import axios from "axios";
import Vue from "vue";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: "history",
    routes
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.mixin({
    methods: {
        getCategories: function() {
            this.axios
                .get("/api/admin/get-categories")
                .then(response => {
                    this.categories = response.data;
                    hideLoader();
                })
                .catch(err => {
                    toastr.error(err);
                    hideLoader();
                });
        },

        getSubCategories: function(id) {
            this.showLoader();
            axios
                .post("/api/admin/filter/subcatbycategory", {
                    category_id: id,
                })
                .then(response => {
                    if (response.data.success) {
                        this.subcategories = response.data.subcategories;
                        this.hideLoader();
                    } else {
                        toastr.error("Something went wrong");
                        this.hideLoader();
                    }
                })
                .catch(err => {
                    toastr.error(err);
                    this.hideLoader();
                })
                .finally(() => (this.loading = false));
        },
        showLoader: function() {
            $("#overlay").css("display", "block");
            $(".loading").css("display", "block");
        },
        hideLoader: function() {
            $("#overlay").css("display", "none");
            $(".loading").css("display", "none");
        }
    }
});
// const myMixin = {
//     created: function() {
//         this.showLoader();
//         this.hideLoader();
//     },
//     methods: {
//         showLoader: function() {
//             $("#overlay").css("display", "block");
//             $(".loading").css("display", "block");
//         },
//         hideLoader: function() {
//             $("#overlay").css("display", "none");
//             $(".loading").css("display", "none");
//         },
//         getCategories: function() {
//             this.axios
//                 .get("/api/admin/get-categories")
//                 .then(response => {
//                     this.categories = response.data;
//                     hideLoader();
//                 })
//                 .catch(err => {
//                     toastr.error(err);
//                     hideLoader();
//                 });
//         }
//     }
// };

const app = new Vue({
    el: "#app",
    router
    // mixins: [myMixin],
});

router.beforeEach((to, from, next) => {
    var defaultTitle = "Laravel";
    document.title = to.meta.title
        ? defaultTitle + " | " + to.meta.title
        : defaultTitle;
    next();
});

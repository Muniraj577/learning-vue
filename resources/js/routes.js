import Dashboard from './components/DashboardComponent.vue';
import Profile from './components/ProfileComponent.vue';
import Category from './components/Category/CategoryComponent.vue';
import AddCategory from './components/Category/AddCategoryComponent.vue';
import EditCategory from './components/Category/EditCategoryComponent.vue';
import SubCategory from './components/SubCategory/SubCategoryComponent.vue';
import AddSubCategory from './components/SubCategory/AddSubCategoryComponent.vue';
import EditSubCategory from './components/SubCategory/EditSubCategoryComponent.vue';
// import {categoryRoute} from './routes/category.js';
import subcategory from './routes/subcategory.js';

export const routes = [
    {
        name: 'dashboard',
        path: '/admin/dashboard',
        component: Dashboard,
        meta: {title: 'Dashboard'},
    },
    {
        name: 'profile',
        path: '/admin/profile',
        component: Profile,
        meta: {title: 'Profile'},
    },
    // categoryRoute

    {
        name: 'category',
        path: '/admin/category',
        component: Category,
        meta: {title: 'Categories'},
    },
    {
        name: 'createCategory',
        path: '/admin/category/create',
        component: AddCategory,
        meta: {title: 'Add Category'},
    },
    {
        name: 'editCategory',
        path: '/admin/category/edit/:id',
        component: EditCategory,
        meta: {title: 'Edit Category'},
    },
    ...subcategory,
    
    
]

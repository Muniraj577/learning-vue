import Dashboard from './components/DashboardComponent.vue';
import Profile from './components/ProfileComponent.vue';
import Category from './components/Category/CategoryComponent.vue';
import AddCategory from './components/Category/AddCategoryComponent.vue';
import EditCategory from './components/Category/EditCategoryComponent.vue';
// import {categoryRoute} from './routes/category.js';

export const routes = [
    {
        name: 'dashboard',
        path: '/admin/dashboard',
        component: Dashboard,
    },
    {
        name: 'profile',
        path: '/admin/profile',
        component: Profile,
    },
    // categoryRoute

    {
        name: 'category',
        path: '/admin/category',
        component: Category,
    },
    {
        name: 'createCategory',
        path: '/admin/category/create',
        component: AddCategory,
    },
    {
        name: 'editCategory',
        path: '/admin/category/edit/:id',
        component: EditCategory,
    },
    
]
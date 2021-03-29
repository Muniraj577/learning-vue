import Category from '../components/Category/CategoryComponent.vue';
import AddCategory from '../components/Category/AddCategoryComponent.vue';
import EditCategory from '../components/Category/EditCategoryComponent.vue';

export const categoryRoute = [
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
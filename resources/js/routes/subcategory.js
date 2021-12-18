import SubCategory from '../components/SubCategory/SubCategoryComponent.vue';
import AddSubCategory from '../components/SubCategory/AddSubCategoryComponent.vue';
import EditSubCategory from '../components/SubCategory/EditSubCategoryComponent.vue';

export default [
    {
        name: 'subcategory',
        path: '/admin/subcategory',
        component: SubCategory,
        meta: {title: 'Subcategories'},
    },
    {
        name: 'createSubCategory',
        path: '/admin/subcategory/create',
        component: AddSubCategory,
        meta: {title: 'Add Subcategory'},
    },
    {
        name: 'editSubCategory',
        path: '/admin/subcategory/edit/:id',
        component: EditSubCategory,
        meta: {title: 'Edit Subcategory'},
    },
]
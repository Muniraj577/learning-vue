import Product from '../components/Product/ProductComponent.vue';
import AddProduct from '../components/Product/AddProductComponent.vue';
import EditProduct from '../components/Product/EditProductComponent.vue';

export default [
    {
        name: 'product',
        path: '/admin/product',
        component: Product,
        meta: {title: 'Products'},
    },
    {
        name: 'createProduct',
        path: '/admin/product/create',
        component: AddProduct,
        meta: {title: 'Add Product'},
    },
    {
        name: 'editProduct',
        path: '/admin/product/edit/:id',
        component: EditProduct,
        meta: {title: 'Edit Product'},
    },
]
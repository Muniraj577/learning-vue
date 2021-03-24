<li class="nav-item {{ $catNav || $brandNav || $unitNav || $warehousenav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $catNav || $brandNav || $unitNav ||$warehousenav ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-user iCheck"></i>
        <p>
            Master
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.category.index') }}" class="nav-link @yield('category')">
                <i class="nav-icon fas fa-folder-open iCheck"></i>
                <p>Categories</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.brand.index') }}" class="nav-link @yield('brand')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Brand</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.unit.index') }}" class="nav-link @yield('unit')">
                <i class="nav-icon fas fa-wrench iCheck"></i>
                <p>Unit</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.warehouse.index') }}" class="nav-link @yield('warehouse')">
                <i class="nav-icon fas fa-building iCheck"></i>
                <p>WareHouse</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $supplier ? $menu : '' }}">
    <a href="#" class="nav-link {{ $supplier ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-users iCheck"></i>
        <p>
            Supplier
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.supplier.create') }}" class="nav-link @yield('add-supplier')">
                <i class="nav-icon fas fa-user-plus iCheck"></i>
                <p>Add Supplier</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.supplier.index') }}" class="nav-link @yield('supplier')">
                <i class="nav-icon fas fa-users iCheck"></i>
                <p>List Suppliers</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $customerNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $customerNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-users iCheck"></i>
        <p>
            Customer
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.customer.create') }}" class="nav-link @yield('add-customer')">
                <i class="nav-icon fas fa-user-plus iCheck"></i>
                <p>Add Customer</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.customer.index') }}" class="nav-link @yield('customer')">
                <i class="nav-icon fas fa-users iCheck"></i>
                <p>List Customers</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $productNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $productNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-shopping-bag iCheck"></i>
        <p>
            Product
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.product.create') }}" class="nav-link @yield('add-product')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>Add Product</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.product.index') }}" class="nav-link @yield('product')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>All Products</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $purchaseNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $purchaseNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-shopping-bag iCheck"></i>
        <p>
            Purchases
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.purchase.create') }}" class="nav-link @yield('add-purchase')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>Add Purchase</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.purchase.index') }}" class="nav-link @yield('purchase')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>List Purchases</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $saleNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $saleNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-shopping-bag iCheck"></i>
        <p>
            Sales
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.sale.create') }}" class="nav-link @yield('add-sale')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>Add Sale</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sale.index') }}" class="nav-link @yield('sale')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>List Sales</p>
            </a>
        </li>
    </ul>
</li>

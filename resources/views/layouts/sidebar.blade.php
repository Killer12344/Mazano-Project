<div class="col-12 col-lg-3 col-xl-2 vh-100 sidebar">
    <div class="d-flex justify-content-between align-items-center py-2 mt-3 nav-brand">
        <div class="d-flex align-items-center">
                    <span class="bg-primary p-2 rounded d-flex justify-content-center align-items-center mr-2">
                        <i class="feather-shopping-bag text-white h4 mb-0"></i>
                    </span>
            <span class="font-weight-bolder h4 mb-0 text-uppercase text-primary">My Shop</span>
        </div>
        <button class="hide-sidebar-btn btn btn-light d-block d-lg-none">
            <i class="feather-x text-primary" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>
            <li class="menu-spacer"></li>

            <li class="menu-item">
                <a href="{{ route('home') }}" class="menu-item-link @if(request()->url() == route('home')) active @endif">
                            <span>
                                <i class="feather-home"></i>
                                 Dashboard
                            </span>
                </a>
            </li>

{{--            <li class="menu-item">--}}
{{--                <a href="plane.html" class="menu-item-link">--}}
{{--                            <span>--}}
{{--                                <i class="feather-shopping-bag"></i>--}}
{{--                                Today Orders--}}
{{--                            </span>--}}
{{--                    <span class="badge badge-pill bg-white shadow-sm text-primary">15</span>--}}

{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="menu-item">--}}
{{--                <a href="plane.html" class="menu-item-link">--}}
{{--                            <span>--}}
{{--                                <i class="feather-grid"></i>--}}
{{--                                Recent Items--}}
{{--                            </span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="menu-item">--}}
{{--                <a href="plane.html" class="menu-item-link">--}}
{{--                            <span>--}}
{{--                                <i class="feather-pie-chart"></i>--}}
{{--                                Data Analysis--}}
{{--                            </span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="menu-item">--}}
{{--                <a href="plane.html" class="menu-item-link">--}}
{{--                            <span>--}}
{{--                                <i class="feather-file"></i>--}}
{{--                                Plane Page--}}
{{--                            </span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="menu-spacer"></li>



            <x-menu-title title="Item Manager"></x-menu-title>
            <x-menu-item name="Brand" link="{{ route('brand.index') }}" class="feather-layers"></x-menu-item>
            <x-menu-item name="Category Manager" link="{{ route('category.index') }}" class="feather-layers"></x-menu-item>
            <x-menu-item name="Product" link="{{ route('product.create') }}" class="feather-tag"></x-menu-item>
            <x-menu-item name="Product List" link="{{ route('product.index') }}" class="feather-list"></x-menu-item>
            <x-menu-item name="User List" link="{{ route('user-list') }}" class="feather-users" active=""></x-menu-item>

            <li class="menu-spacer"></li>
            <x-menu-title title="User Manager"></x-menu-title>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="feather-user"></i> User
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>

        </ul>
    </div>
</div>

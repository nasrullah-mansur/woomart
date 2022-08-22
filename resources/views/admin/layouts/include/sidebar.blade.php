<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img
                @if(Auth::guard(GUARD_ADMIN)->user()->image) src="{{Auth::guard(GUARD_ADMIN)->user()->image}}"
                @else src="{{asset('assets/admin/dist/img/user2-160x160.jpg')}}"
                @endif class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="{{route('admin.profile')}}" class="d-block"> @if(Auth::guard('admin')->check())
                    {{Auth::guard('admin')->user()->name  }}
                @endif</a>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <!--start Dashboard  Menu -->
            <li class="nav-item">

                <a href="{{route('admin.dashboard')}}"
                   class="nav-link {{isset($menu) && $menu == 'Dashboard' ?'active open':''}}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            <!--end dashboard  Menu -->

            <!--start Sidebar Menu -->
            <li class="nav-item">
                <a href="{{route('admin.slider')}}"
                   class="nav-link {{isset($menu) && $menu == 'Slider' ?'active open':''}}">
                    <i class="nav-icon fab fa-slideshare"></i>

                    <p>
                        Slider
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            <!--end Sidebar Menu -->

            <!--start Sidebar Menu -->
            <li class="nav-item">
                <a href="{{route('admin.banner')}}"
                   class="nav-link {{isset($menu) && $menu == 'Banner' ?'active open':''}}">
                    <i class="nav-icon fab fa-accusoft"></i>
                    <p>
                        Banner
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            <!--end Sidebar Menu -->

            <!--start attribute  Menu -->
            <li class="nav-item has-treeview {{isset($menu) && $menu == 'Attribute' ?'menu-open':''}}">
                <a href="#"
                   class="nav-link {{isset($menu) && $menu == 'Attribute' ?'active':''}} ">
                    <i class="nav-icon fab fa-asymmetrik"></i>

                    <p>
                        Attribute
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('admin.color')}}"
                           class="nav-link {{isset($page_title) && $page_title== 'Color' ? 'active open' : ''  }}">

                            <i class="fas fa-gifts"></i>
                            <p>Color</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{route('admin.size')}}"
                           class="nav-link {{isset($page_title) &&  $page_title== 'Size' ?'active open':''}}">
                            <i class="fas fa-code-branch"></i>
                            <p> Size</p>
                        </a>
                    </li>

                </ul>
            </li>
            <!--end attribute  Menu -->

            <!--start Products  Menu -->
            <li class="nav-item has-treeview {{isset($menu) && $menu == 'Products' ?'menu-open':''}}">
                <a href="#"
                   class="nav-link {{isset($menu) && $menu == 'Products' ?'active':''}} ">
                    <i class="fa fa-plus text-success" aria-hidden="true"></i>
                    <p>
                        Products
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('admin.product')}}"
                           class="nav-link {{isset($page_title) && $page_title== 'Product' ? 'active open' : ''  }}">

                            <i class="fas fa-gifts"></i>
                            <p>Products</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{route('admin.category')}}"
                           class="nav-link {{isset($page_title) &&  $page_title== 'Category' ?'active open':''}}">
                            <i class="fas fa-code-branch"></i>
                            <p> Categories</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.brand')}}"
                           class="nav-link {{isset($page_title) && $page_title== 'Brand' ?'active open':''}}">
                            <i class="fas fa-random"></i>
                            <p> Brands</p>
                        </a>
                    </li>


                </ul>
            </li>
            <!--end Products  Menu -->

            <!--start users  Menu -->
        {{--            <li class="nav-item {{isset($page_title) && in_array($page_title,['All Users','User Orders'])  ?'active open':''}}">--}}

        {{--                <a href="{{route('admin.all.users')}}"--}}
        {{--                   class="nav-link {{isset($page_title) &&in_array($page_title,['All Users','User Orders'])  ?'active open':''}}">--}}

        {{--                    <i class="fas fa-user" aria-hidden="true"></i>--}}
        {{--                    <p>--}}
        {{--                        All Users--}}
        {{--                        <span class="right badge badge-danger"></span>--}}
        {{--                    </p>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        <!--end users  Menu -->

            <!--start Orders  Menu -->
        {{--            <li class="nav-item has-treeview {{isset($menu) && $menu == 'Orders' ?'menu-open':''}}">--}}
        {{--                <a href="#"--}}

        {{--                   class="nav-link ">--}}

        {{--                    <i class="fa fa-plus text-warning" aria-hidden="true"></i>--}}

        {{--                    <p>--}}
        {{--                        Orders--}}
        {{--                        <i class="fas fa-angle-left right"></i>--}}
        {{--                    </p>--}}
        {{--                </a>--}}
        {{--                <ul class="nav nav-treeview">--}}
        {{--                    <?php--}}
        {{--                    $order_types = orderStatus()--}}

        {{--                    ?>--}}
        {{--                    <li class="nav-item">--}}

        {{--                        <a href="{{route('admin.orders')}}"--}}
        {{--                           class="nav-link {{isset($page_title) && $page_title== 'All Orders' ?'active open':''}} ">--}}

        {{--                            <i class="fas fa-shopping-cart"></i>--}}
        {{--                            <p>All Orders</p>--}}
        {{--                        </a>--}}
        {{--                    </li>--}}

        {{--                    <li class="nav-item">--}}

        {{--                        <a href="{{route('admin.all.order.products')}}"--}}
        {{--                           class="nav-link {{isset($page_title) && $page_title== 'All order Products' ?'active open':''}} ">--}}

        {{--                            <i class="fas fa-shopping-cart"></i>--}}
        {{--                            <p>All Orders Products</p>--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                    @foreach($order_types as $key => $value)--}}

        {{--                        <li class="nav-item">--}}

        {{--                            <a href="{{route('admin.orders', encrypt($key))}}"--}}
        {{--                               class="nav-link {{isset($pageSettings['page_title']) && $pageSettings['page_title'] ==  'All Orders' ? 'active' : ''  }}">--}}
        {{--                                <i class="fas fa-shopping-cart"></i>--}}
        {{--                                <p>{{$value}}</p>--}}
        {{--                            </a>--}}
        {{--                        </li>--}}
        {{--                    @endforeach--}}


        {{--                    <li class="nav-item">--}}

        {{--                        <a href="{{route('admin.all.deleted.order')}}"--}}
        {{--                           class="nav-link {{isset($page_title) && $page_title== 'Deleted Orders' ?'active open':''}} ">--}}

        {{--                            <i class="fas fa-shopping-cart"></i>--}}
        {{--                            <p>Trash</p>--}}
        {{--                        </a>--}}
        {{--                    </li>--}}

        {{--                </ul>--}}
        {{--            </li>--}}
        <!--end Orders  Menu -->



            {{--    Contact us Start--}}


            {{--            <li class="nav-item">--}}
            {{--                <a href="{{route('admin.contact.index')}}"--}}
            {{--                   class="nav-link {{isset($page_title) && $page_title== 'Contact' ? 'active open':''}}">--}}
            {{--                    <i class="fa fa-gift" aria-hidden="true"></i>--}}
            {{--                    <p>--}}
            {{--                        Contacts--}}
            {{--                        <span class="right badge badge-danger"></span>--}}
            {{--                    </p>--}}
            {{--                </a>--}}
            {{--            </li>--}}

            {{--   Contact us End--}}








            {{--    GGeneral Settings Start--}}


            <li class="nav-item">
                <a href="{{route('admin.general.settings')}}"
                   class="nav-link {{isset($page_title) && $page_title == 'General Settings' ?'active open':''}}">
                    <i class="nav-icon fab fa-accusoft"></i>
                    <p>
                        General Settings
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            <!--   General Settings End-->


            {{--    Pages Start--}}


            <li class="nav-item has-treeview {{isset($menu) && $menu == 'Pages'  ? 'menu-open': ''}} ">
                <a href="#" class="nav-link {{isset($menu) && $menu == 'Pages'  ? 'menu-open': ''}} ">

                    <i class="fa fa-cog text-info" aria-hidden="true"></i>
                    <p>
                        Pages
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('admin.page.home')}}"

                           class="nav-link {{isset($page_title) && $page_title == 'Home' ?'active open':''}}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                               Home
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.page.sign_up_sign_in')}}"

                           class="nav-link {{isset($page_title) && $page_title == 'Sign Up & Sign In' ?'active open':''}}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Sign Up & Sign In
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.contact.us.settings')}}"

                           class="nav-link {{isset($page_title) && $page_title == 'Contact us' ?'active open':''}}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Contact us
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.page.about_us')}}"

                           class="nav-link {{isset($page_title) && $page_title == 'About Us' ?'active open':''}}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                About Us
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.talent.team')}}"

                           class="nav-link {{isset($page_title) && $page_title == 'Talent Team' ?'active open':''}}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Talent Team
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.client.feedback')}}"

                           class="nav-link {{isset($page_title) && $page_title == 'Client feedback' ?'active open':''}}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                               Client feedback
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{route('admin.page.shop')}}"

                           class="nav-link {{isset($page_title) && $page_title == 'Shop Banner' ?'active open':''}}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Shop Banner
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.page.term.and.condition')}}"

                           class="nav-link {{isset($page_title) && $page_title == 'Terms and Conditions' ?'active open':''}}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Terms and Conditions
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.page.404')}}"

                           class="nav-link {{isset($page_title) && $page_title == '404' ?'active open':''}}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Error 404
                            </p>
                        </a>
                    </li>


                </ul>
            </li>

            <!--   Pages End-->

            <!--start Sidebar Menu -->
            <li class="nav-item">
                <a href="{{route('admin.blog')}}"
                   class="nav-link {{isset($menu) && $menu == 'Blog' ?'active open':''}}">
                    <i class="nav-icon fab fa-accusoft"></i>
                    <p>
                        Blog
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            <!--end Sidebar Menu -->

            <!--end profile Menu -->
            <li class="nav-item">
                <a href="{{route('admin.profile')}}"

                   class="nav-link {{isset($page_title) && $page_title == 'Profile' ?'active open':''}}">
                    <i class="nav-icon fas fa-user-circle"></i>
                    <p>
                        Profile
                    </p>
                </a>
            </li>
            <!--end profile Menu -->



            {{--            <li class="nav-item">--}}
            {{--                <a href="{{route('admin.logout')}}"--}}
            {{--                   class="nav-link {{ isset($pageSettings['page_title']) && $pageSettings['page_title'] == 'logout' ?'active':''}}">--}}
            {{--                    <i class="nav-icon fas fa-sign-out-alt text-danger"></i>--}}
            {{--                    <p>--}}
            {{--                        Logout--}}
            {{--                    </p>--}}
            {{--                </a>--}}
            {{--            </li>--}}


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>

<ul>
    <li
        class="menu-item  ">
        <a href="{{route(currentUser().'.dashboard')}}" class='menu-link'>
            <i class="bi bi-grid-fill"></i>
            <span>{{__('dashboard') }}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.profile')}}" class='menu-link'>
            <i class="bi bi-gear"></i>
            <span>{{__('My Account Info')}}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.compaccinfo.create')}}" class='menu-link'>
            <i class="bi bi-gear"></i>
            <span>{{__('Company Info')}}</span>
        </a>
    </li>
    <li class="menu-item has-sub">
        <a href="#" class='menu-link'>
            <i class="bi bi-gear"></i>
            <span>{{__('Settings')}}</span>
        </a>
        <div class="submenu ">
            <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
            <div class="submenu-group-wrapper">
                <ul class="submenu-group">
                    <li class="submenu-item"><a href="{{route(currentUser().'.admin.index')}}" class='submenu-link'>{{__('Users')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.clientTransferList')}}" class='submenu-link'>{{__('Transfer Client')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.bodytype.index')}}" class='submenu-link'>{{__('Body Type')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.subbodytype.index')}}" class='submenu-link'>{{__('Sub Body Type')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.drivetype.index')}}" class='submenu-link'>{{__('Drive Type')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.country.index')}}" class='submenu-link'>{{__('Country')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.invloc.index')}}" class='submenu-link'>{{__('Inventory Locations')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.port.index')}}" class='submenu-link'>{{__('Port')}}</a></li>
                    {{--<li class="submenu-item"><a href="{{route(currentUser().'.department.index')}}" class='submenu-link'>{{__('Department')}}</a></li>
                    <li class="submenu-item has-sub"><a href="#" class='submenu-link'>{{__('Company')}}</a>
                        <ul class="subsubmenu">
                            <li class="subsubmenu-item"><a class="subsubmenu-link" href="{{route(currentUser().'.company.index')}}">{{__('Company')}}</a></li>
                            <li class="subsubmenu-item"><a class="subsubmenu-link" href="{{route(currentUser().'.warehouse.index')}}">{{__('Warehouse')}}</a></li>
                            <li class="subsubmenu-item"><a class="subsubmenu-link" href="{{route(currentUser().'.warehouseboard.index')}}">{{__('Warehouse Board')}}</a></li>
                        </ul>
                    </li>
                    <li class="submenu-item has-sub"><a href="#" class='submenu-link'>{{__('Unit')}}</a>
                        <ul class="subsubmenu">
                            <li class="subsubmenu-item"><a class="subsubmenu-link" href="{{route(currentUser().'.unitstyle.index')}}">{{__('Unit Style')}}</a></li>
                            <li class="subsubmenu-item"><a class="subsubmenu-link" href="{{route(currentUser().'.unit.index')}}">{{__('Unit')}}</a></li>
                        </ul>
                    </li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.buyer.index')}}" class='submenu-link'>{{__('Buyers')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.supplier.index')}}" class='submenu-link'>{{__('Suppliers')}}</a></li>--}}
                </ul>  
            </div>
        </div>
    </li>
    <li class="menu-item has-sub">
        <a href="#" class='menu-link'>
            <i class="bi bi-car-front-fill"></i>
            <span>{{__('Vehicles')}}</span>
        </a>
        <div class="submenu ">
            <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
            <div class="submenu-group-wrapper">
                <ul class="submenu-group">
                    <li class="submenu-item"><a href="{{route(currentUser().'.vehicle.index')}}" class='submenu-link'>{{__('Vehicle')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.brand.index')}}" class='submenu-link'>{{__('Brand')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.subBrand.index')}}" class='submenu-link'>{{__('Sub Brand')}}</a></li>
                    {{--<li class="submenu-item"><a href="{{route(currentUser().'.vehicle_model.index')}}" class='submenu-link'>{{__('Vehicle Model')}}</a></li>--}}
                    <li class="submenu-item"><a href="{{route(currentUser().'.color.index')}}" class='submenu-link'>{{__('Color')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.door.index')}}" class='submenu-link'>{{__('Door')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.seat.index')}}" class='submenu-link'>{{__('Seat')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.condition.index')}}" class='submenu-link'>{{__('Condition')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.fuel.index')}}" class='submenu-link'>{{__('Fuel')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.transmission.index')}}" class='submenu-link'>{{__('Transmission')}}</a></li>
                </ul>  
            </div>
        </div>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.reservevehicle.index')}}" class='menu-link'>
            <i class="bi bi-shop"></i>
            <span>{{__('Reserved List')}}</span>
        </a>
    </li>
    <li class="menu-item has-sub">
        <a href="#" class='menu-link'>
            <i class="bi bi-shop"></i>
            <span>{{__('Buy|Inquiry')}}</span>
        </a>
        <div class="submenu ">
            <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
            <div class="submenu-group-wrapper">
                <ul class="submenu-group">
                    <li class="submenu-item"><a href="{{route(currentUser().'.buy.index')}}" class='submenu-link'>{{__('Buy')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.inquiry.index')}}" class='submenu-link'>{{__('Inquiry')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.contactus.index')}}" class='submenu-link'>{{__('Contact Us')}}</a></li>
                </ul>  
            </div>
        </div>
    </li>
    <!-- <li class="menu-item has-sub">
        <a href="#" class='menu-link'>
            <i class="bi bi-list"></i>
            <span>{{__('Reports')}}</span>
        </a>
        <div class="submenu ">
            

        </div>
    </li> -->

</ul>
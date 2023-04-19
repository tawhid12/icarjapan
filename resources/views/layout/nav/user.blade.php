<ul>
    <li class="menu-item  ">
        <a href="{{route(currentUser().'.dashboard')}}" class='menu-link'>
            <i class="bi bi-grid-fill"></i>
            <span>{{__('dashboard') }}</span>
        </a>
    </li>

    <li class="menu-item has-sub">
        <a href="" class='menu-link'>
            <i class="bi bi-gear"></i>
            <span>{{__('My Profile')}}</span>
        </a>
        <div class="submenu">
            <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
            <div class="submenu-group-wrapper">
                <ul class="submenu-group">
                    <li class="submenu-item"><a href="{{route(currentUser().'.usercontact.index')}}" class='submenu-link'>{{__('Contact Information')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.userpref.index')}}" class='submenu-link'>{{__('Preference')}}</a></li>
                </ul>
            </div>
        </div>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.profile')}}" class='menu-link'>
            <i class="bi bi-gear"></i>
            <span>{{__('My Account Info')}}</span>
        </a>
    </li>
    <li class="menu-item has-sub">
        <a href="" class='menu-link'>
            <i class="bi bi-gear"></i>
            <span>{{__('Consignee')}}</span>
        </a>
        <div class="submenu ">
            <div class="submenu-group-wrapper">
                <ul class="submenu-group">
                    <li class="submenu-item"><a href="{{route(currentUser().'.consigdetl.index')}}" class='submenu-link'>{{__('Consignee List')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.consigdetl.create')}}" class='submenu-link'>{{__('Add Consignee')}}</a></li>
                </ul>
            </div>
        </div>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.favourvehicle.index')}}" class='menu-link'>
            <i class="bi bi-gear"></i>
            <span>{{__('Favourite Vehicle')}}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.inquiry.index')}}" class='menu-link'>
            <i class="bi bi-gear"></i>
            <span>{{__('Inquiry')}}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.invoice.index')}}" class='menu-link'>
            <i class="bi bi-shop"></i>
            <span>{{__('Invoice List')}}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.payment.index')}}" class='menu-link'>
            <i class="bi bi-shop"></i>
            <span>{{__('Payment List')}}</span>
        </a>
    </li>
    <li class="menu-item has-sub">
        <a href="#" class='menu-link'>
            <i class="bi bi-gear"></i>
            <span>{{__('Vehicles')}}</span>
        </a>
        <div class="submenu ">
            <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
            <div class="submenu-group-wrapper">
                <ul class="submenu-group">
                    <li class="submenu-item"><a href="{{route(currentUser().'.reservevehicle.index')}}" class='submenu-link'>{{__('Reserved Vehicle')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.purvehicle.index')}}" class='submenu-link'>{{__('Purchase Vehicle')}}</a></li>
                    <li class="submenu-item"><a href="{{route(currentUser().'.aucvehicle.index')}}" class='submenu-link'>{{__('Auction Vehicle')}}</a></li>
                </ul>
            </div>
        </div>
    </li>

</ul>
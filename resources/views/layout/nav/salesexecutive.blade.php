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
        <a href="{{route(currentUser().'.reservevehicle.index')}}" class='menu-link'>
            <i class="bi bi-shop"></i>
            <span>{{__('Reserved Vehicle List')}}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.invoice.index')}}" class='menu-link'>
            <i class="bi bi-shop"></i>
            <span>{{__('Invoice List')}}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.inquiry.index')}}" class='menu-link'>
            <i class="bi bi-shop"></i>
            <span>{{__('Inquiry List')}}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route(currentUser().'.payment.index')}}" class='menu-link'>
            <i class="bi bi-shop"></i>
            <span>{{__('Payment List')}}</span>
        </a>
    </li>

</ul>

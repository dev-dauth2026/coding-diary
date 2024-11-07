<li class="nav-item px-3 {{  request()->is($conditionUrl) ? 'bg-secondary' : '' }}">
    <a class="nav-link  {{ request()->is($conditionUrl) ? 'active text-white' : 'text-secondary' }}" href="{{route($url)}} ">
        <div class="d-flex align-items-center position-relative">
        <i class="fa-solid fa-{{$icon}} sidebar-icon fs-4 " style="width:25px;"></i> <span class="sidebar-text text-nowrap ms-3">{{$text}}</span>
        @if(isset($unreadMessageCount) && $text === 'Messages' &&$unreadMessageCount>0)
            <span id="unread-count" class="badge bg-danger ms-sm-auto ">{{ $unreadMessageCount }}</span>
        @endif
        </div>
    </a>
</li>
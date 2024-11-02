<li class="nav-item px-3 {{  request()->is($conditionUrl) ? 'bg-secondary' : '' }}">
    <a class="nav-link  {{ request()->is($conditionUrl) ? 'active text-white' : 'text-secondary' }}" href="{{route($url)}} ">
        <div class="d-flex align-items-center ">
        <i class="fa-solid fa-{{$icon}} sidebar-icon fs-4 me-3 " style="width:25px;"></i> <span class="sidebar-text text-nowrap">{{$text}}</span>
        @if(isset($unreadMessageCount) && $text === 'Messages' &&$unreadMessageCount>0)
            <span id="unread-count" class="badge bg-danger ms-auto">{{ $unreadMessageCount }}</span>
        @endif
        </div>
    </a>
</li>
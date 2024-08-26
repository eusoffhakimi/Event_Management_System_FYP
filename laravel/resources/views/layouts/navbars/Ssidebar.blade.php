<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ url('/') }}" class="simple-text logo-mini">{{ __('ES') }}</a>
            <a href="{{ url('/') }}" class="simple-text logo-normal">{{ __('Event System') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'jevent') class="active " @endif>
                <a href="{{ route('SJoinEvent.index') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ __('Join Event') }}</p>
                </a>
            </li>
            {{-- <li @if ($pageSlug == 'vevent') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('View Event') }}</p>
                </a>
            </li> --}}
            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('SProfilePage.edit') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('Profile') }}</p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'logout' ? 'active' : '' }} bg-info">
                <a href="{{ route('logout')}}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                    <i class="tim-icons icon-spaceship"></i>
                    <p>{{ __('Logout') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>

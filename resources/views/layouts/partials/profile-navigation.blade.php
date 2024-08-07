                            <!-- Account page navigation-->
                            <nav class="nav nav-borders">
                                <a class="nav-link {{ request()->routeIs('client.profile') ? 'active' : '' }} ms-0" href="{{ route('client.profile') }}">@autotranslate('My Profile', app()->getLocale())</a>
                                <a class="nav-link {{ request()->routeIs('client.notifications') ? 'active' : '' }}" href="{{ route('client.notifications') }}">@autotranslate('Notifications', app()->getLocale())</a>
                                <a class="nav-link {{ request()->routeIs('client.security') ? 'active' : '' }}" href="{{ route('client.security') }}">@autotranslate('Security', app()->getLocale())</a>
                            </nav>

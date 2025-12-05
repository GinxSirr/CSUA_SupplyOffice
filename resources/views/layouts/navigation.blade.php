<nav x-data="{ open: false }" class="win-menubar shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-10">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mr-6">
                    <a href="{{ route('dashboard') }}" class="font-bold text-lg" style="color: #000;">
                        📦 CSUA Supply Office
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-1">
                    <a href="{{ route('dashboard') }}" class="win-menu-item {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : '' }}">
                        Home
                    </a>

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('products.index') }}" class="win-menu-item {{ request()->routeIs('products.*') ? 'bg-blue-600 text-white' : '' }}">
                            Products
                        </a>
                        <a href="{{ route('supply-requests.index') }}" class="win-menu-item {{ request()->routeIs('supply-requests.*') ? 'bg-blue-600 text-white' : '' }}">
                            Requests
                        </a>
                        <a href="{{ route('inspections.index') }}" class="win-menu-item {{ request()->routeIs('inspections.*') ? 'bg-blue-600 text-white' : '' }}">
                            IAR
                        </a>
                        <a href="{{ route('property-acknowledgments.index') }}" class="win-menu-item {{ request()->routeIs('property-acknowledgments.*') ? 'bg-blue-600 text-white' : '' }}">
                            PAR
                        </a>
                    @else
                        <a href="{{ route('supply-requests.index') }}" class="win-menu-item {{ request()->routeIs('supply-requests.*') ? 'bg-blue-600 text-white' : '' }}">
                            My Requests
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="win-button inline-flex items-center">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">▼</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="win-button p-2">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-400 mt-1">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Home
            </x-responsive-nav-link>

            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                    Products
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('supply-requests.index')" :active="request()->routeIs('supply-requests.*')">
                    Requests
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('supply-requests.index')" :active="request()->routeIs('supply-requests.*')">
                    My Requests
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-bold text-base">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

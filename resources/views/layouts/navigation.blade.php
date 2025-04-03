<nav x-data="{ open: false }" class="bg-white shadow-md sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center group">
                        <x-application-logo class="block h-9 w-auto fill-current text-indigo-600 transition-transform group-hover:scale-110" />
                        <span class="ml-2 text-xl font-bold text-gray-800 hidden md:block transition-colors duration-200 group-hover:text-indigo-600">Sistema Control de Asistencia</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-indigo-600 px-3 py-2 rounded-lg transition-all duration-200 hover:bg-indigo-50">
                        <i class="fas fa-home mr-2 text-indigo-500"></i> {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')" class="hover:text-indigo-600 px-3 py-2 rounded-lg transition-all duration-200 hover:bg-indigo-50">
                        <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i> {{ __('Vacaciones') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('permisos-economicos.index') }}" class="hover:text-indigo-600 px-3 py-2 rounded-lg transition-all duration-200 hover:bg-indigo-50">
                        <i class="fas fa-file-invoice-dollar mr-2 text-indigo-500"></i> {{ __('Permisos Económicos') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side Of Navbar -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:text-indigo-600 focus:outline-none transition ease-in-out duration-150 hover:bg-gray-50 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold mr-2 group-hover:bg-indigo-200 transition-colors duration-200">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="truncate max-w-xs">{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="ml-1 h-4 w-4 transition-transform duration-200 group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <div class="font-medium text-gray-900 truncate">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center hover:bg-indigo-50">
                            <i class="fas fa-user-circle mr-2 text-indigo-500"></i> {{ __('Perfil') }}
                        </x-dropdown-link>
                        <div class="border-t border-gray-200"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="flex items-center text-red-600 hover:bg-red-50 hover:text-red-800">
                                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-indigo-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white shadow-lg">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center px-4 py-3 hover:bg-indigo-50">
                <i class="fas fa-home mr-3 w-5 text-center text-indigo-500"></i> {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')" class="flex items-center px-4 py-3 hover:bg-indigo-50">
                <i class="fas fa-calendar-alt mr-3 w-5 text-center text-indigo-500"></i> {{ __('Vacaciones') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('permisos-economicos.index') }}" class="flex items-center px-4 py-3 hover:bg-indigo-50">
                <i class="fas fa-file-invoice-dollar mr-3 w-5 text-center text-indigo-500"></i> {{ __('Permisos Económicos') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex items-center mb-3">
                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold mr-3">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center px-4 py-3 hover:bg-indigo-50">
                    <i class="fas fa-user-circle mr-3 w-5 text-center text-indigo-500"></i> {{ __('Perfil') }}
                </x-responsive-nav-link>
                
                <div class="border-t border-gray-200"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i> {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<nav x-data="{ open: false }" class="bg-gradient-to-r from-indigo-50 to-white border-b border-indigo-100 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center group">
                        <x-application-logo class="block h-8 w-auto fill-current text-indigo-600 transition-transform group-hover:scale-105" />
                        <span class="ml-2 text-lg font-semibold text-gray-700 hidden md:block transition-colors duration-200 group-hover:text-indigo-600">Admin Asistencia</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:ml-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-3 py-2 rounded-lg transition-all duration-200 hover:bg-white hover:shadow-xs hover:text-indigo-700 border border-transparent hover:border-indigo-100">
                        <i class="fas fa-home mr-2 text-indigo-500"></i> {{ __('Panel') }}
                    </x-nav-link>
                    <x-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')" class="px-3 py-2 rounded-lg transition-all duration-200 hover:bg-white hover:shadow-xs hover:text-indigo-700 border border-transparent hover:border-indigo-100">
                        <i class="fas fa-calendar-check mr-2 text-indigo-500"></i> {{ __('Vacaciones') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('permisos-economicos.index') }}" :active="request()->routeIs('permisos-economicos.*')" class="px-3 py-2 rounded-lg transition-all duration-200 hover:bg-white hover:shadow-xs hover:text-indigo-700 border border-transparent hover:border-indigo-100">
                        <i class="fas fa-file-invoice mr-2 text-indigo-500"></i> {{ __('Permisos') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side Of Navbar -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white bg-opacity-80 hover:bg-opacity-100 focus:outline-none transition ease-in-out duration-150 hover:shadow-xs border border-indigo-100 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-medium mr-2 group-hover:bg-indigo-200 transition-colors duration-200">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="truncate max-w-xs text-sm">{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="ml-1 h-4 w-4 text-indigo-400 transition-transform duration-200 group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content" class="shadow-md border border-indigo-50">
                        <div class="px-4 py-2 border-b border-indigo-100 bg-indigo-50">
                            <div class="font-medium text-gray-800 text-sm truncate">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-indigo-600 truncate">{{ Auth::user()->email }}</div>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center text-sm hover:bg-indigo-50">
                            <i class="fas fa-user-edit mr-2 text-indigo-500 w-4 text-center"></i> {{ __('Mi perfil') }}
                        </x-dropdown-link>
                        
                        <div class="border-t border-indigo-100"></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="flex items-center text-sm text-rose-600 hover:bg-rose-50">
                                <i class="fas fa-sign-out-alt mr-2 w-4 text-center"></i> {{ __('Salir') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-indigo-600 hover:text-indigo-800 hover:bg-indigo-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white shadow-inner">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center px-4 py-3 hover:bg-indigo-50">
                <i class="fas fa-home mr-3 text-indigo-500 w-5 text-center"></i> {{ __('Panel') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')" class="flex items-center px-4 py-3 hover:bg-indigo-50">
                <i class="fas fa-calendar-check mr-3 text-indigo-500 w-5 text-center"></i> {{ __('Vacaciones') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('permisos-economicos.index') }}" :active="request()->routeIs('permisos-economicos.*')" class="flex items-center px-4 py-3 hover:bg-indigo-50">
                <i class="fas fa-file-invoice mr-3 text-indigo-500 w-5 text-center"></i> {{ __('Permisos') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-indigo-100">
            <div class="px-4 flex items-center mb-3">
                <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-medium mr-3">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-indigo-600">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center px-4 py-3 hover:bg-indigo-50 text-sm">
                    <i class="fas fa-user-edit mr-3 text-indigo-500 w-5 text-center"></i> {{ __('Mi perfil') }}
                </x-responsive-nav-link>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center px-4 py-3 text-rose-600 hover:bg-rose-50 text-sm">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i> {{ __('Salir') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
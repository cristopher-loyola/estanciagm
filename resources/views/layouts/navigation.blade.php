<nav x-data="{ open: false, notificationsOpen: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                        {{ __('Calendario') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side Of Navbar -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Notifications Dropdown -->
                <div class="relative ml-3 mr-4">
                    <button @click="notificationsOpen = !notificationsOpen" 
                            @click.away="notificationsOpen = false"
                            class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Notificaciones</span>
                        <i class="fas fa-bell text-lg"></i>
                        @auth
                            @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-0 right-0 inline-block w-5 h-5 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full text-xs text-white text-center">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                            @endif
                        @endauth
                    </button>
                    
                    <!-- Notifications Dropdown Panel -->
                    <div x-show="notificationsOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="origin-top-right absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                        <div class="max-h-60 overflow-y-auto">
                            @auth
                                @forelse(auth()->user()->notifications as $notification)
                                <a href="{{ $notification->data['url'] ?? '#' }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ $notification->unread() ? 'bg-blue-50' : '' }}"
                                   @click="markAsRead('{{ $notification->id }}')">
                                    <div class="flex justify-between">
                                        <span>{{ $notification->data['message'] }}</span>
                                        @if($notification->unread())
                                        <span class="text-xs text-blue-500">Nuevo</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </a>
                                @empty
                                <div class="px-4 py-2 text-sm text-gray-500">
                                    No tienes notificaciones
                                </div>
                                @endforelse
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                {{ __('Calendario') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>

                    <a href="{{ $notification->data['url'] }}" 
   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ $notification->unread() ? 'bg-blue-50' : '' }}"
   @click="markAsRead('{{ $notification->id }}')">
    <!-- ... -->
</a>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
// Función para marcar como leída (compatible con Alpine)
function markAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/mark-as-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    }).then(response => {
        if(response.ok) {
            // Actualizar contador de notificaciones
            const badge = document.querySelector('.notification-badge');
            if(badge) {
                const count = parseInt(badge.textContent) - 1;
                badge.textContent = count > 0 ? count : '';
                if(count <= 0) badge.remove();
            }
            
            // Actualizar el estilo de la notificación
            const notificationElement = document.querySelector(`a[onclick*="${notificationId}"]`);
            if(notificationElement) {
                notificationElement.classList.remove('bg-blue-50');
                const newBadge = notificationElement.querySelector('.text-blue-500');
                if(newBadge) newBadge.remove();
            }
        }
    });
}

// Hacer la función disponible globalmente
window.markAsRead = markAsRead;
</script>
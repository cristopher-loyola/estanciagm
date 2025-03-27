<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de ') }} {{ Auth::user()->area->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("¡Bienvenido a tu panel de control!") }}
                    <p class="mt-2 text-sm text-gray-500">
                        Estás registrado en el área de: 
                        <span class="font-medium">{{ Auth::user()->area->nombre }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->unreadNotifications->count())
<div class="notification-bell">
    <i class="fas fa-bell"></i>
    <span class="notification-count">{{ auth()->user()->unreadNotifications->count() }}</span>
</div>
@endif

@foreach(auth()->user()->notifications as $notification)
<div class="notification-item {{ $notification->unread() ? 'unread' : '' }}">
    <p>{{ $notification->data['message'] }}</p>
    <small>{{ $notification->created_at->diffForHumans() }}</small>
    @if($notification->unread())
    <a href="{{ route('notifications.markAsRead', $notification) }}">Marcar como leída</a>
    @endif
</div>
@endforeach
</x-app-layout>
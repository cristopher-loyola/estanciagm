<x-guest-layout>
    <div class="fixed inset-0 bg-gradient-to-b from-gray-900 via-purple-900 to-gray-900 z-0"></div>
    <div id="stars-container" class="fixed inset-0 overflow-hidden z-0"></div>

    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 sm:px-0">
        <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

        <div class="w-full sm:max-w-md px-6 py-8 bg-gray-800/80 backdrop-blur-md shadow-lg overflow-hidden sm:rounded-lg border border-gray-700">
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <svg class="h-16 w-16 text-blue-400 planet-logo" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="url(#planetGradient)"/>
                        <path d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" fill="url(#ringGradient)"/>
                        <defs>
                            <linearGradient id="planetGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#3a7bd5"/>
                                <stop offset="100%" stop-color="#00d2ff"/>
                            </linearGradient>
                            <linearGradient id="ringGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#00d2ff"/>
                                <stop offset="100%" stop-color="#3a7bd5"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="satellite"></div>
                </div>
            </div>

            <h2 class="text-center text-3xl font-extrabold text-white mb-6 font-orbitron">
                Inicio de Sesión
            </h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white-300" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:ring-blue-500 focus:border-blue-500" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="username" 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-white-300" />

                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:ring-blue-500 focus:border-blue-500"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password" 
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            class="rounded border-gray-600 bg-gray-700 text-blue-500 focus:ring-blue-600 focus:ring-offset-gray-800" 
                            name="remember"
                        >
                        <span class="ms-2 text-sm text-gray-300">{{ __('Recordarme') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <!-- <a class="text-sm text-blue-400 hover:text-blue-300 focus:outline-none focus:underline" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a> -->
                    @endif

                    <x-primary-button class="ms-3 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600">
                        {{ __('Ingresar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .planet-logo {
            animation: rotate 20s linear infinite;
            transform-origin: center;
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .satellite {
            position: absolute;
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 8px 2px rgba(100, 200, 255, 0.8);
            animation: orbit 6s linear infinite;
            top: 50%;
            left: 50%;
            margin-top: -4px;
            margin-left: -4px;
        }
        @keyframes orbit {
            from { transform: rotate(0deg) translateX(30px) rotate(0deg); }
            to { transform: rotate(360deg) translateX(30px) rotate(-360deg); }
        }
        #stars-container .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle var(--duration) infinite ease-in-out;
        }
        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }
        .font-orbitron {
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
        }
    </style>

    <script>
        // Crear estrellas decorativas
        document.addEventListener('DOMContentLoaded', function() {
            const starsContainer = document.getElementById('stars-container');
            const starCount = 150;
            
            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                
                // Tamaño aleatorio entre 1 y 3px
                const size = Math.random() * 2 + 1;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                
                // Posición aleatoria
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                
                // Duración de animación aleatoria
                star.style.setProperty('--duration', `${Math.random() * 5 + 3}s`);
                
                // Retraso de animación aleatorio
                star.style.animationDelay = `${Math.random() * 5}s`;
                
                starsContainer.appendChild(star);
            }
        });
    </script>
</x-guest-layout>
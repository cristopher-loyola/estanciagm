<x-guest-layout>
    <div class="fixed inset-0 bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 z-0"></div>
    <div id="stars-container" class="fixed inset-0 overflow-hidden z-0"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 sm:px-0">
        <div class="w-full sm:max-w-md">
            <div class="bg-gray-800/80 backdrop-blur-lg shadow-xl rounded-lg overflow-hidden border border-gray-700/50">
                <div class="px-10 py-8 border-b border-gray-700/50">
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
                    
                    <h2 class="text-center text-3xl font-bold text-white mb-2 font-orbitron">
                        Crear nueva cuenta
                    </h2>
                    <p class="text-center text-gray-400">
                        O <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 transition">inicia sesión si ya tienes una cuenta</a>
                    </p>
                </div>

                <form class="px-10 py-8" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="space-y-5">
                        <div>
                            <x-input-label for="name" :value="__('Nombre completo')" class="text-gray-300 mb-1" />
                            <x-text-input 
                                id="name" 
                                name="name" 
                                type="text" 
                                :value="old('name')" 
                                required 
                                autofocus 
                                autocomplete="name"
                                class="w-full bg-gray-700/50 border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-400" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Correo electrónico')" class="text-gray-300 mb-1" />
                            <x-text-input 
                                id="email" 
                                name="email" 
                                type="email" 
                                :value="old('email')" 
                                required 
                                autocomplete="email"
                                class="w-full bg-gray-700/50 border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-400" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-300 mb-1" />
                            <x-text-input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="w-full bg-gray-700/50 border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-400" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="text-gray-300 mb-1" />
                            <x-text-input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="w-full bg-gray-700/50 border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-400" />
                        </div>

                        <div>
                            <x-input-label for="id_area" :value="__('Área')" class="text-gray-300 mb-1" />
                            <select 
                                id="id_area" 
                                name="id_area" 
                                required
                                class="w-full bg-gray-700/50 border-gray-600 text-white rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="" disabled selected>Seleccione su área</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" {{ old('id_area') == $area->id ? 'selected' : '' }}>
                                        {{ $area->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_area')" class="mt-1 text-sm text-red-400" />
                        </div>

                        <div class="pt-2">
                            <x-primary-button class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Registrar cuenta
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
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
        select {
            padding: 0.5rem 0.75rem;
            height: 42px;
        }
        select option {
            background-color: #1e293b;
            color: white;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const starsContainer = document.getElementById('stars-container');
            const starCount = 200;
            
            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                
                const size = Math.random() * 2 + 1;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                
                star.style.setProperty('--duration', `${Math.random() * 5 + 3}s`);
                
                star.style.animationDelay = `${Math.random() * 5}s`;
                
                starsContainer.appendChild(star);
            }
        });
    </script>
</x-guest-layout>
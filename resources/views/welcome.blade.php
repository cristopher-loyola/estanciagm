<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control de Asistencia | Gómez Morín</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Reset y estilos base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }
        
        /* Layout principal */
        .main-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Header */
        .header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1.5rem 0;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1d4ed8;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logo-icon {
            width: 32px;
            height: 32px;
            background-color: #1d4ed8;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        /* Navegación */
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .nav-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            position: relative;
        }
        
        .nav-link:hover {
            color: #1d4ed8;
        }
        
        .nav-link.active {
            color: #1d4ed8;
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #1d4ed8;
        }
        
        /* Contenido principal */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
            text-align: center;
        }
        
        .title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #1e293b;
            line-height: 1.2;
        }
        
        .subtitle {
            font-size: 1.25rem;
            color: #64748b;
            max-width: 600px;
            margin-bottom: 3rem;
        }
        
        /* Footer */
        .footer {
            background-color: #ffffff;
            padding: 2rem 0;
            text-align: center;
            font-size: 0.875rem;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .title {
                font-size: 2.25rem;
            }
            
            .subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <a href="/" class="logo">
                    <span class="logo-icon">G</span>
                    <span>Gómez Morín</span>
                </a>
                
                @if (Route::has('login'))
                    <nav class="nav-links">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link {{ request()->is('login') ? 'active' : '' }}">
                                Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-link {{ request()->is('register') ? 'active' : '' }}">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Contenido principal -->
        <main class="main-content">
            <h1 class="title">Control de Asistencia</h1>
            <p class="subtitle">Sistema de gestión para empleados del centro cultural Manuel Gómez Morín</p>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>Centro Cultural Manuel Gómez Morín © {{ date('Y') }}</p>
        </footer>
    </div>
</body>
</html>
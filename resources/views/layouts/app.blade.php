<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AURA') | Cosmética Natural Premium</title>
    
    <!-- Vite Compilations of Tailwind CSS v4 -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gold-50 font-sans text-luxury-900 min-h-screen flex flex-col antialiased">

    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 glassmorphism shadow-xs border-b border-cream-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="font-serif text-3xl font-semibold tracking-widest text-gold-700 hover:text-gold-800 transition-colors duration-300">
                        AURA
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex space-x-10">
                    <a href="{{ route('home') }}" class="font-medium text-sm tracking-wider uppercase {{ Request::is('/') ? 'text-gold-700 border-b border-gold-500' : 'text-stone-600 hover:text-gold-600' }} transition-all py-1">
                        Inicio
                    </a>
                    <a href="{{ route('catalog.index') }}" class="font-medium text-sm tracking-wider uppercase {{ Request::is('catalog*') || Request::is('product*') ? 'text-gold-700 border-b border-gold-500' : 'text-stone-600 hover:text-gold-600' }} transition-all py-1">
                        Catálogo
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="font-medium text-sm tracking-wider uppercase {{ Request::is('admin*') ? 'text-gold-700 border-b border-gold-500' : 'text-stone-600 hover:text-gold-600' }} transition-all py-1">
                        Administración
                    </a>
                </nav>

                <!-- Action Utilities (Cart) -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-stone-700 hover:text-gold-600 transition-colors">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        @php
                            $cartCount = 0;
                            if (session()->has('cart')) {
                                foreach (session('cart') as $item) {
                                    $cartCount += $item['quantity'];
                                }
                            }
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-rose-500 text-xs font-semibold text-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </div>

            </div>
        </div>
    </header>

    <!-- Global Toast Alerts -->
    @if(session('success') || session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-sage-600 rounded-lg bg-sage-50 border border-sage-200 shadow-sm flex justify-between items-center" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-rose-600 rounded-lg bg-rose-50 border border-rose-200 shadow-sm flex justify-between items-center" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="bg-luxury-900 text-cream-100 border-t border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                
                <!-- Brand Manifesto -->
                <div class="space-y-4">
                    <h3 class="font-serif text-2xl font-bold tracking-widest text-gold-500">AURA</h3>
                    <p class="text-stone-400 text-sm leading-relaxed">
                        Creemos en la belleza consciente. Productos naturales de alta gama, formulados con ingredientes botánicos de origen ético para nutrir tu piel y calmar tus sentidos.
                    </p>
                </div>

                <!-- Fast Links -->
                <div>
                    <h4 class="font-serif text-lg font-semibold tracking-wider text-gold-500 mb-6">Navegación</h4>
                    <ul class="space-y-3 text-sm text-stone-400">
                        <li><a href="{{ route('home') }}" class="hover:text-cream-100 transition-colors">Inicio</a></li>
                        <li><a href="{{ route('catalog.index') }}" class="hover:text-cream-100 transition-colors">Catálogo Completo</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-cream-100 transition-colors">Mi Carrito</a></li>
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-cream-100 transition-colors">Panel de Control</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="font-serif text-lg font-semibold tracking-wider text-gold-500 mb-6">Categorías</h4>
                    <ul class="space-y-3 text-sm text-stone-400">
                        <li><a href="{{ route('catalog.index', ['category' => 'cuidado-facial']) }}" class="hover:text-cream-100 transition-colors">Cuidado Facial</a></li>
                        <li><a href="{{ route('catalog.index', ['category' => 'cuidado-corporal']) }}" class="hover:text-cream-100 transition-colors">Cuidado Corporal</a></li>
                        <li><a href="{{ route('catalog.index', ['category' => 'jabones-artesanales']) }}" class="hover:text-cream-100 transition-colors">Jabones Orgánicos</a></li>
                        <li><a href="{{ route('catalog.index', ['category' => 'serums-aceites']) }}" class="hover:text-cream-100 transition-colors">Sérums & Aceites</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="space-y-6">
                    <h4 class="font-serif text-lg font-semibold tracking-wider text-gold-500">Únete al Universo AURA</h4>
                    <p class="text-stone-400 text-sm">Suscríbete para recibir lanzamientos exclusivos, secretos de autocuidado y un 10% de descuento en tu primera compra.</p>
                    <form class="flex" onsubmit="event.preventDefault(); alert('¡Gracias por suscribirte!');">
                        <input type="email" placeholder="Tu correo electrónico" class="px-4 py-3 bg-stone-800 text-white border border-stone-700 text-sm focus:outline-hidden focus:border-gold-500 flex-grow rounded-l-md" required>
                        <button type="submit" class="bg-gold-500 hover:bg-gold-600 text-luxury-900 font-semibold px-4 rounded-r-md transition-colors">
                            Unirse
                        </button>
                    </form>
                </div>

            </div>

            <div class="border-t border-stone-800 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-stone-500">
                <p>&copy; {{ date('Y') }} AURA Cosmetics S.A. Todos los derechos reservados.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-cream-100 transition-colors">Términos de Servicio</a>
                    <a href="#" class="hover:text-cream-100 transition-colors">Política de Privacidad</a>
                    <a href="#" class="hover:text-cream-100 transition-colors">Envíos y Retornos</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>

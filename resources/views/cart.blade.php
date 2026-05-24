@extends('layouts.app')

@section('title', 'Mi Carrito de Compras')

@section('content')
    <section class="py-16 bg-gold-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-luxury-900 mb-10 text-center sm:text-left">Tu Carrito de Compras</h1>

            @if(empty($cart))
                <div class="text-center py-20 bg-white rounded-2xl shadow-xs border border-stone-100 space-y-6 max-w-2xl mx-auto p-8">
                    <span class="text-5xl">🛍️</span>
                    <h3 class="font-serif text-2xl font-bold text-stone-700">Tu carrito está vacío</h3>
                    <p class="text-stone-500 text-sm max-w-md mx-auto">
                        Parece que aún no has agregado ningún elixir o crema natural aura a tu ritual de autocuidado diario.
                    </p>
                    <a href="{{ route('catalog.index') }}" class="inline-block bg-luxury-900 hover:bg-gold-700 text-cream-100 font-semibold px-8 py-3.5 text-sm uppercase tracking-wider rounded-md transition-colors shadow-xs">
                        Explorar Catálogo
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                    
                    <!-- 1. Left Side: Items List -->
                    <div class="lg:col-span-8 space-y-6">
                        <div class="bg-white rounded-xl shadow-xs border border-stone-100 overflow-hidden">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-cream-100/50 border-b border-cream-200/60 text-stone-500 text-xs font-bold uppercase tracking-wider">
                                        <th class="p-6">Producto</th>
                                        <th class="p-6 text-center">Cantidad</th>
                                        <th class="p-6 text-right">Subtotal</th>
                                        <th class="p-6"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-100">
                                    @foreach($cart as $id => $item)
                                        <tr class="text-sm">
                                            
                                            <!-- Product details -->
                                            <td class="p-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="bg-stone-50 h-16 w-16 rounded-lg flex items-center justify-center flex-shrink-0 relative">
                                                        <span class="text-2xl text-gold-500/20">🌿</span>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-luxury-900 text-base">
                                                            <a href="{{ route('catalog.show', $item['slug']) }}" class="hover:text-gold-600 transition-colors">{{ $item['name'] }}</a>
                                                        </h4>
                                                        <p class="text-xs text-stone-500 mt-1">${{ $item['price'] }} c/u</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Quantity update form -->
                                            <td class="p-6">
                                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center justify-center border border-stone-200 rounded-md bg-stone-50 h-10 w-24 mx-auto px-2">
                                                    @csrf
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="text-stone-500 hover:text-luxury-900 font-bold p-1 text-sm">-</button>
                                                    <input type="text" value="{{ $item['quantity'] }}" class="w-8 text-center bg-transparent border-0 focus:ring-0 text-xs font-semibold focus:outline-hidden" readonly>
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="text-stone-500 hover:text-luxury-900 font-bold p-1 text-sm">+</button>
                                                </form>
                                            </td>

                                            <!-- Subtotal price -->
                                            <td class="p-6 text-right font-serif font-bold text-luxury-900 text-base">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </td>

                                            <!-- Remove button -->
                                            <td class="p-6 text-center">
                                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-stone-400 hover:text-rose-600 p-2 transition-colors" title="Remover de mi carrito">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Secondary Actions -->
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <a href="{{ route('catalog.index') }}" class="font-semibold text-xs tracking-wider uppercase text-stone-600 hover:text-gold-700 flex items-center gap-1 group">
                                <svg class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                Seguir Comprando
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs uppercase tracking-wider text-rose-500 hover:text-rose-600 font-semibold p-2 transition-colors">
                                    Vaciar Carrito
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- 2. Right Side: Order Summary Panel -->
                    <div class="lg:col-span-4">
                        <div class="p-8 bg-white rounded-xl shadow-xs border border-stone-100 space-y-6">
                            <h3 class="font-serif text-xl font-bold text-luxury-900 border-b border-stone-100 pb-4">Resumen del Pedido</h3>

                            <div class="space-y-4 text-sm text-stone-600">
                                <div class="flex justify-between">
                                    <span>Subtotal del carrito</span>
                                    <span class="font-semibold text-luxury-900">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Envío Asegurado</span>
                                    <span class="text-sage-500 font-semibold">Gratis</span>
                                </div>
                                <div class="flex justify-between border-t border-stone-100 pt-4 text-base text-luxury-900">
                                    <span class="font-medium">Total</span>
                                    <span class="font-serif font-bold text-2xl text-gold-700">${{ number_format($subtotal, 2) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="luxury-btn block text-center w-full bg-luxury-900 hover:bg-gold-700 text-cream-100 font-semibold py-4 text-xs uppercase tracking-wider rounded-md shadow-xs transition-colors">
                                Proceder al Checkout
                            </a>

                            <div class="pt-4 text-center">
                                <p class="text-2xs text-stone-400 leading-relaxed">
                                    🔒 Pagos encriptados de extremo a extremo. <br>
                                    Envíos express en 2 a 4 días hábiles con entrega protegida.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </section>
@endsection

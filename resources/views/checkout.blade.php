@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')
    <section class="py-16 bg-gold-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-luxury-900 mb-10 text-center sm:text-left">Finalizar Compra</h1>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                    
                    <!-- 1. Left Column: Checkout Forms (Shipping & Payment) -->
                    <div class="lg:col-span-8 space-y-8">
                        
                        <!-- Shipping Form Box -->
                        <div class="p-8 bg-white rounded-xl shadow-xs border border-stone-100 space-y-6">
                            <h3 class="font-serif text-xl font-bold text-luxury-900 border-b border-stone-100 pb-4 flex items-center gap-2">
                                <span class="h-6 w-6 rounded-full bg-gold-100 text-gold-700 flex items-center justify-center text-xs font-semibold">1</span>
                                Información de Envío
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="customer_name" class="text-xs font-bold uppercase tracking-wider text-stone-500">Nombre Completo *</label>
                                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required class="w-full px-4 py-3 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500">
                                    @error('customer_name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="customer_email" class="text-xs font-bold uppercase tracking-wider text-stone-500">Correo Electrónico *</label>
                                    <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required class="w-full px-4 py-3 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500">
                                    @error('customer_email') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="customer_phone" class="text-xs font-bold uppercase tracking-wider text-stone-500">Teléfono móvil</label>
                                    <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" class="w-full px-4 py-3 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500">
                                    @error('customer_phone') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="shipping_address" class="text-xs font-bold uppercase tracking-wider text-stone-500">Dirección de Entrega *</label>
                                    <input type="text" id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}" required placeholder="Calle, Número, Depto" class="w-full px-4 py-3 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500">
                                    @error('shipping_address') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="shipping_city" class="text-xs font-bold uppercase tracking-wider text-stone-500">Ciudad / Provincia *</label>
                                    <input type="text" id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}" required class="w-full px-4 py-3 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500">
                                    @error('shipping_city') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="shipping_country" class="text-xs font-bold uppercase tracking-wider text-stone-500">País *</label>
                                    <input type="text" id="shipping_country" name="shipping_country" value="{{ old('shipping_country') }}" required class="w-full px-4 py-3 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500">
                                    @error('shipping_country') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Form Box -->
                        <div class="p-8 bg-white rounded-xl shadow-xs border border-stone-100 space-y-6">
                            <h3 class="font-serif text-xl font-bold text-luxury-900 border-b border-stone-100 pb-4 flex items-center gap-2">
                                <span class="h-6 w-6 rounded-full bg-gold-100 text-gold-700 flex items-center justify-center text-xs font-semibold">2</span>
                                Método de Pago
                            </h3>

                            <div class="space-y-4">
                                
                                <!-- Mock Gateway -->
                                <label class="border border-stone-200 rounded-lg p-5 flex items-start cursor-pointer hover:bg-gold-50/20 transition-colors">
                                    <input type="radio" name="payment_gateway" value="mock" checked class="h-5 w-5 text-gold-600 border-stone-300 focus:ring-gold-500/20 mt-1 mr-4">
                                    <div class="space-y-1">
                                        <h4 class="font-semibold text-sm text-luxury-900 uppercase tracking-wide">Simulación Directa (Recomendado para pruebas)</h4>
                                        <p class="text-xs text-stone-500 leading-relaxed">Completa el pedido instantáneamente simulando un cargo exitoso, sin costos reales y sin requerir llaves en el archivo `.env`.</p>
                                    </div>
                                </label>

                                <!-- Stripe Gateway -->
                                <label class="border border-stone-200 rounded-lg p-5 flex items-start cursor-pointer hover:bg-gold-50/20 transition-colors">
                                    <input type="radio" name="payment_gateway" value="stripe" class="h-5 w-5 text-gold-600 border-stone-300 focus:ring-gold-500/20 mt-1 mr-4">
                                    <div class="space-y-1">
                                        <h4 class="font-semibold text-sm text-luxury-900 uppercase tracking-wide">Tarjeta de Crédito (Vía Stripe)</h4>
                                        <p class="text-xs text-stone-500 leading-relaxed">Procesamiento real con Stripe. Si las llaves `STRIPE_SECRET` en tu archivo `.env` no están configuradas, el sistema cambiará automáticamente a modo simulación para asegurar que el checkout no falle.</p>
                                    </div>
                                </label>

                                <!-- PayPal Gateway -->
                                <label class="border border-stone-200 rounded-lg p-5 flex items-start cursor-pointer hover:bg-gold-50/20 transition-colors">
                                    <input type="radio" name="payment_gateway" value="paypal" class="h-5 w-5 text-gold-600 border-stone-300 focus:ring-gold-500/20 mt-1 mr-4">
                                    <div class="space-y-1">
                                        <h4 class="font-semibold text-sm text-luxury-900 uppercase tracking-wide">PayPal Express Checkout</h4>
                                        <p class="text-xs text-stone-500 leading-relaxed">Procesamiento seguro con PayPal. Funciona con el flujo de credenciales OAuth de tu entorno. Caerá en simulación si no se detecta la configuración en tu archivo `.env`.</p>
                                    </div>
                                </label>

                            </div>
                        </div>

                    </div>

                    <!-- 2. Right Column: Order Summary & Action -->
                    <div class="lg:col-span-4">
                        <div class="p-8 bg-white rounded-xl shadow-xs border border-stone-100 space-y-6 sticky top-24">
                            <h3 class="font-serif text-xl font-bold text-luxury-900 border-b border-stone-100 pb-4">Resumen de Tu Pedido</h3>

                            <div class="max-h-60 overflow-y-auto divide-y divide-stone-100 pr-1">
                                @foreach($cart as $id => $item)
                                    <div class="py-4 flex justify-between items-center text-sm gap-4">
                                        <div class="truncate">
                                            <h4 class="font-semibold text-luxury-900 truncate">{{ $item['name'] }}</h4>
                                            <p class="text-stone-400 text-xs mt-0.5">{{ $item['quantity'] }} x ${{ $item['price'] }}</p>
                                        </div>
                                        <span class="font-serif font-bold text-luxury-900 flex-shrink-0">
                                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="space-y-4 text-sm text-stone-600 border-t border-stone-100 pt-6">
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
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

                            <button type="submit" class="luxury-btn w-full bg-luxury-900 hover:bg-gold-700 text-cream-100 font-semibold py-4 text-xs uppercase tracking-wider rounded-md shadow-xs transition-colors">
                                Completar Pago y Pedido
                            </button>

                            <div class="text-center pt-2">
                                <p class="text-2xs text-stone-400">
                                    Haciendo clic en el botón aceptas nuestros términos de servicio y políticas de entrega.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </section>
@endsection

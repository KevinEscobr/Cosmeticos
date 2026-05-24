@extends('layouts.app')

@section('title', '¡Gracias por tu compra!')

@section('content')
    <section class="py-20 bg-gold-50/20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-md border border-stone-100 p-8 sm:p-12 text-center space-y-8">
                
                <!-- Success Seal -->
                <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-sage-50 border border-sage-200 text-sage-500 shadow-xs mx-auto">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>

                <!-- Core confirmation -->
                <div class="space-y-3">
                    <span class="text-xs uppercase tracking-widest text-sage-600 font-bold bg-sage-50 px-3 py-1.5 rounded-full inline-block">Pedido Recibido con Éxito</span>
                    <h1 class="font-serif text-3xl sm:text-4xl font-bold text-luxury-900">¡Gracias por tu compra, {{ $order->customer_name }}!</h1>
                    <p class="text-stone-500 text-sm max-w-lg mx-auto">
                        Hemos registrado tu pedido correctamente. Se ha enviado un correo electrónico de confirmación a <strong class="text-luxury-900 font-semibold">{{ $order->customer_email }}</strong> con tu factura y el enlace de rastreo.
                    </p>
                </div>

                <!-- Order specifics details grid -->
                <div class="border-y border-stone-100 py-6 grid grid-cols-2 sm:grid-cols-4 gap-6 text-left">
                    <div>
                        <span class="text-2xs text-stone-400 font-bold uppercase tracking-wider">Número de Pedido</span>
                        <p class="font-semibold text-sm text-luxury-900 mt-1">#AURA-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <span class="text-2xs text-stone-400 font-bold uppercase tracking-wider">Fecha</span>
                        <p class="font-semibold text-sm text-luxury-900 mt-1">{{ $order->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <span class="text-2xs text-stone-400 font-bold uppercase tracking-wider">Total</span>
                        <p class="font-semibold text-sm text-gold-700 mt-1">${{ number_format($order->total, 2) }}</p>
                    </div>
                    <div>
                        <span class="text-2xs text-stone-400 font-bold uppercase tracking-wider">Método de Pago</span>
                        <p class="font-semibold text-sm text-luxury-900 mt-1 uppercase">{{ $order->payment_gateway }}</p>
                    </div>
                </div>

                <!-- Shipping Summary Box -->
                <div class="text-left bg-gold-50/50 p-6 rounded-xl border border-stone-100 space-y-3">
                    <h3 class="font-serif text-base font-bold text-luxury-900">Resumen de Envío</h3>
                    <div class="text-sm text-stone-600 space-y-1">
                        <p><strong class="font-medium text-luxury-900">Destinatario:</strong> {{ $order->customer_name }}</p>
                        @if($order->customer_phone)
                            <p><strong class="font-medium text-luxury-900">Teléfono:</strong> {{ $order->customer_phone }}</p>
                        @endif
                        <p><strong class="font-medium text-luxury-900">Dirección:</strong> {{ $order->shipping_address }}</p>
                        <p><strong class="font-medium text-luxury-900">Ciudad/País:</strong> {{ $order->shipping_city }}, {{ $order->shipping_country }}</p>
                    </div>
                </div>

                <!-- Transaction Reference -->
                @if($order->payment_id)
                    <div class="text-center bg-stone-50 py-3 px-4 rounded-md border border-stone-100">
                        <span class="text-2xs text-stone-400 font-semibold tracking-wider block">ID DE TRANSACCIÓN PASARELA</span>
                        <code class="text-xs text-stone-600 font-mono select-all">{{ $order->payment_id }}</code>
                    </div>
                @endif

                <!-- Items Bought Box -->
                <div class="text-left space-y-4">
                    <h3 class="font-serif text-lg font-bold text-luxury-900">Detalle de Artículos</h3>
                    <div class="divide-y divide-stone-100 border border-stone-100 rounded-xl overflow-hidden bg-white">
                        @foreach($order->items as $item)
                            <div class="p-4 flex justify-between items-center text-sm gap-4">
                                <div>
                                    <h4 class="font-semibold text-luxury-900">{{ $item->product->name }}</h4>
                                    <p class="text-stone-400 text-xs mt-0.5">{{ $item->quantity }} x ${{ $item->price }}</p>
                                </div>
                                <span class="font-serif font-bold text-luxury-900">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action CTA -->
                <div class="pt-6">
                    <a href="{{ route('home') }}" class="luxury-btn bg-luxury-900 hover:bg-gold-700 text-cream-100 font-semibold px-8 py-3.5 text-xs uppercase tracking-wider rounded-md transition-colors shadow-xs">
                        Volver a la Página Principal
                    </a>
                </div>

            </div>
        </div>
    </section>
@endsection

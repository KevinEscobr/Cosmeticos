@extends('layouts.app')

@section('title', 'Gestión de Pedidos')

@section('content')
    <section class="py-12 bg-gold-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="flex items-center justify-between border-b border-stone-200 pb-6">
                <div>
                    <h1 class="font-serif text-3xl font-bold text-luxury-900">Listado de Pedidos</h1>
                    <p class="text-stone-500 text-sm mt-1">Historial de compras realizadas por los clientes.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="font-semibold text-xs tracking-wider uppercase text-stone-600 hover:text-gold-700 flex items-center gap-1 group">
                    <svg class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Volver al Dashboard
                </a>
            </div>

            <!-- Orders Table Card -->
            <div class="bg-white rounded-xl shadow-xs border border-stone-100 overflow-hidden">
                @if($orders->isEmpty())
                    <div class="p-16 text-center text-stone-400 text-sm space-y-4">
                        <span class="text-4xl block">📦</span>
                        <h3 class="font-bold text-stone-600">No hay pedidos registrados</h3>
                        <p class="text-xs">Los pedidos de tus clientes aparecerán aquí una vez completen el checkout.</p>
                    </div>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-cream-100/50 border-b border-cream-200/60 text-stone-500 text-3xs font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">Pedido</th>
                                <th class="py-4 px-6">Cliente & Envío</th>
                                <th class="py-4 px-6">Total</th>
                                <th class="py-4 px-6">Pasarela</th>
                                <th class="py-4 px-6">Referencia</th>
                                <th class="py-4 px-6 text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100 text-xs">
                            @foreach($orders as $order)
                                <tr>
                                    <!-- ID and Date -->
                                    <td class="py-5 px-6">
                                        <div class="font-bold text-stone-700">#AURA-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-3xs text-stone-400 mt-1">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                                    </td>

                                    <!-- Customer Details & Shipping address -->
                                    <td class="py-5 px-6 space-y-1">
                                        <div class="font-semibold text-luxury-900">{{ $order->customer_name }}</div>
                                        <div class="text-3xs text-stone-400">{{ $order->customer_email }}</div>
                                        <div class="text-3xs text-stone-500 leading-normal max-w-xs truncate" title="{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_country }}">
                                            📍 {{ $order->shipping_address }}, {{ $order->shipping_city }}
                                        </div>
                                    </td>

                                    <!-- Total Amount -->
                                    <td class="py-5 px-6 font-serif font-bold text-sm text-gold-700">
                                        ${{ number_format($order->total, 2) }}
                                    </td>

                                    <!-- Gateway -->
                                    <td class="py-5 px-6 font-semibold uppercase text-3xs text-stone-500">
                                        {{ $order->payment_gateway }}
                                    </td>

                                    <!-- Gateway Payment ID -->
                                    <td class="py-5 px-6 font-mono text-3xs text-stone-500 select-all">
                                        {{ $order->payment_id ?? 'N/A' }}
                                    </td>

                                    <!-- Status -->
                                    <td class="py-5 px-6 text-center">
                                        <span class="inline-block px-2.5 py-1 text-3xs font-bold uppercase tracking-wider rounded-full {{ $order->status === 'paid' ? 'bg-sage-50 text-sage-600 border border-sage-200' : 'bg-rose-50 text-rose-600 border border-rose-200' }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($orders->hasPages())
                        <div class="p-6 border-t border-stone-100 bg-stone-50/50">
                            {{ $orders->links() }}
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </section>
@endsection

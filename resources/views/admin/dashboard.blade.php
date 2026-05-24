@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <section class="py-12 bg-gold-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Dashboard Title Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-stone-200 pb-8 mb-10 gap-4">
                <div class="space-y-1">
                    <h1 class="font-serif text-3xl font-bold text-luxury-900">Dashboard Administrativo</h1>
                    <p class="text-stone-500 text-sm">Monitoreo de ingresos, órdenes y disponibilidad del inventario AURA.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs uppercase tracking-widest text-sage-600 font-bold bg-sage-50 border border-sage-200 px-3 py-1.5 rounded-full inline-block">
                        ● Servidor Activo (Docker)
                    </span>
                </div>
            </div>

            <!-- Analytics Key Metrics Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                
                <!-- Metric 1: Total Sales -->
                <div class="p-6 bg-white rounded-xl shadow-xs border border-stone-100 flex flex-col justify-between h-36">
                    <div class="flex justify-between items-center text-stone-400">
                        <span class="text-2xs font-bold uppercase tracking-wider">Ingresos Totales</span>
                        <svg class="h-6 w-6 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-serif text-3xl font-bold text-gold-700">${{ number_format($totalSales, 2) }}</h2>
                        <p class="text-3xs text-stone-400 mt-1">Acumulado ventas pagadas</p>
                    </div>
                </div>

                <!-- Metric 2: Orders Count -->
                <div class="p-6 bg-white rounded-xl shadow-xs border border-stone-100 flex flex-col justify-between h-36">
                    <div class="flex justify-between items-center text-stone-400">
                        <span class="text-2xs font-bold uppercase tracking-wider">Pedidos Registrados</span>
                        <svg class="h-6 w-6 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-serif text-3xl font-bold text-luxury-900">{{ $totalOrders }}</h2>
                        <p class="text-3xs text-stone-400 mt-1">Pedidos históricos totales</p>
                    </div>
                </div>

                <!-- Metric 3: Average Ticket -->
                <div class="p-6 bg-white rounded-xl shadow-xs border border-stone-100 flex flex-col justify-between h-36">
                    <div class="flex justify-between items-center text-stone-400">
                        <span class="text-2xs font-bold uppercase tracking-wider">Ticket Promedio</span>
                        <svg class="h-6 w-6 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-serif text-3xl font-bold text-luxury-900">${{ number_format($averageTicket, 2) }}</h2>
                        <p class="text-3xs text-stone-400 mt-1">Valor medio por pedido pagado</p>
                    </div>
                </div>

                <!-- Metric 4: Shortages -->
                <div class="p-6 bg-white rounded-xl shadow-xs border border-stone-100 flex flex-col justify-between h-36">
                    <div class="flex justify-between items-center text-stone-400">
                        <span class="text-2xs font-bold uppercase tracking-wider">Bajo Stock</span>
                        <svg class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-serif text-3xl font-bold {{ $lowStockProducts > 0 ? 'text-rose-600' : 'text-luxury-900' }}">{{ $lowStockProducts }}</h2>
                        <p class="text-3xs text-stone-400 mt-1">Productos con menos de 10 unidades</p>
                    </div>
                </div>

            </div>

            <!-- Detailed Tables Block -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Recent Orders Table (Left column) -->
                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white rounded-xl shadow-xs border border-stone-100 overflow-hidden">
                        <div class="p-6 border-b border-stone-100 flex justify-between items-center bg-cream-50/50">
                            <h3 class="font-serif text-lg font-bold text-luxury-900">Pedidos Recientes</h3>
                            <span class="text-2xs text-stone-400 font-bold uppercase tracking-wider">Últimas transacciones</span>
                        </div>
                        
                        @if($recentOrders->isEmpty())
                            <div class="p-12 text-center text-stone-400 text-sm">
                                No hay pedidos registrados en el sistema.
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-stone-50 border-b border-stone-100 text-stone-400 text-3xs font-bold uppercase tracking-wider">
                                            <th class="py-3 px-6">ID Orden</th>
                                            <th class="py-3 px-6">Cliente</th>
                                            <th class="py-3 px-6">Total</th>
                                            <th class="py-3 px-6">Método</th>
                                            <th class="py-3 px-6 text-center">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-stone-50 text-xs">
                                        @foreach($recentOrders as $order)
                                            <tr>
                                                <td class="py-4 px-6 font-semibold text-stone-600">#AURA-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                                <td class="py-4 px-6">
                                                    <div class="font-semibold text-luxury-900">{{ $order->customer_name }}</div>
                                                    <div class="text-3xs text-stone-400 mt-0.5">{{ $order->customer_email }}</div>
                                                </td>
                                                <td class="py-4 px-6 font-semibold text-stone-800">${{ $order->total }}</td>
                                                <td class="py-4 px-6 uppercase text-3xs font-semibold text-stone-500">{{ $order->payment_gateway }}</td>
                                                <td class="py-4 px-6 text-center">
                                                    <span class="inline-block px-2.5 py-1 text-3xs font-bold uppercase tracking-wider rounded-full {{ $order->status === 'paid' ? 'bg-sage-50 text-sage-600 border border-sage-200' : 'bg-rose-50 text-rose-600 border border-rose-200' }}">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Products Availability Panel (Right column) -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-xl shadow-xs border border-stone-100 overflow-hidden">
                        <div class="p-6 border-b border-stone-100 flex justify-between items-center bg-cream-50/50">
                            <h3 class="font-serif text-lg font-bold text-luxury-900">Productos</h3>
                            <span class="text-2xs text-stone-400 font-bold uppercase tracking-wider">Inventario actual</span>
                        </div>
                        
                        <div class="p-6 pr-4 divide-y divide-stone-100 overflow-y-auto max-h-96">
                            @foreach($products as $prod)
                                <div class="py-4 first:pt-0 last:pb-0 flex justify-between items-center text-xs gap-4">
                                    <div class="truncate">
                                        <h4 class="font-semibold text-luxury-900 truncate">{{ $prod->name }}</h4>
                                        <p class="text-stone-400 text-3xs mt-0.5 truncate">{{ $prod->category->name }} | Stock: <strong class="{{ $prod->stock < 10 ? 'text-rose-600 font-bold' : 'text-stone-600' }}">{{ $prod->stock }}</strong></p>
                                    </div>
                                    <span class="font-serif font-bold text-gold-700 flex-shrink-0">
                                        ${{ $prod->price }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

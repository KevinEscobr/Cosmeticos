@extends('layouts.app')

@section('title', 'Gestión de Productos')

@section('content')
    <section class="py-12 bg-gold-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="flex items-center justify-between border-b border-stone-200 pb-6">
                <div>
                    <h1 class="font-serif text-3xl font-bold text-luxury-900">Listado de Inventario</h1>
                    <p class="text-stone-500 text-sm mt-1">Control de catálogo, precios y niveles de stock de productos AURA.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="font-semibold text-xs tracking-wider uppercase text-stone-600 hover:text-gold-700 flex items-center gap-1 group">
                    <svg class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Volver al Dashboard
                </a>
            </div>

            <!-- Products Table Card -->
            <div class="bg-white rounded-xl shadow-xs border border-stone-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-cream-100/50 border-b border-cream-200/60 text-stone-500 text-3xs font-bold uppercase tracking-wider">
                            <th class="py-4 px-6">Producto</th>
                            <th class="py-4 px-6">Categoría</th>
                            <th class="py-4 px-6">Tipo de Piel</th>
                            <th class="py-4 px-6">Precio</th>
                            <th class="py-4 px-6 text-center">Stock Disponible</th>
                            <th class="py-4 px-6 text-center">Destacado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-xs">
                        @foreach($products as $prod)
                            <tr>
                                <!-- Product details -->
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-stone-50 h-10 w-10 rounded-sm flex items-center justify-center flex-shrink-0">
                                            <span class="text-lg text-gold-500/30">🌿</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-luxury-900 text-sm">
                                                <a href="{{ route('catalog.show', $prod->slug) }}" class="hover:text-gold-600 transition-colors">{{ $prod->name }}</a>
                                            </h4>
                                            <p class="text-3xs text-stone-400 mt-0.5 truncate max-w-xs">{{ $prod->description }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="py-5 px-6">
                                    <span class="inline-block px-2.5 py-0.5 text-3xs font-semibold uppercase tracking-wider rounded-full bg-gold-100 text-gold-700">
                                        {{ $prod->category->name }}
                                    </span>
                                </td>

                                <!-- Skin Type -->
                                <td class="py-5 px-6 text-stone-600 font-medium">
                                    {{ $prod->skin_type }}
                                </td>

                                <!-- Price -->
                                <td class="py-5 px-6 font-serif font-bold text-sm text-gold-700">
                                    ${{ $prod->price }}
                                </td>

                                <!-- Stock status -->
                                <td class="py-5 px-6 text-center font-semibold">
                                    <span class="inline-block px-2.5 py-1 rounded-sm text-3xs uppercase tracking-wider {{ $prod->stock < 10 ? 'bg-rose-50 text-rose-600 font-bold border border-rose-100' : 'bg-sage-50 text-sage-600 border border-sage-100' }}">
                                        {{ $prod->stock }} unidades
                                    </span>
                                </td>

                                <!-- Featured Status -->
                                <td class="py-5 px-6 text-center">
                                    @if($prod->is_featured)
                                        <span class="text-emerald-500 text-sm" title="Producto Destacado en Inicio">★ Destacado</span>
                                    @else
                                        <span class="text-stone-300 text-sm">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="p-6 border-t border-stone-100 bg-stone-50/50">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

        </div>
    </section>
@endsection

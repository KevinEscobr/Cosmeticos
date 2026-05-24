@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <!-- Breadcrumbs -->
    <nav class="bg-gold-50 py-4 border-b border-cream-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm text-stone-500 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-gold-700 transition-colors">Inicio</a>
            <span>/</span>
            <a href="{{ route('catalog.index') }}" class="hover:text-gold-700 transition-colors">Catálogo</a>
            <span>/</span>
            <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}" class="hover:text-gold-700 transition-colors">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="text-luxury-900 font-medium truncate">{{ $product->name }}</span>
        </div>
    </nav>

    <!-- Product Showcase -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                
                <!-- 1. Left Column: Product Image Gallery Mock -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="bg-stone-50 aspect-square rounded-2xl border border-stone-100 flex items-center justify-center p-12 relative shadow-xs">
                        <span class="absolute top-4 left-4 bg-rose-100 text-rose-700 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                            100% Orgánico
                        </span>
                        <span class="text-9xl text-gold-500/20">🌸</span>
                    </div>
                </div>

                <!-- 2. Right Column: Product Core Details & Add To Cart -->
                <div class="lg:col-span-6 space-y-8">
                    <div class="space-y-4">
                        <span class="text-xs uppercase tracking-widest text-gold-600 font-bold bg-gold-50 px-3 py-1.5 rounded-full inline-block">
                            {{ $product->category->name }}
                        </span>
                        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-luxury-900">
                            {{ $product->name }}
                        </h1>
                        
                        <!-- Core attributes & Price -->
                        <div class="flex items-center gap-6 pt-2">
                            <span class="font-serif text-3xl font-bold text-gold-700">${{ $product->price }}</span>
                            <span class="text-xs text-stone-400">|</span>
                            <span class="text-xs text-stone-500 bg-stone-100 px-3 py-1 rounded-full font-medium">
                                Piel: <strong class="text-luxury-900 font-semibold">{{ $product->skin_type }}</strong>
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="border-t border-stone-100 pt-6">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-stone-500 mb-2.5">Descripción</h4>
                        <p class="text-stone-600 text-sm leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Ingredients -->
                    @if($product->ingredients)
                        <div class="border-t border-stone-100 pt-6">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-500 mb-2.5">Ingredientes Activos</h4>
                            <p class="text-stone-600 italic text-sm leading-relaxed bg-cream-50 p-4 rounded-lg border border-cream-200">
                                {{ $product->ingredients }}
                            </p>
                        </div>
                    @endif

                    <!-- Stock Status & Add to Cart form -->
                    <div class="border-t border-stone-100 pt-6 space-y-6">
                        <div class="flex items-center gap-3">
                            <span class="h-2.5 w-2.5 rounded-full {{ $product->stock > 0 ? 'bg-sage-500' : 'bg-rose-500' }}"></span>
                            <span class="text-xs font-semibold text-stone-500">
                                @if($product->stock > 0)
                                    Disponible ({{ $product->stock }} unidades en stock)
                                @else
                                    Agotado Temporalmente
                                @endif
                            </span>
                        </div>

                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex flex-col sm:flex-row items-center gap-4">
                                @csrf
                                
                                <!-- Quantity Selector -->
                                <div class="flex items-center border border-stone-200 rounded-md bg-stone-50 h-14 w-full sm:w-32 justify-between px-3">
                                    <button type="button" onclick="let q = document.getElementById('qty'); if(q.value > 1) q.value--;" class="text-stone-500 hover:text-luxury-900 font-bold p-1 text-lg">-</button>
                                    <input type="number" id="qty" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-12 text-center bg-transparent border-0 focus:ring-0 text-sm font-semibold focus:outline-hidden" readonly>
                                    <button type="button" onclick="let q = document.getElementById('qty'); if(q.value < {{ $product->stock }}) q.value++;" class="text-stone-500 hover:text-luxury-900 font-bold p-1 text-lg">+</button>
                                </div>

                                <!-- Add button -->
                                <button type="submit" class="luxury-btn bg-luxury-900 hover:bg-gold-700 text-cream-100 font-semibold uppercase tracking-wider text-sm h-14 w-full flex-grow flex items-center justify-center gap-2 rounded-md shadow-xs">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    Añadir al Carrito
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if(!$relatedProducts->isEmpty())
        <section class="py-20 bg-gold-50/50 border-t border-stone-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="font-serif text-2xl font-bold text-luxury-900 mb-10 text-center">Te puede interesar también</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $related)
                        <div class="product-card bg-white rounded-xl shadow-xs border border-stone-100 overflow-hidden flex flex-col justify-between">
                            <div>
                                <div class="bg-stone-50 aspect-square flex items-center justify-center p-6 relative">
                                    <span class="text-4xl text-gold-500/20">🌿</span>
                                </div>
                                <div class="p-6 space-y-2">
                                    <span class="text-2xs text-stone-400 font-bold uppercase tracking-wider">
                                        Piel: {{ $related->skin_type }}
                                    </span>
                                    <h3 class="font-serif text-md font-bold text-luxury-900 truncate">
                                        <a href="{{ route('catalog.show', $related->slug) }}" class="hover:text-gold-600 transition-colors">
                                            {{ $related->name }}
                                        </a>
                                    </h3>
                                    <p class="text-stone-500 text-xs line-clamp-1">
                                        {{ $related->description }}
                                    </p>
                                </div>
                            </div>
                            <div class="px-6 pb-6 pt-2 flex items-center justify-between border-t border-stone-50 bg-cream-50/50">
                                <span class="font-serif text-lg font-bold text-gold-700">${{ $related->price }}</span>
                                <a href="{{ route('catalog.show', $related->slug) }}" class="luxury-btn bg-luxury-900 text-cream-100 hover:bg-gold-700 text-2xs font-semibold uppercase tracking-widest px-3 py-2 rounded-sm transition-colors">
                                    Ver
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

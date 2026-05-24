@extends('layouts.app')

@section('title', 'Catálogo de Cosméticos')

@section('content')
    <!-- Catalog Header -->
    <section class="bg-cream-100 border-b border-cream-200 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
            <h1 class="font-serif text-4xl font-bold tracking-tight text-luxury-900">Catálogo de Productos</h1>
            <p class="text-stone-500 text-sm max-w-2xl mx-auto">
                Explora nuestra selecta línea de tratamientos botánicos elaborados con ingredientes de origen biológico natural y cosechas sustentables.
            </p>
        </div>
    </section>

    <!-- Catalog Main Area -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                
                <!-- 1. Left Sidebar - Filters Form -->
                <aside class="lg:col-span-1 space-y-8">
                    <div class="p-6 bg-gold-50/50 rounded-xl border border-stone-100 shadow-2xs">
                        <h3 class="font-serif text-lg font-bold text-luxury-900 mb-6 flex items-center gap-2">
                            <svg class="h-5 w-5 text-gold-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                            Filtrar Catálogo
                        </h3>

                        <form action="{{ route('catalog.index') }}" method="GET" class="space-y-6">
                            
                            <!-- Search -->
                            <div class="space-y-2">
                                <label for="search" class="text-xs font-bold uppercase tracking-wider text-stone-500">Buscar</label>
                                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Ingrediente, nombre..." class="w-full px-4 py-3 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20">
                            </div>

                            <!-- Categories -->
                            <div class="space-y-2">
                                <span class="text-xs font-bold uppercase tracking-wider text-stone-500">Categoría</span>
                                <div class="space-y-2.5 pt-2">
                                    <label class="flex items-center text-sm text-stone-600 cursor-pointer">
                                        <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} class="h-4 w-4 text-gold-600 border-stone-300 focus:ring-gold-500/20 mr-2.5">
                                        Todos los productos
                                    </label>
                                    @foreach($categories as $cat)
                                        <label class="flex items-center text-sm text-stone-600 cursor-pointer">
                                            <input type="radio" name="category" value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'checked' : '' }} class="h-4 w-4 text-gold-600 border-stone-300 focus:ring-gold-500/20 mr-2.5">
                                            {{ $cat->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Skin Type Filter -->
                            <div class="space-y-2">
                                <label for="skin_type" class="text-xs font-bold uppercase tracking-wider text-stone-500">Tipo de Piel</label>
                                <select id="skin_type" name="skin_type" class="w-full px-4 py-3 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500">
                                    <option value="">Cualquier tipo de piel</option>
                                    @foreach($skinTypes as $st)
                                        <option value="{{ $st }}" {{ request('skin_type') === $st ? 'selected' : '' }}>{{ $st }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div class="space-y-2">
                                <span class="text-xs font-bold uppercase tracking-wider text-stone-500">Rango de Precio</span>
                                <div class="flex items-center gap-2 pt-2">
                                    <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-full px-3 py-2 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500">
                                    <span class="text-stone-400 text-xs">-</span>
                                    <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-full px-3 py-2 bg-white border border-stone-200 text-sm rounded-md focus:outline-hidden focus:border-gold-500">
                                </div>
                            </div>

                            <!-- Sort Preserved -->
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif

                            <!-- Action Buttons -->
                            <div class="pt-4 space-y-3">
                                <button type="submit" class="w-full bg-luxury-900 hover:bg-gold-700 text-cream-100 font-semibold py-3 text-xs uppercase tracking-wider rounded-md transition-colors shadow-sm">
                                    Aplicar Filtros
                                </button>
                                <a href="{{ route('catalog.index') }}" class="block text-center w-full bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold py-3 text-xs uppercase tracking-wider rounded-md transition-colors">
                                    Limpiar
                                </a>
                            </div>

                        </form>
                    </div>
                </aside>

                <!-- 2. Right Side - Products Grid -->
                <main class="lg:col-span-3 space-y-8">
                    
                    <!-- Sorting & Results Summary header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-stone-100 pb-4 gap-4">
                        <div class="text-sm text-stone-500">
                            Mostrando <span class="font-semibold text-luxury-900">{{ $products->firstItem() ?? 0 }}</span> - <span class="font-semibold text-luxury-900">{{ $products->lastItem() ?? 0 }}</span> de <span class="font-semibold text-luxury-900">{{ $products->total() }}</span> productos
                        </div>
                        
                        <!-- Sort Selector -->
                        <div class="flex items-center gap-2">
                            <label for="sort-select" class="text-xs text-stone-400 font-semibold uppercase tracking-wider">Ordenar por:</label>
                            <select id="sort-select" onchange="location = this.value;" class="px-3 py-2 border border-stone-200 text-xs rounded-md focus:outline-hidden focus:border-gold-500 bg-white">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'default']) }}" {{ request('sort') === 'default' || !request('sort') ? 'selected' : '' }}>Destacados</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') === 'newest' ? 'selected' : '' }}>Más Nuevos</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Precio: Bajo a Alto</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Precio: Alto a Bajo</option>
                            </select>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    @if($products->isEmpty())
                        <div class="text-center py-20 bg-gold-50/20 border border-dashed border-stone-200 rounded-xl space-y-4">
                            <span class="text-4xl">🍃</span>
                            <h3 class="font-serif text-xl font-bold text-stone-700">No encontramos productos</h3>
                            <p class="text-stone-500 text-sm max-w-sm mx-auto">Intenta modificando tus filtros o cambiando tu búsqueda de ingredientes.</p>
                            <a href="{{ route('catalog.index') }}" class="inline-block bg-luxury-900 text-cream-100 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider rounded-md">
                                Reestablecer Catálogo
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($products as $product)
                                <div class="product-card bg-white rounded-xl shadow-xs border border-stone-100 overflow-hidden flex flex-col justify-between">
                                    <div>
                                        <!-- Mock Image with Leaf -->
                                        <div class="bg-stone-50 aspect-square flex items-center justify-center p-6 relative">
                                            <span class="absolute top-3 left-3 bg-gold-100 text-gold-700 text-2xs font-semibold px-2 py-1 rounded-sm uppercase tracking-wider">
                                                {{ $product->category->name }}
                                            </span>
                                            <span class="text-5xl text-gold-500/20">🌱</span>
                                        </div>
                                        <div class="p-6 space-y-2">
                                            <span class="text-2xs text-stone-400 font-bold uppercase tracking-wider">
                                                Piel: {{ $product->skin_type }}
                                            </span>
                                            <h3 class="font-serif text-lg font-bold text-luxury-900 truncate">
                                                <a href="{{ route('catalog.show', $product->slug) }}" class="hover:text-gold-600 transition-colors">
                                                    {{ $product->name }}
                                                </a>
                                            </h3>
                                            <p class="text-stone-500 text-xs line-clamp-2">
                                                {{ $product->description }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="px-6 pb-6 pt-2 flex items-center justify-between border-t border-stone-50 bg-cream-50/50">
                                        <span class="font-serif text-xl font-bold text-gold-700">${{ $product->price }}</span>
                                        <a href="{{ route('catalog.show', $product->slug) }}" class="luxury-btn bg-luxury-900 text-cream-100 hover:bg-gold-700 text-xs font-semibold uppercase tracking-widest px-4 py-2.5 rounded-sm transition-colors">
                                            Detalle
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Laravel Standard Pagination -->
                        <div class="pt-10">
                            {{ $products->links() }}
                        </div>
                    @endif

                </main>

            </div>
        </div>
    </section>
@endsection

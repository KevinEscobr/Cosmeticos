@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <!-- Luxury Hero Section -->
    <section class="relative bg-cream-100 overflow-hidden py-24 sm:py-32">
        <div class="absolute inset-0 opacity-10 bg-radial-gradient"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Text Content -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <span class="text-xs uppercase tracking-widest text-gold-600 font-semibold bg-gold-100 px-3 py-1.5 rounded-full">
                        Cosmética Botánica Consciente
                    </span>
                    <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight text-luxury-900 leading-tight">
                        Nutre tu piel con <br>
                        <span class="text-gold-600 italic">pureza orgánica</span>
                    </h1>
                    <p class="text-stone-600 text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Descubre fórmulas exclusivas creadas con ingredientes 100% de origen vegetal, aceites esenciales puros y arcillas ricas en minerales. Sin parabenos, sin crueldad animal, hechas a mano con amor y consciencia.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                        <a href="{{ route('catalog.index') }}" class="luxury-btn bg-luxury-900 text-cream-100 hover:bg-gold-700 px-8 py-4 text-sm font-semibold tracking-wider uppercase rounded-md shadow-md transition-colors text-center">
                            Explorar Catálogo
                        </a>
                        <a href="#filosofia" class="border border-stone-300 hover:border-gold-500 text-stone-700 hover:text-gold-700 px-8 py-4 text-sm font-semibold tracking-wider uppercase rounded-md transition-all text-center">
                            Nuestra Filosofía
                        </a>
                    </div>
                </div>

                <!-- Featured Mockup Box (Glassmorphism card) -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="glassmorphism p-8 rounded-2xl shadow-xl max-w-sm w-full border border-white text-center space-y-6 relative overflow-hidden">
                        <div class="absolute -top-12 -left-12 w-32 h-32 bg-rose-200 rounded-full blur-2xl opacity-50"></div>
                        <div class="absolute -bottom-12 -right-12 w-32 h-32 bg-sage-200 rounded-full blur-2xl opacity-50"></div>
                        
                        <div class="relative">
                            <span class="text-xs font-semibold text-rose-500 bg-rose-100 px-2.5 py-1 rounded-full uppercase tracking-wider">Favorito del Mes</span>
                            <h3 class="font-serif text-2xl font-bold text-luxury-900 mt-4">Sérum Vitamina C</h3>
                            <p class="text-xs text-stone-500 mt-1">Sérum Iluminador & Antioxidante</p>
                            <div class="my-6">
                                <span class="font-serif text-4xl font-bold text-gold-700">$42.00</span>
                            </div>
                            <p class="text-sm text-stone-600 leading-relaxed">
                                "Mi rostro luce más iluminado y uniforme en solo una semana. Un elíxir imprescindible."
                            </p>
                            <div class="flex justify-center mt-3 text-gold-500">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <a href="{{ route('catalog.show', 'serum-vitamina-c') }}" class="block w-full mt-6 bg-gold-500 hover:bg-gold-600 text-luxury-900 font-semibold py-3 text-sm rounded-md transition-colors uppercase tracking-wider">
                                Ver Detalle
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Categories Grid Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <h2 class="font-serif text-4xl font-bold tracking-tight text-luxury-900">
                    Rituales por Categoría
                </h2>
                <div class="w-12 h-1 bg-gold-500 mx-auto"></div>
                <p class="text-stone-500 leading-relaxed">
                    Cada paso de tu rutina diaria importa. Encuentra el cuidado perfecto formulado especialmente para las necesidades de tu tipo de piel.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($categories as $category)
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="group relative block overflow-hidden rounded-xl shadow-xs border border-stone-100 hover:shadow-md transition-all duration-300">
                        <div class="aspect-square bg-gold-50 flex items-center justify-center p-8 transition-transform group-hover:scale-105 duration-500">
                            <!-- Category Illustration Placeholder Icons -->
                            @if($category->slug === 'cuidado-facial')
                                <svg class="w-20 h-20 text-gold-500/80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            @elseif($category->slug === 'cuidado-corporal')
                                <svg class="w-20 h-20 text-gold-500/80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                            @elseif($category->slug === 'jabones-artesanales')
                                <svg class="w-20 h-20 text-gold-500/80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                            @else
                                <svg class="w-20 h-20 text-gold-500/80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                            @endif
                        </div>
                        <div class="p-6 bg-cream-50 text-center border-t border-stone-100">
                            <h3 class="font-serif text-lg font-bold text-luxury-900 group-hover:text-gold-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-xs text-stone-500 mt-2 line-clamp-2">
                                {{ $category->description }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-20 bg-gold-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div class="space-y-2 text-center md:text-left">
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold text-luxury-900">Nuestra Colección Destacada</h2>
                    <p class="text-stone-500 text-sm">Fórmulas galardonadas adoradas por nuestra comunidad.</p>
                </div>
                <a href="{{ route('catalog.index') }}" class="mt-4 md:mt-0 font-semibold text-sm text-gold-700 hover:text-gold-800 tracking-wider uppercase flex items-center gap-1 group">
                    Ver Todo el Catálogo
                    <svg class="h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                    <div class="product-card bg-white rounded-xl shadow-xs border border-stone-100 overflow-hidden flex flex-col justify-between">
                        <div>
                            <!-- Mock Product Image -->
                            <div class="bg-stone-50 aspect-square flex items-center justify-center p-6 relative">
                                <span class="absolute top-3 left-3 bg-gold-100 text-gold-700 text-2xs font-semibold px-2 py-1 rounded-sm uppercase tracking-wider">
                                    {{ $product->category->name }}
                                </span>
                                <span class="text-4xl text-gold-500/30">🌿</span>
                            </div>
                            <div class="p-6 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-2xs text-stone-400 font-semibold uppercase tracking-wider">
                                        Recomendado: {{ $product->skin_type }}
                                    </span>
                                </div>
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
        </div>
    </section>

    <!-- Brand Philosophy Section -->
    <section id="filosofia" class="py-24 bg-luxury-900 text-cream-100 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <!-- Graphic/Visual Element -->
                <div class="flex justify-center relative">
                    <div class="border border-gold-500/20 p-6 rounded-2xl w-full max-w-md relative">
                        <div class="absolute -top-6 -left-6 w-12 h-12 border-t-2 border-l-2 border-gold-500"></div>
                        <div class="absolute -bottom-6 -right-6 w-12 h-12 border-b-2 border-r-2 border-gold-500"></div>
                        <div class="glassmorphism-dark p-8 rounded-xl space-y-6 text-center">
                            <span class="text-3xl">🌸</span>
                            <h3 class="font-serif text-2xl font-semibold tracking-wider text-gold-500">Formulación Consciente</h3>
                            <p class="text-stone-300 text-sm leading-relaxed">
                                Excluimos de nuestro catálogo más de 1,500 ingredientes sintéticos comunes. Creemos en una belleza libre de tóxicos que nutre las capas biológicas naturales de tu rostro de forma sostenible.
                            </p>
                            <div class="flex justify-center space-x-6 pt-4">
                                <span class="text-xs tracking-wider uppercase text-gold-200">Bio-Ingredientes</span>
                                <span class="text-stone-500">•</span>
                                <span class="text-xs tracking-wider uppercase text-gold-200">Cruelty Free</span>
                                <span class="text-stone-500">•</span>
                                <span class="text-xs tracking-wider uppercase text-gold-200">Vegano</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Text Content -->
                <div class="space-y-8">
                    <span class="text-xs uppercase tracking-widest text-gold-500 font-semibold">El Compromiso AURA</span>
                    <h2 class="font-serif text-4xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                        Belleza limpia, resultados <span class="text-gold-500 italic">extraordinarios</span>
                    </h2>
                    <p class="text-stone-300 text-base leading-relaxed">
                        Nuestro compromiso va más allá del cuidado estético. Elaboramos cada crema, jabón y aceite mediante métodos tradicionales que retienen las vitaminas y ácidos grasos activos presentes en la naturaleza. Mapeamos productores locales en cooperativas éticas para asegurar el bienestar ambiental.
                    </p>
                    <div class="grid grid-cols-2 gap-8 pt-4">
                        <div class="space-y-2">
                            <h4 class="font-serif text-3xl font-bold text-gold-500">100%</h4>
                            <p class="text-xs text-stone-400 uppercase tracking-wider">Ingredientes Botánicos</p>
                        </div>
                        <div class="space-y-2">
                            <h4 class="font-serif text-3xl font-bold text-gold-500">0%</h4>
                            <p class="text-xs text-stone-400 uppercase tracking-wider">Fragancias Sintéticas</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Testimonials (Aesthetic Quotes) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-serif text-3xl font-bold text-luxury-900 mb-12">La Comunidad AURA Habla</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-xl bg-gold-50 border border-stone-100 flex flex-col justify-between">
                    <p class="italic text-stone-600 text-sm leading-relaxed">
                        "El jabón de avena y lavanda es mágico. Mi piel sensible, propensa a rojeces y eczema, ahora está perfectamente calmada y tersa."
                    </p>
                    <div class="mt-6">
                        <h4 class="font-bold text-xs text-luxury-900">Valentina M.</h4>
                        <span class="text-2xs text-stone-400 font-semibold tracking-wider">Piel Sensible</span>
                    </div>
                </div>
                <div class="p-8 rounded-xl bg-gold-50 border border-stone-100 flex flex-col justify-between">
                    <p class="italic text-stone-600 text-sm leading-relaxed">
                        "El aceite de Bakuchiol es una revelación. Ha suavizado mis líneas de expresión sin resecar mi rostro como solía pasar con el retinol químico."
                    </p>
                    <div class="mt-6">
                        <h4 class="font-bold text-xs text-luxury-900">Mariana P.</h4>
                        <span class="text-2xs text-stone-400 font-semibold tracking-wider">Piel Madura</span>
                    </div>
                </div>
                <div class="p-8 rounded-xl bg-gold-50 border border-stone-100 flex flex-col justify-between">
                    <p class="italic text-stone-600 text-sm leading-relaxed">
                        "La crema de Rosas y Argán se absorbe maravillosamente y deja un aroma que se siente de spa de cinco estrellas. Una exquisitez de producto."
                    </p>
                    <div class="mt-6">
                        <h4 class="font-bold text-xs text-luxury-900">Sofía R.</h4>
                        <span class="text-2xs text-stone-400 font-semibold tracking-wider">Piel Seca</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

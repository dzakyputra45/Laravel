@extends('layouts.app')

@section('title', 'Karsa Studio — Premium Digital Assets')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 md:py-20">

    {{-- Hero Section --}}
    <section class="mb-24 animate-fade-up">
        <div class="clean-card overflow-hidden relative min-h-[50vh] md:min-h-[60vh] flex items-center bg-white">
            {{-- Background --}}
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 to-transparent z-10"></div>
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1600132806370-bf17e65e942f?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center opacity-30"></div>
            </div>

            {{-- Content --}}
            <div class="relative z-20 px-8 md:px-16 w-full max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-lg bg-neutral-100 border border-neutral-200 px-3 py-1.5 mb-8">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] uppercase tracking-widest font-semibold text-neutral-600">New Collection</span>
                </span>

                <h1 class="text-4xl sm:text-5xl md:text-[3.5rem] font-light tracking-tight leading-[1.1] mb-6 text-neutral-900">
                    Elevate your <br>
                    <span class="font-bold">digital workspace.</span>
                </h1>

                <p class="text-neutral-500 text-base leading-relaxed mb-10 max-w-md">
                    Koleksi premium wallpaper, icon pack, dan template produktivitas untuk ketenangan dan fokus.
                </p>

                <div class="flex items-center gap-4">
                    <a href="{{ route('store') }}" class="btn-primary px-6 py-3 text-sm">
                        Shop Collection
                    </a>
                    <a href="#popular" class="btn-outline px-6 py-3 text-sm flex items-center gap-2">
                        Explore
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Indicators --}}
            <div class="absolute bottom-8 left-16 flex items-center gap-2 z-20">
                <span class="w-8 h-1 rounded-full bg-neutral-900"></span>
                <span class="w-2 h-1 rounded-full bg-neutral-300"></span>
                <span class="w-2 h-1 rounded-full bg-neutral-300"></span>
            </div>
        </div>
    </section>

    {{-- Flash Sale --}}
    <section class="mb-24 animate-fade-up-d1">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-neutral-900">Flash Sale</h2>
                <p class="text-neutral-500 text-sm mt-2">Diskon hingga 50% untuk aset pilihan minggu ini.</p>
            </div>

            {{-- Countdown Timer --}}
            <div class="flex items-center gap-3">
                <span class="text-[10px] font-bold uppercase tracking-widest text-neutral-500">Ends In</span>
                <div class="flex items-center gap-1.5 font-mono text-lg font-bold">
                    <div id="flash-hours" class="bg-neutral-900 text-white rounded-lg px-3 py-2 min-w-[3rem] text-center shadow-md">02</div>
                    <span class="text-neutral-400">:</span>
                    <div id="flash-mins" class="bg-white border border-neutral-200 text-neutral-900 rounded-lg px-3 py-2 min-w-[3rem] text-center">45</div>
                    <span class="text-neutral-400">:</span>
                    <div id="flash-secs" class="bg-white border border-neutral-200 text-neutral-900 rounded-lg px-3 py-2 min-w-[3rem] text-center">12</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($featuredProducts->take(4) as $idx => $product)
                <a href="{{ route('store') }}" class="group clean-card overflow-hidden flex flex-col bg-white">
                    <div class="relative aspect-[4/3] overflow-hidden bg-neutral-100 border-b border-neutral-100">
                        <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        <div class="absolute top-3 left-3 bg-neutral-900 text-white px-2.5 py-1 rounded-md text-[10px] font-bold tracking-wide shadow-md">-25%</div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-neutral-900 group-hover:text-blue-600 transition-colors line-clamp-1">{{ $product->name }}</h3>
                            <div class="flex items-center gap-0.5 mt-2 mb-3">
                                @for($i=0; $i<5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 {{ $i < 4 ? 'text-amber-400' : 'text-neutral-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-1">
                            <div>
                                <del class="text-[11px] text-neutral-400">Rp {{ number_format($product->price * 1.25, 0, ',', '.') }}</del>
                                <div class="text-sm font-bold text-neutral-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="h-8 w-8 rounded-lg bg-neutral-50 border border-neutral-200 flex items-center justify-center text-neutral-600 group-hover:bg-neutral-900 group-hover:border-neutral-900 group-hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Popular Categories --}}
    <section id="popular" class="mb-24 animate-fade-up-d2">
        <div class="mb-10">
            <h2 class="text-3xl font-bold tracking-tight text-neutral-900">Kategori Populer</h2>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            @php
                $categories = [
                    ['name' => 'Wallpapers', 'icon' => 'M4 16l5-5 4 4 3-3 4 4M4 5h16v14H4z', 'count' => '24 Items', 'emoji' => '🖼️'],
                    ['name' => 'Icon Packs', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z', 'count' => '12 Items', 'emoji' => '✨'],
                    ['name' => 'Templates', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'count' => '8 Items', 'emoji' => '📄'],
                    ['name' => 'UI Kits', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01', 'count' => '15 Items', 'emoji' => '🎨']
                ];
            @endphp
            @foreach($categories as $cat)
                <a href="{{ route('store') }}" class="group clean-card bg-white p-6 flex flex-col items-center text-center border border-neutral-100 shadow-sm">
                    <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">{{ $cat['emoji'] }}</div>
                    <h3 class="text-sm font-bold text-neutral-900">{{ $cat['name'] }}</h3>
                    <p class="text-[11px] font-medium text-neutral-500 mt-1">{{ $cat['count'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <div class="text-center animate-fade-up-d3 mb-10">
        <a href="{{ route('store') }}" class="inline-flex items-center gap-3 btn-outline px-8 py-3.5 text-sm">
            Jelajahi Semua Katalog
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function startFlashSaleTimer() {
        let h = 2, m = 45, s = 12;
        const hEl = document.getElementById('flash-hours');
        const mEl = document.getElementById('flash-mins');
        const sEl = document.getElementById('flash-secs');
        if (!hEl || !mEl || !sEl) return;

        setInterval(() => {
            if (s > 0) { s--; }
            else if (m > 0) { m--; s = 59; }
            else if (h > 0) { h--; m = 59; s = 59; }

            hEl.textContent = h.toString().padStart(2, '0');
            mEl.textContent = m.toString().padStart(2, '0');
            sEl.textContent = s.toString().padStart(2, '0');
        }, 1000);
    }
    document.addEventListener('DOMContentLoaded', startFlashSaleTimer);
</script>
@endsection

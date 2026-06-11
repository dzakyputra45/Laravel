@extends('layouts.app')

@section('title', 'Katalog — Karsa Studio')

@section('content')
@php
    $productDetails = $products->map(function ($product) {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description,
            'price' => (float) $product->price,
            'imageUrl' => asset($product->image_path),
            'format' => str_contains(strtolower($product->download_url), '.pdf') ? 'PDF Document' : 'ZIP Archive',
            'benefits' => [
                'Didesain dengan estetika minimalis yang premium.',
                'Akses digital instan setelah pembayaran.',
                'Cocok untuk merapikan workspace pribadi.',
            ],
        ];
    })->values();
@endphp

<div class="max-w-6xl mx-auto px-6 py-12 md:py-16">

    {{-- Page Header --}}
    <div class="text-center max-w-2xl mx-auto mb-14 animate-fade-up">
        <h1 class="text-4xl sm:text-5xl font-light tracking-tight mb-5 leading-tight text-neutral-900">
            Curated for <span class="font-bold">better workflows.</span>
        </h1>
        <p class="text-neutral-500 text-sm leading-relaxed">
            Temukan aset digital premium untuk membantu Anda bekerja lebih fokus dan terorganisir.
        </p>
    </div>

    {{-- 2-Column Layout --}}
    <div class="flex flex-col lg:flex-row gap-8 animate-fade-up-d1">

        {{-- Sidebar --}}
        <aside class="w-full lg:w-64 shrink-0">
            <div class="clean-card p-6 sticky top-24 bg-white border-neutral-100 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-neutral-900">Filter</h3>
                    <button class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 hover:text-neutral-900 transition-colors">Reset</button>
                </div>

                {{-- Kategori --}}
                <div class="mb-8">
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 mb-4">Kategori</h4>
                    <ul class="space-y-2.5">
                        @foreach(['Semua Produk', 'Wallpapers', 'Icon Packs', 'Templates', 'UI Kits'] as $idx => $cat)
                            <li>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="w-4 h-4 rounded border flex items-center justify-center transition-all
                                        {{ $idx === 0 ? 'border-neutral-900 bg-neutral-900' : 'border-neutral-300 bg-transparent group-hover:border-neutral-500' }}">
                                        @if($idx === 0)
                                            <svg class="h-2.5 w-2.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="text-sm {{ $idx === 0 ? 'text-neutral-900 font-semibold' : 'text-neutral-600 group-hover:text-neutral-900' }} transition-colors">{{ $cat }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Harga --}}
                <div class="mb-8">
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 mb-4">Harga</h4>
                    <div class="flex items-center gap-2">
                        <input type="text" placeholder="Min" class="input-clean text-xs w-full py-2 bg-neutral-50 border-neutral-200">
                        <span class="text-neutral-400 text-xs">—</span>
                        <input type="text" placeholder="Max" class="input-clean text-xs w-full py-2 bg-neutral-50 border-neutral-200">
                    </div>
                </div>

                <button class="w-full btn-primary text-xs py-2.5 font-bold">Terapkan</button>
            </div>
        </aside>

        {{-- Product Grid --}}
        <main class="flex-1">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-neutral-200">
                <span class="text-xs font-medium text-neutral-500">{{ $products->count() }} produk</span>
                <select class="bg-transparent text-neutral-900 text-xs font-bold outline-none cursor-pointer">
                    <option value="newest">Terbaru</option>
                    <option value="popular">Terpopuler</option>
                    <option value="price_asc">Harga ↑</option>
                    <option value="price_desc">Harga ↓</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                @foreach($products as $idx => $product)
                    <div class="group clean-card overflow-hidden flex flex-col bg-white border-neutral-100 shadow-sm">
                        <div class="relative aspect-[4/3] overflow-hidden bg-neutral-100 border-b border-neutral-100 cursor-pointer" onclick="openProductDetail('{{ $product->id }}')">
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">

                            @if($idx % 3 === 0)
                                <span class="absolute top-3 left-3 bg-neutral-900 text-white px-2.5 py-1 rounded-md text-[10px] font-bold tracking-wide shadow-md">-20%</span>
                            @elseif($idx % 4 === 0)
                                <span class="absolute top-3 left-3 bg-blue-600 text-white px-2.5 py-1 rounded-md text-[10px] font-bold tracking-wide">HOT</span>
                            @endif

                            {{-- Quick View Overlay --}}
                            <div class="absolute inset-0 bg-white/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                                <span class="bg-neutral-900 text-white text-xs font-bold px-4 py-2 rounded-lg shadow-xl transform translate-y-2 group-hover:translate-y-0 transition-transform">Quick View</span>
                            </div>
                        </div>

                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <h2 class="text-sm font-bold text-neutral-900 group-hover:text-blue-600 transition-colors line-clamp-1 cursor-pointer" onclick="openProductDetail('{{ $product->id }}')">
                                    {{ $product->name }}
                                </h2>
                                <div class="flex items-center gap-0.5 mt-2 mb-3">
                                    @for($i=0; $i<5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 {{ $i < 4 || ($i==4 && $idx%2==0) ? 'text-amber-400' : 'text-neutral-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                    <span class="text-[10px] font-medium text-neutral-400 ml-1">({{ rand(12, 145) }})</span>
                                </div>
                            </div>

                            <div class="flex items-end justify-between mt-3">
                                <div>
                                    @if($idx % 3 === 0)
                                        <del class="text-[11px] text-neutral-400">Rp {{ number_format($product->price * 1.2, 0, ',', '.') }}</del>
                                    @endif
                                    <div class="text-sm font-bold text-neutral-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                </div>
                                <button class="h-9 w-9 rounded-lg bg-neutral-50 border border-neutral-200 flex items-center justify-center text-neutral-600 hover:bg-neutral-900 hover:border-neutral-900 hover:text-white transition-all" aria-label="Add to cart">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
</div>

{{-- Product Detail Modal --}}
<div id="productDetailModal" class="fixed inset-0 z-50 hidden bg-neutral-900/40 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white border border-neutral-200 rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto p-6 md:p-10 shadow-2xl relative">
        <button onclick="closeProductDetail()" class="absolute top-5 right-5 text-neutral-400 hover:text-neutral-900 bg-neutral-100 hover:bg-neutral-200 rounded-lg p-2 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="grid grid-cols-1 md:grid-cols-[1.1fr_0.9fr] gap-8 mt-2">
            <div class="aspect-[4/3] overflow-hidden rounded-xl bg-neutral-100 border border-neutral-100">
                <img id="detailProductImage" src="" alt="" class="w-full h-full object-cover">
            </div>

            <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-widest text-neutral-500 mb-2">Digital Asset</span>
                <h3 id="detailProductName" class="text-2xl font-bold text-neutral-900 tracking-tight leading-tight mb-3"></h3>
                <p id="detailProductPrice" class="text-xl font-bold text-blue-600 mb-5"></p>
                <p id="detailProductDescription" class="text-neutral-600 text-sm leading-relaxed mb-6"></p>

                <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-5 mb-6">
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 mb-3">Termasuk:</h4>
                    <ul id="detailProductBenefits" class="space-y-3"></ul>
                    <div class="mt-4 pt-4 border-t border-neutral-200 flex items-center justify-between">
                        <span class="text-xs text-neutral-500">Format:</span>
                        <span id="detailProductFormat" class="text-xs font-bold text-neutral-700 bg-white px-2.5 py-1 rounded-md border border-neutral-200"></span>
                    </div>
                </div>

                <div class="mt-auto flex gap-3">
                    @auth
                        <button type="button" onclick="continueToCheckout()" class="flex-1 btn-primary py-3.5 text-sm font-bold">
                            Beli Sekarang
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="flex-1 text-center btn-primary py-3.5 text-sm font-bold">
                            Login untuk Membeli
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Checkout Modal --}}
<div id="checkoutModal" class="fixed inset-0 z-50 hidden bg-neutral-900/40 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white border border-neutral-200 rounded-2xl max-w-md w-full p-8 shadow-2xl relative">
        <button onclick="closeCheckoutModal()" class="absolute top-5 right-5 text-neutral-400 hover:text-neutral-900 bg-neutral-100 hover:bg-neutral-200 rounded-lg p-2 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="mb-6 text-center">
            <h3 class="text-xl font-bold text-neutral-900 mb-1">Checkout</h3>
            <p class="text-sm text-neutral-500">Lengkapi detail pesanan Anda</p>
        </div>

        <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-4 mb-6 flex items-center justify-between">
            <div class="max-w-[65%]">
                <p class="text-[10px] text-neutral-400 mb-0.5 font-bold uppercase tracking-widest">Item</p>
                <p id="modalProductName" class="text-sm font-bold text-neutral-900 truncate"></p>
            </div>
            <div class="text-right">
                <p class="text-[10px] text-neutral-400 mb-0.5 font-bold uppercase tracking-widest">Total</p>
                <p id="modalProductPrice" class="text-sm font-bold text-blue-600"></p>
            </div>
        </div>

        <form action="{{ route('checkout') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="product_id" id="modalProductId">

            <div>
                <label for="customer_name" class="block text-xs font-bold text-neutral-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ auth()->user()->name ?? old('customer_name') }}" required placeholder="John Doe" class="input-clean bg-neutral-50 border-neutral-200 text-sm w-full">
            </div>

            <div>
                <label for="customer_email" class="block text-xs font-bold text-neutral-700 mb-1.5">Email</label>
                <input type="email" name="customer_email" id="customer_email" value="{{ auth()->user()->email ?? old('customer_email') }}" required placeholder="john@example.com" class="input-clean bg-neutral-50 border-neutral-200 text-sm w-full">
            </div>

            <div class="pt-3">
                <button type="submit" class="w-full btn-primary py-3.5 text-sm font-bold">Bayar & Unduh</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const products = @json($productDetails);
    let selectedProduct = null;

    function rupiah(price) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(price);
    }

    function openProductDetail(id) {
        selectedProduct = products.find((p) => String(p.id) === String(id));
        if (!selectedProduct) return;

        document.getElementById('detailProductImage').src = selectedProduct.imageUrl;
        document.getElementById('detailProductImage').alt = selectedProduct.name;
        document.getElementById('detailProductName').innerText = selectedProduct.name;
        document.getElementById('detailProductDescription').innerText = selectedProduct.description;
        document.getElementById('detailProductPrice').innerText = rupiah(selectedProduct.price);
        document.getElementById('detailProductFormat').innerText = selectedProduct.format;

        const benefits = document.getElementById('detailProductBenefits');
        benefits.innerHTML = '';
        selectedProduct.benefits.forEach((b) => {
            const li = document.createElement('li');
            li.className = 'flex items-start gap-3 text-sm text-neutral-600 leading-relaxed';
            li.innerHTML = '<svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span></span>';
            li.querySelector('span:last-child').innerText = b;
            benefits.appendChild(li);
        });

        document.getElementById('productDetailModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeProductDetail() {
        document.getElementById('productDetailModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function continueToCheckout() {
        if (!selectedProduct) return;
        closeProductDetail();
        openCheckoutModal(selectedProduct.id, selectedProduct.name, selectedProduct.price);
    }

    function openCheckoutModal(id, name, price) {
        document.getElementById('modalProductId').value = id;
        document.getElementById('modalProductName').innerText = name;
        document.getElementById('modalProductPrice').innerText = rupiah(price);
        document.getElementById('checkoutModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeCheckoutModal() {
        document.getElementById('checkoutModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.getElementById('productDetailModal').addEventListener('click', function(e) { if (e.target === this) closeProductDetail(); });
    document.getElementById('checkoutModal').addEventListener('click', function(e) { if (e.target === this) closeCheckoutModal(); });
</script>
@endsection

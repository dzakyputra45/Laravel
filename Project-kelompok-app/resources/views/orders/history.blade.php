@extends('layouts.app')

@section('title', 'Akun Saya — Karsa Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 md:py-16">

    <!-- Header -->
    <div class="mb-12 animate-fade-up">
        <span class="inline-flex items-center gap-2 rounded-lg bg-neutral-100 border border-neutral-200 px-3 py-1.5 mb-4">
            <span class="h-1.5 w-1.5 rounded-full bg-neutral-900"></span>
            <span class="text-[10px] uppercase tracking-widest font-bold text-neutral-600">Dashboard Pengguna</span>
        </span>
        <h1 class="text-4xl font-bold tracking-tight text-neutral-900">
            Akun <span class="text-neutral-500">Saya</span>
        </h1>
        <p class="text-neutral-500 text-sm mt-3 leading-relaxed max-w-lg">
            Kelola profil Anda, unduh aset digital yang telah dibeli, dan pantau riwayat transaksi Anda.
        </p>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- LEFT COLUMN: MEMBER ID & OVERVIEW (4 cols on lg) -->
        <div class="lg:col-span-4 flex flex-col gap-6 animate-fade-up-d1">
            
            <!-- Minimal Profile Card -->
            <div class="clean-card bg-white p-6 border-neutral-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest bg-blue-50 text-blue-600 border border-blue-100">
                        @if($totalItems > 3)
                            PREMIUM
                        @else
                            MEMBER
                        @endif
                    </span>
                </div>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-16 w-16 rounded-full bg-neutral-100 border border-neutral-200 flex items-center justify-center text-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-neutral-900">{{ auth()->user()->name }}</h2>
                        <p class="text-xs text-neutral-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <div class="space-y-4 pt-4 border-t border-neutral-100">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-neutral-500">Bergabung sejak</span>
                        <span class="font-bold text-neutral-900">{{ auth()->user()->created_at->format('M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-neutral-500">User ID</span>
                        <span class="font-bold font-mono text-neutral-900 bg-neutral-100 px-2 py-0.5 rounded">KS-USR-{{ sprintf('%05d', auth()->user()->id) }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats Box -->
            <div class="clean-card bg-white p-6 border-neutral-100 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 block mb-4">Ringkasan</span>
                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-neutral-100">
                        <span class="text-sm text-neutral-600">Aset Terkumpul</span>
                        <span class="font-bold text-neutral-900">{{ $totalItems }} Item</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-neutral-600">Total Transaksi</span>
                        <span class="font-bold text-blue-600">Rp {{ number_format($totalSpent, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: INTERACTIVE TABS SYSTEM (8 cols on lg) -->
        <div class="lg:col-span-8 flex flex-col gap-6 animate-fade-up-d2">
            
            <!-- Navigation Tabs -->
            <div class="flex border-b border-neutral-200">
                <button data-tab="collection" class="tab-btn pb-4 px-2 mr-6 text-sm font-bold text-blue-600 border-b-2 border-blue-600 transition-colors">
                    Koleksi Saya
                </button>
                <button data-tab="history" class="tab-btn pb-4 px-2 mr-6 text-sm font-bold text-neutral-400 hover:text-neutral-900 border-b-2 border-transparent transition-colors">
                    Riwayat Transaksi
                </button>
                <button data-tab="settings" class="tab-btn pb-4 px-2 text-sm font-bold text-neutral-400 hover:text-neutral-900 border-b-2 border-transparent transition-colors">
                    Pengaturan Akun
                </button>
            </div>

            <!-- TAB CONTENTS -->
            <div class="min-h-[400px]">
                
                <!-- TAB 1: KOLEKSI SAYA -->
                <div id="collection" class="tab-panel space-y-6 animate-fade-up">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-neutral-900">Katalog Digital Anda</h2>
                        <span class="text-xs font-bold text-neutral-500">{{ $totalItems }} Aset Aktif</span>
                    </div>

                    @if($purchasedProducts->isEmpty())
                        <div class="clean-card bg-neutral-50 p-12 text-center border border-dashed border-neutral-200">
                            <div class="mb-4 mx-auto w-12 h-12 rounded-full bg-white border border-neutral-200 flex items-center justify-center text-neutral-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-neutral-900 mb-2">Belum ada aset premium</h3>
                            <p class="text-neutral-500 text-sm max-w-sm mx-auto mb-6">
                                Beli produk digital premium terlebih dahulu untuk melihat dan mengunduhnya di sini.
                            </p>
                            <a href="{{ route('store') }}" class="btn-primary py-3 px-6 text-sm">
                                Jelajahi Katalog
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach($purchasedProducts as $product)
                                <div class="clean-card bg-white border border-neutral-100 shadow-sm overflow-hidden flex flex-col group">
                                    <div class="relative overflow-hidden bg-neutral-100 aspect-[4/3]">
                                        <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                    <div class="p-5 flex-1 flex flex-col justify-between">
                                        <div class="mb-4">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-[10px] font-bold uppercase tracking-widest text-neutral-500 bg-neutral-100 px-2 py-0.5 rounded">.ZIP PACK</span>
                                            </div>
                                            <h3 class="text-sm font-bold text-neutral-900">{{ $product->name }}</h3>
                                            <p class="text-xs text-neutral-500 mt-1 line-clamp-1">Slug: {{ $product->slug }}</p>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ $product->download_url }}" target="_blank" class="flex-1 btn-primary text-xs py-2.5 px-4 text-center">
                                                Unduh Aset
                                            </a>
                                            <a href="{{ route('store') }}" class="w-10 h-10 border border-neutral-200 bg-neutral-50 hover:bg-neutral-100 text-neutral-600 flex items-center justify-center rounded-lg transition-colors" title="Detail Produk">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <!-- TAB 2: RIWAYAT TRANSAKSI -->
                <div id="history" class="tab-panel space-y-6 hidden animate-fade-up">
                    <h2 class="text-xl font-bold text-neutral-900">Riwayat Pemesanan</h2>
                    
                    @if($orders->isEmpty())
                        <div class="clean-card bg-neutral-50 p-10 text-center border border-dashed border-neutral-200">
                            <p class="text-neutral-500 text-sm">Belum ada riwayat transaksi.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="clean-card p-5 bg-white border border-neutral-100 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <h3 class="text-sm font-bold text-neutral-900 tracking-tight">{{ $order->id }}</h3>
                                                @if($order->status === 'paid')
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100">
                                                        <span class="h-1 w-1 rounded-full bg-emerald-500"></span>
                                                        SUCCESS
                                                    </span>
                                                @elseif($order->status === 'pending')
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-widest bg-amber-50 text-amber-600 border border-amber-100">
                                                        <span class="h-1 w-1 rounded-full bg-amber-500"></span>
                                                        PENDING
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-widest bg-neutral-100 text-neutral-600 border border-neutral-200">
                                                        {{ $order->status }}
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-neutral-500">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>

                                            <!-- Order Items summary -->
                                            <div class="mt-4 space-y-2 border-t border-neutral-100 pt-3">
                                                @foreach($order->items as $item)
                                                    <div class="flex items-center justify-between text-xs text-neutral-700">
                                                        <span>{{ $item->product->name }}</span>
                                                        <span class="font-semibold text-neutral-900">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="lg:text-right shrink-0">
                                            <p class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 mb-1">Total Bayar</p>
                                            <p class="text-lg font-bold text-blue-600 mb-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                            <a href="{{ route('order.status', ['order_id' => $order->id]) }}" class="inline-block btn-outline text-xs font-bold py-2 px-4 text-center w-full">
                                                Lihat Status
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- TAB 3: SISTEM AKUN -->
                <div id="settings" class="tab-panel space-y-6 hidden animate-fade-up">
                    <h2 class="text-xl font-bold text-neutral-900">Pengaturan Akun</h2>

                    <div class="clean-card p-6 bg-white border border-neutral-100 shadow-sm max-w-md">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 block mb-4">Profil</span>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 mb-1.5">Nama Lengkap</label>
                                <input type="text" value="{{ auth()->user()->name }}" disabled class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm text-neutral-500 cursor-not-allowed">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 mb-1.5">Email</label>
                                <input type="text" value="{{ auth()->user()->email }}" disabled class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm text-neutral-500 cursor-not-allowed">
                            </div>

                            <p class="text-xs text-neutral-500 mt-2 bg-neutral-50 p-3 rounded-lg border border-neutral-100">
                                Untuk mengubah detail profil atau password, silakan hubungi tim dukungan Karsa Studio.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Tab System Logic
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.tab-btn');
        const panels = document.querySelectorAll('.tab-panel');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Deactivate all tabs
                tabs.forEach(t => {
                    t.classList.remove('text-blue-600', 'border-blue-600');
                    t.classList.add('text-neutral-400', 'border-transparent');
                });
                
                // Hide all panels
                panels.forEach(p => p.classList.add('hidden'));

                // Activate selected tab
                tab.classList.remove('text-neutral-400', 'border-transparent');
                tab.classList.add('text-blue-600', 'border-blue-600');
                
                // Show matching panel
                const targetId = tab.getAttribute('data-tab');
                const targetPanel = document.getElementById(targetId);
                if (targetPanel) {
                    targetPanel.classList.remove('hidden');
                }
            });
        });
    });
</script>
@endsection

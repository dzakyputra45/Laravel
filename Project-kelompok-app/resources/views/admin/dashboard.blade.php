@extends('layouts.app')

@section('title', 'Admin Dashboard — Karsa Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 md:py-16">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 animate-fade-up">
        <div>
            <span class="inline-flex items-center gap-2 rounded-lg bg-neutral-100 border border-neutral-200 px-3 py-1.5 mb-4">
                <span class="h-1.5 w-1.5 rounded-full bg-neutral-900"></span>
                <span class="text-[10px] uppercase tracking-widest font-bold text-neutral-600">Admin Panel</span>
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-neutral-900">
                Dashboard <span class="text-neutral-500">Admin</span>
            </h1>
            <p class="text-neutral-500 text-sm mt-3 max-w-lg">
                Pusat kontrol admin Karsa Studio. Kelola katalog, produk, dan lihat order user.
            </p>
        </div>
    </div>

    @if(session('status_message'))
        <div class="mb-8 badge-success rounded-lg px-4 py-3 text-xs font-semibold animate-fade-up">
            {{ session('status_message') }}
        </div>
    @endif

    {{-- Stats --}}
    <section class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-12 animate-fade-up-d1">
        @php
            $stats = [
                ['label' => 'Total Produk', 'value' => $productCount, 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'color' => 'bg-blue-50 text-blue-600 border-blue-100'],
                ['label' => 'Total Order', 'value' => $orderCount, 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'bg-amber-50 text-amber-600 border-amber-100'],
                ['label' => 'Order Sukses', 'value' => $paidOrderCount, 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'bg-emerald-50 text-emerald-600 border-emerald-100'],
            ];
        @endphp
        @foreach($stats as $stat)
            <div class="clean-card p-6 bg-white border-neutral-100 shadow-sm group">
                <div class="flex items-center justify-between mb-5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-neutral-400">{{ $stat['label'] }}</span>
                    <div class="h-10 w-10 rounded-xl {{ $stat['color'] }} border flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-neutral-900">{{ $stat['value'] }}</h2>
            </div>
        @endforeach
    </section>

    {{-- Quick Actions --}}
    <section class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-12 animate-fade-up-d2">
        @php
            $actions = [
                ['href' => route('admin.products.index'), 'title' => 'Kelola Katalog', 'desc' => 'Lihat, edit, atau hapus produk dari katalog.', 'cta' => 'Buka Katalog', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z'],
                ['href' => route('admin.products.create'), 'title' => 'Tambah Produk', 'desc' => 'Buat produk digital baru dengan detail lengkap.', 'cta' => 'Tambah Baru', 'icon' => 'M12 4v16m8-8H4'],
                ['href' => route('admin.orders.index'), 'title' => 'Order User', 'desc' => 'Pantau pesanan, status pembayaran, dan transaksi.', 'cta' => 'Lihat Order', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
            ];
        @endphp
        @foreach($actions as $act)
            <a href="{{ $act['href'] }}" class="group clean-card p-6 flex flex-col bg-white border-neutral-100 shadow-sm">
                <div class="h-10 w-10 rounded-xl bg-neutral-50 border border-neutral-200 flex items-center justify-center mb-5 text-neutral-500 group-hover:bg-neutral-900 group-hover:border-neutral-900 group-hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $act['icon'] }}" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-neutral-900 mb-2">{{ $act['title'] }}</h2>
                <p class="text-neutral-500 text-sm leading-relaxed mb-5 flex-grow">{{ $act['desc'] }}</p>
                <span class="inline-flex items-center gap-2 text-xs font-bold text-neutral-400 group-hover:text-neutral-900 transition-colors">
                    {{ $act['cta'] }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            </a>
        @endforeach
    </section>

    {{-- Recent Orders --}}
    <section class="clean-card overflow-hidden bg-white border-neutral-100 shadow-sm animate-fade-up-d3">
        <div class="p-6 border-b border-neutral-100">
            <div class="flex items-center gap-3">
                <span class="h-5 w-1 rounded-full bg-neutral-900"></span>
                <h2 class="text-base font-bold text-neutral-900">Order Terbaru</h2>
            </div>
            <p class="text-neutral-500 text-xs mt-1 ml-4">Ringkasan order terbaru dari user.</p>
        </div>

        @forelse($recentOrders as $order)
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 hover:bg-neutral-50 transition-colors border-b border-neutral-100">
                <div>
                    <h3 class="text-sm font-bold text-neutral-900">#{{ $order->id }}</h3>
                    <p class="text-[11px] text-neutral-500 mt-0.5">{{ $order->user?->email ?? $order->customer_email }} · {{ $order->created_at->format('d M Y') }}</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-sm font-bold text-neutral-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest mt-1
                        @if($order->status === 'paid') text-emerald-600
                        @elseif($order->status === 'pending') text-amber-600
                        @else text-neutral-400
                        @endif
                    ">
                        <span class="h-1.5 w-1.5 rounded-full
                            @if($order->status === 'paid') bg-emerald-500
                            @elseif($order->status === 'pending') bg-amber-500
                            @else bg-neutral-400
                            @endif
                        "></span>
                        {{ $order->status }}
                    </span>
                </div>
            </div>
        @empty
            <div class="p-10 text-center">
                <p class="text-neutral-400 text-sm">Belum ada order user.</p>
            </div>
        @endforelse
    </section>
</div>
@endsection

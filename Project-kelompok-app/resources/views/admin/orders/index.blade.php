@extends('layouts.app')

@section('title', 'Order User — Karsa Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 md:py-16">

    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 animate-fade-up">
        <div>
            <span class="inline-flex items-center gap-2 rounded-lg bg-neutral-100 border border-neutral-200 px-3 py-1.5 mb-4">
                <span class="h-1.5 w-1.5 rounded-full bg-neutral-900"></span>
                <span class="text-[10px] uppercase tracking-widest font-bold text-neutral-600">Admin Panel</span>
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-neutral-900">
                Order <span class="text-neutral-500">User</span>
            </h1>
            <p class="text-neutral-500 text-sm mt-3 max-w-lg">
                Lihat semua order yang dibuat user, produk yang dibeli, total pembayaran, dan status transaksi.
            </p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn-outline text-sm font-bold py-3.5 px-6">
            Dashboard Admin
        </a>
    </div>

    <section class="clean-card bg-white border-neutral-100 shadow-sm overflow-hidden animate-fade-up-d1">
        @forelse($orders as $order)
            <article class="p-6 hover:bg-neutral-50 transition-colors border-b border-neutral-100 last:border-b-0">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-3">
                            <h2 class="text-lg font-bold text-neutral-900 tracking-tight">{{ $order->id }}</h2>

                            @if($order->status === 'paid')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    SUKSES
                                </span>
                            @elseif($order->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest bg-amber-50 text-amber-600 border border-amber-100">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    PENDING
                                </span>
                            @elseif($order->status === 'expired')
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest bg-neutral-100 text-neutral-600 border border-neutral-200">KADALUARSA</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest bg-red-50 text-red-600 border border-red-100">GAGAL</span>
                            @endif
                        </div>

                        <p class="text-neutral-500 text-xs mt-2">
                            {{ $order->created_at->format('d M Y, H:i') }} WIB · {{ $order->user?->name ?? $order->customer_name }} · {{ $order->user?->email ?? $order->customer_email }}
                        </p>

                        <div class="mt-5 space-y-3">
                            @foreach($order->items as $item)
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 pt-3 border-t border-neutral-100">
                                    <div>
                                        <h3 class="text-sm text-neutral-900 font-bold">{{ $item->product->name }}</h3>
                                        <p class="text-[11px] text-neutral-500 mt-1 bg-neutral-100 px-2 py-0.5 rounded inline-block">{{ $item->product->trashed() ? '[ DELETED ]' : $item->product->slug }}</p>
                                    </div>
                                    <span class="text-sm text-neutral-900 font-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="lg:text-right shrink-0">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Total</p>
                        <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 mt-4">Payment</p>
                        <p class="text-sm text-neutral-900 font-semibold mt-1">{{ $order->payment_type ?? 'N/A' }}</p>
                    </div>
                </div>
            </article>
        @empty
            <div class="p-10 text-center">
                <div class="mb-5 mx-auto w-14 h-14 rounded-xl border border-neutral-200 bg-neutral-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <h2 class="text-2xl font-bold text-neutral-900 mb-2">Belum ada order user</h2>
                <p class="text-neutral-500 text-sm">Order akan muncul setelah user melakukan checkout.</p>
            </div>
        @endforelse
    </section>
</div>
@endsection

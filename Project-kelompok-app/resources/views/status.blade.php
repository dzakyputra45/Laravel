@extends('layouts.app')

@section('title', 'Karsa Studio — Status Pembayaran')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-16 relative">
    <div class="particle" style="top:10%; right:10%; animation-delay:0s;"></div>
    <div class="particle" style="top:50%; left:8%; animation-delay:3s;"></div>

    <div class="text-center mb-12 max-w-3xl mx-auto relative z-10 animate-fade-up">
        <span class="tag-cyber inline-flex rounded-full px-5 py-2 text-[10px] font-mono font-semibold uppercase">Transaksi Detail</span>
        <h1 class="text-4xl md:text-5xl font-extralight tracking-tight mt-6 leading-[1.05]">
            <span class="text-white">Order </span><span class="neon-text-strong font-mono">{{ $order->id }}</span>
        </h1>
        <p class="text-[var(--text-dim)] text-xs mt-4 font-mono">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
    </div>

    <div class="max-w-2xl mx-auto relative z-10">
        <div class="holo-card p-8 rounded-lg mb-6 animate-fade-up-d1">
            <div class="flex items-center justify-between mb-8">
                <span class="font-mono text-[10px] font-semibold uppercase tracking-[0.2em] text-[var(--text-dim)]">Status Pembayaran</span>
                @if($order->status == 'paid')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-mono font-medium badge-success">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400" style="animation: pulse-dot 2s infinite;"></span>
                        SUKSES
                    </span>
                @elseif($order->status == 'pending')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-mono font-medium badge-warning">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-400" style="animation: pulse-dot 2s infinite;"></span>
                        PENDING
                    </span>
                @elseif($order->status == 'expired')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-mono font-medium badge-neutral">KADALUARSA</span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-mono font-medium badge-danger">GAGAL</span>
                @endif
            </div>

            @if(session('status_message'))
                <div class="mb-6 p-4 holo-card rounded-lg text-[var(--text-main)] text-xs font-mono tracking-wide">
                    {{ session('status_message') }}
                </div>
            @endif

            @if($order->status == 'paid')
                <div class="space-y-6">
                    <div class="p-6 rounded-lg border border-emerald-500/15 bg-emerald-500/[0.03]">
                        <h3 class="text-xl font-semibold tracking-tight text-white mb-2">Terima kasih atas pembelian Anda</h3>
                        <p class="text-[var(--text-dim)] text-sm font-light leading-relaxed mb-6">
                            Pembayaran Anda telah diverifikasi oleh gateway. Anda sekarang dapat mengunduh produk digital premium Anda.
                        </p>
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between border-t border-emerald-500/10 pt-4 mt-4">
                                <div>
                                    <h4 class="text-xs font-medium text-white">{{ $item->product->name }}</h4>
                                    <p class="text-[10px] text-[var(--text-dim)] font-mono mt-0.5">Format: .zip / .pdf</p>
                                </div>
                                <a href="{{ $item->product->download_url }}" target="_blank" class="btn-neon-fill font-mono text-[9px] font-bold py-2 px-4 rounded tracking-[0.15em] uppercase">
                                    Unduh File
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            @elseif($order->status == 'pending')
                <div class="space-y-6">
                    <p class="text-[var(--text-dim)] text-sm leading-relaxed font-light">
                        Selesaikan pembayaran sebesar <strong class="text-white font-mono">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong> untuk mendapatkan akses produk.
                    </p>

                    @if($midtransConfigured && !str_starts_with($order->snap_token, 'simulated-token-'))
                        <button id="payButton" class="w-full btn-neon-fill font-mono text-[10px] font-semibold py-3.5 rounded tracking-[0.2em] uppercase">
                            Bayar Sekarang (Midtrans)
                        </button>
                    @else
                        <div class="p-6 holo-card rounded-lg space-y-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                <div>
                                    <h4 class="text-xs font-semibold text-white">Mode Simulasi Aktif</h4>
                                    <p class="text-[11px] text-[var(--text-dim)] font-light mt-1 leading-relaxed">
                                        Midtrans API belum dikonfigurasi di <code class="neon-text bg-[rgba(0,240,255,0.05)] px-1.5 py-0.5 rounded font-mono text-[10px]">.env</code>. Simulasikan status pembayaran:
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-3 pt-2">
                                <form action="{{ route('order.simulate-pay', ['order_id' => $order->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="paid">
                                    <button type="submit" class="w-full badge-success font-mono text-[9px] font-medium py-2.5 px-3 rounded-lg transition-all duration-300 uppercase tracking-wider hover:bg-emerald-500/20">
                                        Simulasi Sukses
                                    </button>
                                </form>
                                <form action="{{ route('order.simulate-pay', ['order_id' => $order->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="expired">
                                    <button type="submit" class="w-full badge-neutral font-mono text-[9px] font-medium py-2.5 px-3 rounded-lg transition-all duration-300 uppercase tracking-wider hover:bg-white/[0.08]">
                                        Simulasi Expire
                                    </button>
                                </form>
                                <form action="{{ route('order.simulate-pay', ['order_id' => $order->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="failed">
                                    <button type="submit" class="w-full badge-danger font-mono text-[9px] font-medium py-2.5 px-3 rounded-lg transition-all duration-300 uppercase tracking-wider hover:bg-rose-500/20">
                                        Simulasi Gagal
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

            @else
                <div>
                    <p class="text-[var(--text-dim)] text-xs leading-relaxed font-light mb-6">
                        Transaksi ini gagal atau telah kadaluarsa. Silakan lakukan pemesanan ulang.
                    </p>
                    <a href="{{ route('store') }}" class="w-full text-center block btn-neon font-mono text-[10px] font-semibold py-3.5 rounded tracking-[0.2em] uppercase">
                        Kembali ke Katalog
                    </a>
                </div>
            @endif
        </div>

        <div class="holo-card p-8 rounded-lg animate-fade-up-d2">
            <h3 class="font-mono text-[10px] font-semibold uppercase tracking-[0.2em] text-[var(--text-dim)] mb-6">Ringkasan Order</h3>
            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex items-center justify-between text-xs py-1">
                        <span class="text-[var(--text-dim)] font-light">{{ $item->product->name }}</span>
                        <span class="text-white font-medium font-mono">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <hr class="divider-neon my-4">

                <div class="flex items-center justify-between text-xs py-1">
                    <span class="text-[var(--text-dim)] font-light">Subtotal</span>
                    <span class="text-[var(--text-main)] font-medium font-mono">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-xs py-1">
                    <span class="text-[var(--text-dim)] font-light">Biaya Transaksi</span>
                    <span class="text-[var(--text-main)] font-medium font-mono">Rp 0</span>
                </div>
                <div class="flex items-center justify-between text-sm py-2 mt-2" style="border-top: 1px solid rgba(0,240,255,0.06);">
                    <span class="text-white font-semibold">Total Pembayaran</span>
                    <span class="neon-text-strong font-bold font-mono text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <hr class="divider-neon my-6">

            <h3 class="font-mono text-[10px] font-semibold uppercase tracking-[0.2em] text-[var(--text-dim)] mb-4">Informasi Pelanggan</h3>
            <div class="space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="text-[var(--text-dim)] font-light">Nama</span>
                    <span class="text-[var(--text-main)]">{{ $order->customer_name }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-[var(--text-dim)] font-light">Email</span>
                    <span class="text-[var(--text-main)] font-mono">{{ $order->customer_email }}</span>
                </div>
                @if($order->customer_phone)
                    <div class="flex items-center justify-between">
                        <span class="text-[var(--text-dim)] font-light">Telepon</span>
                        <span class="text-[var(--text-main)] font-mono">{{ $order->customer_phone }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if($order->status == 'pending' && $midtransConfigured && !str_starts_with($order->snap_token, 'simulated-token-'))
    <script src="{{ $isProduction ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ $clientKey }}"></script>
    <script>
        const payButton = document.getElementById('payButton');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $order->snap_token }}', {
                onSuccess: function(result) { window.location.reload(); },
                onPending: function(result) { window.location.reload(); },
                onError: function(result) { window.location.reload(); },
                onClose: function() { console.log('popup closed'); }
            });
        });
    </script>
@endif
@endsection

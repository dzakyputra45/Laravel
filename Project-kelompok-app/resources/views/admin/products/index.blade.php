@extends('layouts.app')

@section('title', 'Kelola Katalog — Karsa Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 md:py-16">

    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 animate-fade-up">
        <div>
            <span class="inline-flex items-center gap-2 rounded-lg bg-neutral-100 border border-neutral-200 px-3 py-1.5 mb-4">
                <span class="h-1.5 w-1.5 rounded-full bg-neutral-900"></span>
                <span class="text-[10px] uppercase tracking-widest font-bold text-neutral-600">Admin Panel</span>
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-neutral-900">
                Kelola <span class="text-neutral-500">Katalog</span>
            </h1>
            <p class="text-neutral-500 text-sm mt-3 max-w-lg">
                Halaman khusus untuk melihat, mengedit, dan menghapus produk katalog Karsa Studio.
            </p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary py-3.5 px-6 text-sm font-bold shadow-sm hover:shadow-md">
            Tambah Katalog
        </a>
    </div>

    @if(session('status_message'))
        <div class="mb-8 badge-success rounded-lg px-4 py-3 text-xs font-semibold animate-fade-up">
            {{ session('status_message') }}
        </div>
    @endif

    <section class="clean-card bg-white border-neutral-100 shadow-sm overflow-hidden animate-fade-up-d1">
        @if($products->isEmpty())
            <div class="p-10 text-center">
                <div class="mb-5 mx-auto w-14 h-14 rounded-xl bg-neutral-50 border border-neutral-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h2 class="text-2xl font-bold text-neutral-900 mb-2">Belum ada produk katalog</h2>
                <p class="text-neutral-500 text-sm">Tambahkan katalog baru agar produk tampil di halaman user.</p>
            </div>
        @else
            <div class="divide-y divide-neutral-100">
                @foreach($products as $product)
                    <div class="p-6 flex flex-col md:flex-row md:items-center gap-5 hover:bg-neutral-50 transition-colors">
                        <div class="relative overflow-hidden rounded-lg border border-neutral-200 group bg-neutral-100">
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="w-full md:w-40 aspect-[16/10] object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold text-neutral-900">{{ $product->name }}</h3>
                            <p class="text-[11px] text-neutral-500 mt-1 font-mono bg-neutral-100 px-2 py-0.5 rounded inline-block">{{ $product->slug }}</p>
                            <p class="text-sm text-neutral-600 leading-relaxed mt-3 line-clamp-2">{{ $product->description }}</p>
                        </div>

                        <div class="md:text-right shrink-0">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 mb-1">Harga</p>
                            <p class="text-lg font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="mt-4 flex flex-col sm:flex-row md:justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn-outline text-xs font-bold py-2.5 px-5 text-center">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari katalog user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full badge-danger text-xs font-bold py-2.5 px-5 rounded-lg hover:bg-red-500 hover:text-white transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection

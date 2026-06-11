@extends('layouts.app')

@section('title', 'Edit Katalog — Karsa Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 md:py-16">

    <div class="max-w-3xl mx-auto">
        <div class="mb-10 animate-fade-up">
            <span class="inline-flex items-center gap-2 rounded-lg bg-neutral-100 border border-neutral-200 px-3 py-1.5 mb-4">
                <span class="h-1.5 w-1.5 rounded-full bg-neutral-900"></span>
                <span class="text-[10px] uppercase tracking-widest font-bold text-neutral-600">Admin Panel</span>
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-neutral-900">
                Edit <span class="text-neutral-500">Katalog</span>
            </h1>
            <p class="text-neutral-500 text-sm mt-3 leading-relaxed">
                Ubah informasi produk digital. Perubahan akan langsung terlihat oleh user.
            </p>
        </div>

        <div class="clean-card p-8 bg-white border-neutral-100 shadow-sm animate-fade-up-d1">
            @if($errors->any())
                <div class="mb-6 badge-danger rounded-lg px-4 py-3 text-xs font-semibold">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-xs font-bold text-neutral-700 mb-1.5">Nama Produk</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div>
                    <label for="slug" class="block text-xs font-bold text-neutral-700 mb-1.5">Slug (Optional)</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div>
                    <label for="description" class="block text-xs font-bold text-neutral-700 mb-1.5">Deskripsi Produk</label>
                    <textarea name="description" id="description" rows="5" required class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <label for="price" class="block text-xs font-bold text-neutral-700 mb-1.5">Harga</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0" step="1000" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="image" class="block text-xs font-bold text-neutral-700 mb-1.5">Update Gambar</label>
                        <input type="file" name="image" id="image" accept="image/*" class="w-full text-xs text-neutral-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-neutral-100 file:text-neutral-700 hover:file:bg-neutral-200 border border-neutral-200 rounded-lg p-2 bg-neutral-50 transition-colors">
                        <p class="text-[10px] text-neutral-500 mt-2">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>

                    <div>
                        <label for="image_path" class="block text-xs font-bold text-neutral-700 mb-1.5">Atau Path Gambar</label>
                        <input type="text" name="image_path" id="image_path" value="{{ old('image_path', $product->image_path) }}" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                    </div>
                </div>

                @if($product->image_path)
                    <div class="mt-2">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 mb-2">Gambar Saat Ini:</p>
                        <div class="w-32 aspect-[4/3] rounded-lg overflow-hidden border border-neutral-200">
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif

                <div>
                    <label for="download_url" class="block text-xs font-bold text-neutral-700 mb-1.5">URL Download</label>
                    <input type="url" name="download_url" id="download_url" value="{{ old('download_url', $product->download_url) }}" required class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div class="pt-4 flex flex-col sm:flex-row gap-3">
                    <button type="submit" class="flex-1 btn-primary py-3.5 text-sm font-bold shadow-sm hover:shadow-md">
                        Update Katalog
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="flex-1 text-center btn-outline py-3.5 text-sm font-bold">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

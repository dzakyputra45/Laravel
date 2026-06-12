@extends('layouts.app')

@section('title', 'Tambah Katalog — Karsa Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 md:py-16">

    <div class="max-w-3xl mx-auto">
        <div class="mb-10 animate-fade-up">
            <span class="inline-flex items-center gap-2 rounded-lg bg-neutral-100 border border-neutral-200 px-3 py-1.5 mb-4">
                <span class="h-1.5 w-1.5 rounded-full bg-neutral-900"></span>
                <span class="text-[10px] uppercase tracking-widest font-bold text-neutral-600">Admin Panel</span>
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-neutral-900">
                Tambah <span class="text-neutral-500">Katalog</span>
            </h1>
            <p class="text-neutral-500 text-sm mt-3 leading-relaxed">
                Isi data produk digital baru. Produk akan langsung muncul di katalog setelah disimpan.
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

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-xs font-bold text-neutral-700 mb-1.5">Nama Produk</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh: Minimal Workspace Icons" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div>
                    <label for="slug" class="block text-xs font-bold text-neutral-700 mb-1.5">Slug (Optional)</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="minimal-workspace-icons" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div>
                    <label for="category" class="block text-xs font-bold text-neutral-700 mb-1.5">Kategori</label>
                    <select name="category" id="category" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                        <option value="">— Pilih Kategori —</option>
                        @foreach(['Wallpapers', 'Icon Packs', 'Templates', 'UI Kits'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="description" class="block text-xs font-bold text-neutral-700 mb-1.5">Deskripsi Produk</label>
                    <textarea name="description" id="description" rows="5" required placeholder="Jelaskan isi produk digital dan manfaatnya." class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="price" class="block text-xs font-bold text-neutral-700 mb-1.5">Harga</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" step="1000" placeholder="29000" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="image" class="block text-xs font-bold text-neutral-700 mb-1.5">Upload Gambar</label>
                        <input type="file" name="image" id="image" accept="image/*" class="w-full text-xs text-neutral-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-neutral-100 file:text-neutral-700 hover:file:bg-neutral-200 border border-neutral-200 rounded-lg p-2 bg-neutral-50 transition-colors">
                    </div>

                    <div>
                        <label for="image_path" class="block text-xs font-bold text-neutral-700 mb-1.5">Atau Path Gambar</label>
                        <input type="text" name="image_path" id="image_path" value="{{ old('image_path') }}" placeholder="images/mesa_wallpaper.png" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                    </div>
                </div>

                <div>
                    <label for="download_url" class="block text-xs font-bold text-neutral-700 mb-1.5">URL Download</label>
                    <input type="url" name="download_url" id="download_url" value="{{ old('download_url') }}" required placeholder="https://example.com/downloads/product.zip" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div class="pt-4 flex flex-col sm:flex-row gap-3">
                    <button type="submit" class="flex-1 btn-primary py-3.5 text-sm font-bold shadow-sm hover:shadow-md">
                        Simpan Katalog
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

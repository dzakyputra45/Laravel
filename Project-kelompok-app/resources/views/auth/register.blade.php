@extends('layouts.app')

@section('title', 'Register — Karsa Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-20">
    <div class="max-w-sm mx-auto animate-fade-up">
        <div class="mb-10 text-center">

            <h1 class="text-3xl font-bold tracking-tight mb-2 text-neutral-900">Buat Akun Baru</h1>
            <p class="text-neutral-500 text-sm">Daftar untuk checkout dan akses riwayat order.</p>
        </div>

        <div class="clean-card p-7 rounded-xl bg-white border-neutral-100 shadow-sm">
            @if($errors->any())
                <div class="mb-5 badge-danger rounded-lg px-4 py-3 text-xs font-semibold">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-bold text-neutral-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus placeholder="John Doe" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-neutral-700 mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-neutral-700 mb-1.5">Password</label>
                    <input type="password" name="password" id="password" required placeholder="Minimal 8 karakter" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-neutral-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <button type="submit" class="w-full btn-primary py-3 text-sm font-bold mt-2">
                    Register
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-neutral-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-neutral-900 hover:underline font-bold transition-all">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection

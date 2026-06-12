@extends('layouts.app')

@section('title', 'Register — Karsa Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-20">
    <div class="max-w-sm mx-auto animate-fade-up">
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center h-14 w-14 rounded-2xl bg-neutral-900 shadow-md mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
            </div>
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

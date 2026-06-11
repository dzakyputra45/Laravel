@extends('layouts.app')

@section('title', 'Login — Karsa Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-20">
    <div class="max-w-sm mx-auto animate-fade-up">
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center h-14 w-14 rounded-2xl bg-neutral-900 shadow-md mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold tracking-tight mb-2 text-neutral-900">Selamat Datang</h1>
            <p class="text-neutral-500 text-sm">Masuk untuk melanjutkan checkout dan riwayat order.</p>
        </div>

        <div class="clean-card p-7 rounded-xl bg-white border-neutral-100 shadow-sm">
            @if($errors->any())
                <div class="mb-5 badge-danger rounded-lg px-4 py-3 text-xs font-semibold">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-bold text-neutral-700 mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-neutral-700 mb-1.5">Password</label>
                    <input type="password" name="password" id="password" required placeholder="Minimal 8 karakter" class="w-full input-clean bg-neutral-50 border-neutral-200 text-sm">
                </div>

                <label class="flex items-center gap-2.5 text-xs text-neutral-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-neutral-300 text-neutral-900 focus:ring-neutral-900">
                    Ingat saya
                </label>

                <button type="submit" class="w-full btn-primary py-3 text-sm font-bold mt-2">
                    Login
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-neutral-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-neutral-900 hover:underline font-bold transition-all">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection

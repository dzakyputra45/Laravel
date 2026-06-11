<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Karsa Studio — Premium Digital Assets')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col selection:bg-neutral-900 selection:text-white">

    <!-- Navigation -->
    <header class="glass-nav sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

            <!-- Logo -->
            <a href="{{ auth()->user()?->is_admin ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-2.5 group">
                <div class="h-8 w-8 rounded-lg bg-neutral-900 flex items-center justify-center shadow-md shadow-neutral-900/10 group-hover:shadow-neutral-900/30 transition-shadow">
                    <span class="text-white font-bold text-sm">K</span>
                </div>
                <span class="font-bold text-sm tracking-wide text-neutral-900">Karsa<span class="text-neutral-500">Studio</span></span>
            </a>

            @php
                $navActive = 'text-neutral-900 font-bold';
                $navIdle = 'text-neutral-500 hover:text-neutral-900 font-medium';
            @endphp

            <nav class="flex items-center gap-6">
                <!-- Search Bar -->
                <div class="relative hidden lg:block group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-neutral-400 group-focus-within:text-neutral-900 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Search..." class="input-clean text-xs py-2 !pl-10 pr-4 w-48 bg-neutral-50 border-neutral-200">
                </div>

                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-xs tracking-wider uppercase {{ request()->routeIs('admin.dashboard') ? $navActive : $navIdle }} transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="text-xs tracking-wider uppercase {{ request()->routeIs('admin.products.*') ? $navActive : $navIdle }} transition-colors">
                            Katalog
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="text-xs tracking-wider uppercase {{ request()->routeIs('admin.orders.*') ? $navActive : $navIdle }} transition-colors">
                            Orders
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-xs tracking-wider uppercase {{ request()->routeIs('dashboard') ? $navActive : $navIdle }} transition-colors">
                            Beranda
                        </a>
                        <a href="{{ route('store') }}" class="text-xs tracking-wider uppercase {{ request()->routeIs('store') ? $navActive : $navIdle }} transition-colors">
                            Katalog
                        </a>
                        <a href="{{ route('orders.history') }}" class="text-xs tracking-wider uppercase {{ request()->routeIs('orders.history') ? $navActive : $navIdle }} transition-colors">
                            Akun
                        </a>

                        <!-- Cart Icon -->
                        <a href="#" class="relative p-2 text-neutral-500 hover:text-neutral-900 rounded-lg hover:bg-neutral-100 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span class="absolute -top-0.5 -right-0.5 h-4 w-4 bg-neutral-900 text-white text-[9px] font-bold rounded-full flex items-center justify-center ring-2 ring-white">2</span>
                        </a>
                    @endif

                    <div class="hidden md:flex items-center gap-4 ml-2 pl-4 border-l border-neutral-200">
                        <span class="flex items-center gap-2 text-xs font-medium text-neutral-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            {{ auth()->user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs font-semibold text-neutral-500 hover:text-rose-500 transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('dashboard') }}" class="text-xs tracking-wider uppercase {{ request()->routeIs('dashboard') ? $navActive : $navIdle }} transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('store') }}" class="text-xs tracking-wider uppercase {{ request()->routeIs('store') ? $navActive : $navIdle }} transition-colors">
                        Katalog
                    </a>

                    <div class="flex items-center gap-3 ml-2 pl-4 border-l border-neutral-200">
                        <a href="{{ route('login') }}" class="text-xs font-semibold text-neutral-600 hover:text-neutral-900 transition-colors">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary text-xs py-2 px-5">
                            Sign up
                        </a>
                    </div>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-neutral-200 mt-24 bg-white">
        <div class="max-w-6xl mx-auto px-6 py-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-xs font-medium text-neutral-500">
                &copy; {{ date('Y') }} Karsa Studio. All rights reserved.
            </div>
            <div class="flex gap-8">
                <a href="#" class="text-xs font-medium text-neutral-500 hover:text-neutral-900 transition-colors">Privacy</a>
                <a href="#" class="text-xs font-medium text-neutral-500 hover:text-neutral-900 transition-colors">Terms</a>
                <a href="#" class="text-xs font-medium text-neutral-500 hover:text-neutral-900 transition-colors">Support</a>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>

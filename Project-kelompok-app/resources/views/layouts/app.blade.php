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
                <form method="GET" action="{{ route('store') }}" class="relative hidden lg:block group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-neutral-400 group-focus-within:text-neutral-900 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="input-clean text-xs py-2 !pl-10 pr-4 w-48 bg-neutral-50 border-neutral-200">
                </form>

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
                        <a href="#" id="nav-cart-icon" onclick="toggleCart(event)" class="relative p-2 text-neutral-500 hover:text-neutral-900 rounded-lg hover:bg-neutral-100 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span id="nav-cart-badge" class="absolute -top-0.5 -right-0.5 h-4 w-4 bg-neutral-900 text-white text-[9px] font-bold rounded-full flex items-center justify-center ring-2 ring-white transition-colors duration-300">0</span>
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

                    <!-- Cart Icon for Guests -->
                    <a href="#" id="nav-cart-icon-guest" onclick="toggleCart(event)" class="relative p-2 text-neutral-500 hover:text-neutral-900 rounded-lg hover:bg-neutral-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <span id="nav-cart-badge-guest" class="absolute -top-0.5 -right-0.5 h-4 w-4 bg-neutral-900 text-white text-[9px] font-bold rounded-full flex items-center justify-center ring-2 ring-white transition-colors duration-300">0</span>
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

    <!-- Cart Drawer UI -->
    <div id="cart-overlay" onclick="toggleCart()" class="fixed inset-0 bg-neutral-900/40 backdrop-blur-sm z-[90] opacity-0 pointer-events-none transition-opacity duration-300"></div>
    <div id="cart-drawer" class="fixed top-0 right-0 h-full w-full sm:w-96 bg-white z-[100] transform translate-x-full transition-transform duration-300 shadow-2xl flex flex-col">
        <div class="px-6 py-5 border-b border-neutral-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-neutral-900 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                Keranjang
            </h2>
            <button onclick="toggleCart()" class="p-2 text-neutral-400 hover:text-neutral-900 bg-neutral-50 hover:bg-neutral-100 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div id="cart-items" class="flex-1 overflow-y-auto bg-neutral-50/50">
            <!-- Items injected by JS -->
        </div>
        
        <div class="p-6 border-t border-neutral-100 bg-white">
            <button onclick="toggleCart()" class="w-full btn-outline py-2.5 text-xs font-bold">Lanjut Belanja</button>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Cart State Management
        function getCart() {
            try {
                return JSON.parse(localStorage.getItem('karsa_cart')) || [];
            } catch (e) {
                return [];
            }
        }

        function saveCart(cart) {
            localStorage.setItem('karsa_cart', JSON.stringify(cart));
            renderCart();
        }

        window.addToCart = function(event, id, name, price, imageSrc) {
            event.preventDefault();
            event.stopPropagation();
            
            const cartIcon = document.getElementById('nav-cart-icon') || document.getElementById('nav-cart-icon-guest');
            if (!cartIcon) return;

            // Save to localStorage
            const cart = getCart();
            const existingItem = cart.find(item => item.id === id);
            if (!existingItem) {
                cart.push({ id, name, price, imageSrc });
                saveCart(cart);
            }

            // Get click coordinates
            const startX = event.clientX;
            const startY = event.clientY;

            // Get cart icon coordinates
            const cartRect = cartIcon.getBoundingClientRect();
            const endX = cartRect.left + cartRect.width / 2;
            const endY = cartRect.top + cartRect.height / 2;

            // Create flying image
            const img = document.createElement('img');
            img.src = imageSrc;
            img.style.position = 'fixed';
            img.style.left = (startX - 25) + 'px';
            img.style.top = (startY - 25) + 'px';
            img.style.width = '50px';
            img.style.height = '50px';
            img.style.objectFit = 'cover';
            img.style.borderRadius = '8px';
            img.style.zIndex = '9999';
            img.style.transition = 'all 0.8s cubic-bezier(0.25, 1, 0.5, 1)';
            img.style.pointerEvents = 'none';
            img.style.boxShadow = '0 10px 25px rgba(0,0,0,0.2)';
            
            document.body.appendChild(img);

            // Trigger animation next frame
            requestAnimationFrame(() => {
                img.style.transform = 'scale(0.2)';
                img.style.left = endX + 'px';
                img.style.top = endY + 'px';
                img.style.opacity = '0.3';
            });

            // Cleanup and bump cart
            setTimeout(() => {
                img.remove();
                
                // Pop animation
                cartIcon.classList.add('scale-125');
                setTimeout(() => {
                    cartIcon.classList.remove('scale-125');
                }, 300);

                // Show toast
                showToast(existingItem ? 'Produk sudah ada di keranjang' : 'Produk ditambahkan ke keranjang!');
            }, 800);
        }

        window.removeFromCart = function(id) {
            let cart = getCart();
            cart = cart.filter(item => item.id !== id);
            saveCart(cart);
        }

        window.renderCart = function() {
            const cart = getCart();
            const badges = document.querySelectorAll('#nav-cart-badge, #nav-cart-badge-guest');
            
            badges.forEach(badge => {
                badge.innerText = cart.length;
                if (cart.length > 0) {
                    badge.classList.remove('hidden');
                    // Add a small pop effect when count changes
                    badge.classList.add('bg-emerald-500');
                    setTimeout(() => badge.classList.remove('bg-emerald-500'), 300);
                } else {
                    badge.classList.add('hidden');
                }
            });

            const cartItemsContainer = document.getElementById('cart-items');
            if (cartItemsContainer) {
                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = `
                        <div class="text-center py-10">
                            <div class="text-3xl mb-3">🛒</div>
                            <p class="text-sm font-medium text-neutral-900">Keranjang Anda kosong</p>
                            <p class="text-xs text-neutral-500 mt-1">Belum ada produk yang ditambahkan.</p>
                        </div>
                    `;
                } else {
                    cartItemsContainer.innerHTML = cart.map(item => `
                        <div class="flex items-center gap-4 p-4 border-b border-neutral-100 group">
                            <img src="${item.imageSrc}" class="w-16 h-12 object-cover rounded bg-neutral-100">
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-neutral-900 line-clamp-1">${item.name}</h4>
                                <div class="text-xs font-medium text-neutral-500 mt-0.5">Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <form action="{{ route('checkout') }}" method="POST" class="m-0 p-0">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="product_id" value="${item.id}">
                                    @auth
                                        <input type="hidden" name="customer_name" value="{{ auth()->user()->name }}">
                                        <input type="hidden" name="customer_email" value="{{ auth()->user()->email }}">
                                        <button type="submit" class="w-full text-[10px] font-bold bg-neutral-900 text-white px-3 py-1.5 rounded hover:bg-neutral-800 transition-colors text-center">Beli</button>
                                    @else
                                        <a href="{{ route('login') }}" class="block w-full text-[10px] font-bold bg-neutral-900 text-white px-3 py-1.5 rounded hover:bg-neutral-800 transition-colors text-center">Login</a>
                                    @endauth
                                </form>
                                <button onclick="removeFromCart('${item.id}')" class="text-[10px] font-bold text-red-500 hover:text-red-600 transition-colors">Hapus</button>
                            </div>
                        </div>
                    `).join('');
                }
            }
        }

        window.toggleCart = function(event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            const drawer = document.getElementById('cart-drawer');
            const overlay = document.getElementById('cart-overlay');
            
            if (drawer.classList.contains('translate-x-full')) {
                // Open
                drawer.classList.remove('translate-x-full');
                overlay.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                // Close
                drawer.classList.add('translate-x-full');
                overlay.classList.add('opacity-0', 'pointer-events-none');
            }
        }

        window.showToast = function(message) {
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'fixed bottom-5 right-5 z-50 flex flex-col gap-2';
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            toast.className = 'bg-neutral-900 text-white px-4 py-3 rounded-lg shadow-xl text-sm font-medium flex items-center gap-3 transform translate-y-10 opacity-0 transition-all duration-300';
            toast.innerHTML = `
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                ${message}
            `;
            
            toastContainer.appendChild(toast);
            
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-10', 'opacity-0');
            });

            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Initialize Cart
        document.addEventListener('DOMContentLoaded', () => {
            renderCart();
        });
    </script>
    @yield('scripts')
</body>
</html>

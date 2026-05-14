<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Basket') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class=" text-gray-900">
    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}"
                class="text-3xl font-extrabold text-green-600 font-heading tracking-tight flex items-center group">
                <i data-lucide="shopping-basket" class="mr-2 w-8 h-8"></i>
                Basket
            </a>

            <div class="flex items-center space-x-4 text-gray-700 ">
                <a href="{{ route('home') }}" class="hover:text-green-600 transition-colors cursor-pointer">Home</a>
                <a href="{{ route('shop') }}" class="hover:text-green-600 transition-colors cursor-pointer"> All Products</a>
                @if(Auth::check() && Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-2.5 text-sm text-green-900 font-bold hover:bg-green-50 transition-colors">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 mr-3"></i> Admin Panel
                    </a>
                @endif
            </div>
            <!-- Actions -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('cart.index') }}"
                    class="relative p-2 text-gray-600 hover:text-green-600 transition-colors">
                    <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-green-600 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                </a>

                @guest
                    <a href="{{ route('login') }}"
                        class="px-6 py-2.5 bg-green-600 text-white text-sm font-bold rounded-xl hover:bg-green-700 transition-all shadow-lg shadow-green-100">Login</a>
                @endguest

                @auth
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true"
                        @mouseleave="open = false">
                        <button
                            class="flex items-center space-x-2 p-1 pl-4  rounded-2xl border border-gray-100 hover:border-green-200 transition-all">
                            <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                            <div
                                class="h-8 w-8 rounded-full bg-green-600 flex items-center justify-center text-white font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                            class="absolute right-0 mt-2 bg-white rounded-[1.5rem] shadow-2xl border py-3 z-50 overflow-hidden"
                            x-cloak>

                            <div class="px-4 py-2 border-b  mb-2">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Welcome back</p>
                                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-600 hover:bg-green-50 hover:text-green-700 transition-colors">
                                <i data-lucide="user" class="w-4 h-4 mr-3"></i> Profile
                            </a>
                            <a href="{{ route('orders.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-600 hover:bg-green-50 hover:text-green-700 transition-colors">
                                <i data-lucide="package" class="w-4 h-4 mr-3"></i> My Orders
                            </a>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center px-4 py-2.5 text-sm text-green-900 font-bold hover:bg-green-50 transition-colors">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4 mr-3"></i> Admin Panel
                                </a>
                            @endif
                            <div class="border-t  mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors text-left">
                                        <i data-lucide="log-out" class="w-4 h-4 mr-3"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-950  pt-20 pb-10 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand Info -->
                <div class="space-y-6">
                    <a href="{{ route('home') }}"
                        class="text-3xl font-extrabold text-green-500 font-heading tracking-tight flex items-center">
                        <i data-lucide="shopping-basket" class="mr-2 w-8 h-8"></i>
                        Basket
                    </a>
                    <p class=" text-sm leading-relaxed">
                        Your one-stop shop for fresh groceries, daily essentials, and household needs. Delivered fresh,
                        every single day.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center  hover:bg-green-600 hover:text-white transition-all">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center  hover:bg-green-600 hover:text-white transition-all">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center  hover:bg-green-600 hover:text-white transition-all">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-widest mb-6">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}"
                                class=" hover:text-green-500 text-sm transition-colors">Home</a></li>
                        <li><a href="{{ route('shop') }}" class=" hover:text-green-500 text-sm transition-colors">Shop
                                All</a></li>
                        <li><a href="{{ route('orders.index') }}"
                                class=" hover:text-green-500 text-sm transition-colors">My Orders</a></li>
                        <li><a href="{{ route('profile.edit') }}"
                                class=" hover:text-green-500 text-sm transition-colors">Account Settings</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-widest mb-6">Contact Us</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i data-lucide="map-pin" class="w-5 h-5 text-green-500 mr-3 flex-shrink-0"></i>
                            <span class=" text-sm">123 Grocery Lane, Fresh City, FC 45678</span>
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="phone" class="w-5 h-5 text-green-500 mr-3 flex-shrink-0"></i>
                            <span class=" text-sm">+1 (234) 567-890</span>
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="mail" class="w-5 h-5 text-green-500 mr-3 flex-shrink-0"></i>
                            <span class=" text-sm">support@basket.com</span>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-sm font-bold  uppercase tracking-widest mb-6">Newsletter</h4>
                    <p class=" text-sm mb-6">Subscribe to get updates on new products and special offers.</p>
                    <form class="relative">
                        <input type="email" placeholder="Your email"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 pl-6 pr-12 text-sm focus:ring-2 focus:ring-green-500  placeholder-gray-500">
                        <button type="button"
                            class="absolute right-2 top-2 bottom-2 px-4 bg-green-600  rounded-xl hover:bg-green-700 transition-all">
                            <i data-lucide="send" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div
                class="pt-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center text-gray-500 text-xs">
                <p>&copy; {{ date('Y') }} Basket E-commerce. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-green-500 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-green-500 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        </script>
    @endif
</body>

</html>
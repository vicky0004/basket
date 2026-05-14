<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Basket</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>

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
    </style>
</head>

<body class="0 text-gray-500">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-green-50/50">
        <div class="mb-8">
            <a href="/" class="flex items-center space-x-2">
                <i data-lucide="shopping-basket" class="w-12 h-12 text-green-600"></i>
                <span class="text-4xl font-extrabold tracking-tight text-gray-900 font-heading">Basket</span>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md px-8 py-10 bg-white rounded-md shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100 rounded-[2.5rem]">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-500">Sign in to continue to Basket.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="name@example.com"
                            class="block w-full pl-11 pr-4 py-2  border-gray-100 border-2 rounded-2xl focus:ring-green-500 focus:border-green-500 transition-all">
                    </div>
                    @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs font-bold text-green-600 hover:text-green-700">Forgot Password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <input id="password" type="password" name="password" required placeholder="••••••••"
                            class="block w-full pl-11 pr-4 py-2 border-gray-100 border-2 rounded-2xl focus:ring-green-500 focus:border-green-500 transition-all">
                    </div>
                    @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded-lg border-gray-300 text-green-600 shadow-sm focus:ring-green-500 h-5 w-5 transition-all">
                    <label for="remember_me" class="ml-3 text-sm font-medium text-gray-600">Keep me logged in</label>
                </div>

                <div>
                    <button type="submit"
                        class="w-full py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition-all shadow-xl shadow-green-100 flex items-center justify-center">
                        Sign In
                        <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-sm text-gray-500 font-medium">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-green-600 font-bold hover:underline ml-1">Create
                        Account</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
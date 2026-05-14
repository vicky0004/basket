<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Basket</title>

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
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-green-50/50">
        <div class="mb-6">
            <a href="/" class="flex items-center space-x-2">
                <i data-lucide="shopping-basket" class="w-12 h-12 text-green-600"></i>
                <span class="text-4xl font-extrabold tracking-tight text-gray-900 font-heading">Basket</span>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md px-8 py-10 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100 rounded-[2.5rem]">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                <p class="text-gray-500">Join Basket for a fresh shopping experience.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                    <div class="relative">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            placeholder="John Doe"
                            class="block w-full pl-11 pr-4 py-2  border-gray-100 border-2 rounded-2xl focus:ring-green-500 focus:border-green-500 transition-all">
                    </div>
                    @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            placeholder="name@example.com"
                            class="block w-full pl-11 pr-4 py-2  border-gray-100 border-2 rounded-2xl focus:ring-green-500 focus:border-green-500 transition-all">
                    </div>
                    @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required placeholder="••••••••"
                            class="block w-full pl-11 pr-4 py-2  border-gray-100 border-2 rounded-2xl focus:ring-green-500 focus:border-green-500 transition-all">
                    </div>
                    @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm
                        Password</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            placeholder="••••••••"
                            class="block w-full pl-11 pr-4 py-2  border-gray-100 border-2 rounded-2xl focus:ring-green-500 focus:border-green-500 transition-all">
                    </div>
                    @error('password_confirmation') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition-all shadow-xl shadow-green-100 flex items-center justify-center">
                        Create Account
                        <i data-lucide="user-plus" class="ml-2 w-5 h-5"></i>
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-sm text-gray-500 font-medium">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline ml-1">Sign In</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
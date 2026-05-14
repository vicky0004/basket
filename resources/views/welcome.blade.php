<x-user-layout>
    <!-- Hero Section -->
    <section class="relative bg-white pt-12 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="z-10">
                <span
                    class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-green-700 uppercase bg-green-100 rounded-full">Fastest
                    Delivery in 10 Mins</span>
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-tight mb-6 font-heading">
                    Freshness <span class="text-green-600">Delivered</span> to Your Door.
                </h1>
                <p class="text-lg text-gray-600 mb-10 max-w-lg leading-relaxed">
                    Order fresh vegetables, fruits, dairy and daily essentials from the comfort of your home with our
                    premium grocery service.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('shop') }}"
                        class="px-8 py-4 bg-green-600 text-white text-lg font-bold rounded-2xl hover:bg-green-700 transition-all shadow-xl shadow-green-100 flex items-center justify-center">
                        Shop Now
                        <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                    </a>
                    <a href="{{ route('shop') }}"
                        class="px-8 py-4 bg-gray-900 text-white text-lg font-bold rounded-2xl hover:bg-black transition-all flex items-center justify-center">
                        View Offers
                    </a>
                </div>
            </div>
            <div class="relative">
                <div
                    class="absolute -top-20 -right-20 w-96 h-96 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse">
                </div>
                <div
                    class="absolute -bottom-20 -left-20 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse delay-700">
                </div>
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=1000"
                    alt="Groceries"
                    class="relative z-10 rounded-[3rem] shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500 border-8 border-white">
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-20 ">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 font-heading">Shop by Category</h2>
                <a href="{{ route('shop') }}" class="text-green-600 font-bold flex items-center hover:underline">
                    View All <i data-lucide="chevron-right" class="ml-1 w-4 h-4"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('shop', ['category' => $category->slug]) }}"
                        class="group bg-white p-4 rounded-3xl border border-gray-100 text-center hover:shadow-xl hover:border-green-200 hover:-translate-y-1 transition-all">
                        <div
                            class="w-16 h-16 mx-auto mb-3  rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:bg-green-50 transition-all">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="w-10 h-10 object-contain">
                            @else
                                <i data-lucide="apple" class="w-8 h-8 text-green-500"></i>
                            @endif
                        </div>
                        <span class="text-xs font-bold text-gray-800">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 font-heading">Featured Selection</h2>
                <div class="flex space-x-2">
                    <button class="p-2 rounded-full border border-gray-200 hover: transition-colors"><i
                            data-lucide="chevron-left" class="w-5 h-5"></i></button>
                    <button class="p-2 rounded-full border border-gray-200 hover: transition-colors"><i
                            data-lucide="chevron-right" class="w-5 h-5"></i></button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                    <div
                        class="group bg-white rounded-[2rem] border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <div class="relative aspect-square overflow-hidden ">
                            <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=500' }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @if($product->discount_price)
                                <span
                                    class="absolute top-4 left-4 bg-green-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">Special
                                    Deal</span>
                            @endif
                            <button
                                class="absolute top-4 right-4 p-2 bg-white/80 backdrop-blur rounded-full text-gray-400 hover:text-green-500 transition-colors opacity-0 group-hover:opacity-100">
                                <i data-lucide="heart" class="w-5 h-5"></i>
                            </button>
                        </div>
                        <div class="p-6">
                            <span
                                class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 block">{{ $product->category->name }}</span>
                            <h3 class="font-bold text-gray-900 mb-2 truncate group-hover:text-green-600 transition-colors">
                                {{ $product->name }}</h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    @if($product->discount_price)
                                        <span
                                            class="text-xl font-extrabold text-gray-900">₹{{ $product->discount_price }}</span>
                                        <span class="text-sm text-gray-400 line-through ml-2">₹{{ $product->price }}</span>
                                    @else
                                        <span class="text-xl font-extrabold text-gray-900">₹{{ $product->price }}</span>
                                    @endif
                                </div>
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="p-3 bg-green-600 text-white rounded-2xl hover:bg-green-700 transition-all shadow-lg shadow-green-100">
                                        <i data-lucide="plus" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-user-layout>
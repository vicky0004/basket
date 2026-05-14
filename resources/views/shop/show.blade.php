<x-user-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                <!-- Gallery -->
                <div class="space-y-4">
                    <div class="aspect-square rounded-[3rem] overflow-hidden  border border-gray-100 shadow-sm">
                        <img id="main-image"
                            src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=1000' }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product->images as $image)
                            <div
                                class="aspect-square rounded-2xl overflow-hidden  cursor-pointer hover:ring-2 ring-green-500 transition-all">
                                <img src="{{ asset('storage/' . $image->image) }}"
                                    onclick="document.getElementById('main-image').src=this.src"
                                    class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-8">
                    <div>
                        <span
                            class="inline-block px-4 py-1.5 mb-4 text-xs font-bold tracking-widest text-green-700 uppercase bg-green-100 rounded-full">{{ $product->category->name }}</span>
                        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 font-heading">
                            {{ $product->name }}</h1>
                        <div class="flex items-center space-x-4 mb-6">
                            @if($product->discount_price)
                                <span class="text-4xl font-extrabold text-gray-900">₹{{ $product->discount_price }}</span>
                                <span class="text-xl text-gray-400 line-through">₹{{ $product->price }}</span>
                                <span class="px-3 py-1 bg-red-100 text-red-600 text-xs font-bold rounded-full">SAVE
                                    ₹{{ $product->price - $product->discount_price }}</span>
                            @else
                                <span class="text-4xl font-extrabold text-gray-900">₹{{ $product->price }}</span>
                            @endif
                        </div>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            {{ $product->description ?? 'No description available for this product.' }}
                        </p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Availability:</span>
                            @if($product->stock > 0)
                                <span class="text-green-600 font-bold flex items-center">
                                    <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i> In Stock ({{ $product->stock }}
                                    units)
                                </span>
                            @else
                                <span class="text-red-600 font-bold flex items-center">
                                    <i data-lucide="x-circle" class="w-4 h-4 mr-1"></i> Out of Stock
                                </span>
                            @endif
                        </div>
                    </div>

                    <div
                        class="pt-8 border-t border-gray-100 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" {{ $product->stock <= 0 ? 'disabled' : '' }}
                                class="w-full px-8 py-5 bg-green-600 text-white text-lg font-bold rounded-2xl hover:bg-green-700 transition-all shadow-xl shadow-green-100 flex items-center justify-center disabled:opacity-50">
                                <i data-lucide="shopping-bag" class="mr-2 w-6 h-6"></i>
                                Add to Basket
                            </button>
                        </form>
                        <button
                            class="p-5 border border-gray-100 rounded-2xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all">
                            <i data-lucide="heart" class="w-6 h-6"></i>
                        </button>
                    </div>

                    <!-- Features -->
                    <div class="grid grid-cols-2 gap-6 pt-12 border-t border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="p-3  rounded-xl text-green-600">
                                <i data-lucide="truck" class="w-5 h-5"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-600">Free delivery over ₹500</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="p-3  rounded-xl text-green-600">
                                <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-600">Easy returns within 7 days</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
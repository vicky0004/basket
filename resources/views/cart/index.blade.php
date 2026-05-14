<x-user-layout>
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8 font-heading">Shopping Cart</h1>

            @if($cart->items->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-6">
                        @foreach($cart->items as $item)
                            <div
                                class="bg-white p-6 rounded-[2rem] border border-gray-100 flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 hover:shadow-xl transition-all">
                                <div class="w-24 h-24 rounded-2xl overflow-hidden  flex-shrink-0">
                                    <img src="{{ $item->product->thumbnail ? asset('storage/' . $item->product->thumbnail) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=200' }}"
                                        alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 text-lg">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-400 mb-2">{{ $item->product->category->name }}</p>
                                    <p class="text-xl font-extrabold text-green-600">
                                        ₹{{ $item->product->discount_price ?? $item->product->price }}</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <form action="{{ route('cart.update', $item) }}" method="POST"
                                        class="flex items-center  rounded-xl border border-gray-100">
                                        @csrf
                                        @method('PATCH')
                                        <button name="quantity" value="{{ $item->quantity - 1 }}" {{ $item->quantity <= 1 ? 'disabled' : '' }}
                                            class="p-2 text-gray-400 hover:text-green-600 disabled:opacity-30">
                                            <i data-lucide="minus" class="w-4 h-4"></i>
                                        </button>
                                        <span class="px-4 py-2 font-bold text-gray-900">{{ $item->quantity }}</span>
                                        <button name="quantity" value="{{ $item->quantity + 1 }}"
                                            class="p-2 text-gray-400 hover:text-green-600">
                                            <i data-lucide="plus" class="w-4 h-4"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-3 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-colors">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 sticky top-28">
                            <h2 class="text-2xl font-bold mb-6 font-heading">Order Summary</h2>
                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span
                                        class="font-bold text-gray-900">₹{{ number_format($cart->items->sum(fn($i) => ($i->product->discount_price ?? $i->product->price) * $i->quantity), 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Delivery Fee</span>
                                    <span class="text-green-600 font-bold uppercase">Free</span>
                                </div>
                                <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900">Total</span>
                                    <span
                                        class="text-3xl font-extrabold text-green-600">₹{{ number_format($cart->items->sum(fn($i) => ($i->product->discount_price ?? $i->product->price) * $i->quantity), 2) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout.index') }}"
                                class="w-full block text-center px-8 py-4 bg-green-600 text-white text-lg font-bold rounded-2xl hover:bg-green-700 transition-all shadow-xl shadow-green-100">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-gray-200">
                    <div class="w-24 h-24  rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="shopping-bag" class="w-12 h-12 text-gray-300"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                    <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('shop') }}"
                        class="inline-block px-8 py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition-all">Start
                        Shopping</a>
                </div>
            @endif
        </div>
    </div>
</x-user-layout>
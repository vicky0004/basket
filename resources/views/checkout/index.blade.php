<x-user-layout>
    <div class="py-12 " x-data="{ 
        addressMode: '{{ auth()->user()->addresses->count() > 0 ? 'saved' : 'new' }}',
        selectedAddressId: '{{ auth()->user()->addresses->first()?->id ?? '' }}',
        addresses: {{ auth()->user()->addresses->toJson() }}
    }">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8 font-heading">Checkout</h1>
            
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="address_mode" :value="addressMode">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Delivery Details -->
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                            <div class="flex items-center justify-between mb-8">
                                <h2 class="text-2xl font-bold font-heading flex items-center">
                                    <i data-lucide="map-pin" class="w-6 h-6 mr-3 text-green-600"></i>
                                    Delivery Address
                                </h2>
                                @if(auth()->user()->addresses->count() > 0)
                                    <div class="flex bg-gray-100 p-1 rounded-xl">
                                        <button type="button" @click="addressMode = 'saved'" :class="addressMode === 'saved' ? 'bg-white shadow-sm' : 'text-gray-500'" class="px-4 py-2 rounded-lg text-xs font-bold transition-all">Saved</button>
                                        <button type="button" @click="addressMode = 'new'" :class="addressMode === 'new' ? 'bg-white shadow-sm' : 'text-gray-500'" class="px-4 py-2 rounded-lg text-xs font-bold transition-all">New</button>
                                    </div>
                                @endif
                            </div>

                            <!-- Saved Addresses Selection -->
                            <div x-show="addressMode === 'saved'" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach(auth()->user()->addresses as $address)
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="address_id" value="{{ $address->id }}" x-model="selectedAddressId" class="hidden">
                                        <div :class="selectedAddressId == {{ $address->id }} ? 'border-green-500 bg-green-50' : 'border-gray-100 bg-white'" class="p-6 rounded-[1.5rem] border-2 transition-all hover:border-green-200">
                                            <div class="flex justify-between items-start mb-2">
                                                <p class="font-bold text-gray-900">{{ $address->name }}</p>
                                                <div x-show="selectedAddressId == {{ $address->id }}" class="text-green-600">
                                                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500">{{ $address->address_line_1 }}</p>
                                            <p class="text-[10px] text-gray-400 mt-1">{{ $address->city }}, {{ $address->state }} {{ $address->zip_code }}</p>
                                            <p class="text-xs text-gray-700 mt-2 font-bold">{{ $address->phone }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <!-- New Address Form -->
                            <div x-show="addressMode === 'new'" class="space-y-6" x-cloak>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Receiver Name</label>
                                        <input type="text" name="name" :required="addressMode === 'new'" class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number</label>
                                        <input type="text" name="phone" :required="addressMode === 'new'" class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                                        <input type="text" name="address_line_1" :required="addressMode === 'new'" class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" name="city" :required="addressMode === 'new'" class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                        <input type="text" name="state" :required="addressMode === 'new'" class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Zip Code</label>
                                        <input type="text" name="zip_code" :required="addressMode === 'new'" class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                            <h2 class="text-2xl font-bold mb-6 font-heading flex items-center">
                                <i data-lucide="credit-card" class="w-6 h-6 mr-3 text-green-600"></i>
                                Payment Method
                            </h2>
                            <div class="flex items-center p-4 border-2 border-green-600 bg-green-50 rounded-2xl cursor-pointer">
                                <input type="radio" name="payment_method" value="COD" checked class="text-green-600 focus:ring-green-500 h-5 w-5 mr-4">
                                <div>
                                    <p class="font-bold text-gray-900">Cash on Delivery (COD)</p>
                                    <p class="text-xs text-green-700">Pay when you receive the order</p>
                                </div>
                                <i data-lucide="truck" class="ml-auto w-6 h-6 text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 sticky top-28 shadow-sm">
                            <h2 class="text-2xl font-bold mb-6 font-heading">In Your Basket</h2>
                            <div class="space-y-4 mb-8 max-h-64 overflow-y-auto pr-2">
                                @foreach($cart->items as $item)
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 rounded-lg  overflow-hidden flex-shrink-0">
                                            <img src="{{ $item->product->thumbnail ? asset('storage/' . $item->product->thumbnail) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=100' }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 truncate">{{ $item->product->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $item->quantity }} x ₹{{ $item->product->discount_price ?? $item->product->price }}</p>
                                        </div>
                                        <p class="text-sm font-bold text-gray-900">₹{{ ($item->product->discount_price ?? $item->product->price) * $item->quantity }}</p>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="border-t border-gray-100 pt-6 space-y-4 mb-8">
                                <div class="flex justify-between items-center text-gray-500">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-gray-900">₹{{ number_format($cart->items->sum(fn($i) => ($i->product->discount_price ?? $i->product->price) * $i->quantity), 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center text-gray-500">
                                    <span>Delivery</span>
                                    <span class="text-green-600 font-bold uppercase">Free</span>
                                </div>
                                <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900">Total</span>
                                    <span class="text-3xl font-extrabold text-green-600">₹{{ number_format($cart->items->sum(fn($i) => ($i->product->discount_price ?? $i->product->price) * $i->quantity), 2) }}</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full px-8 py-4 bg-green-600 text-white text-lg font-bold rounded-2xl hover:bg-green-700 transition-all shadow-xl shadow-green-100 flex items-center justify-center">
                                Place Order
                                <i data-lucide="check-circle-2" class="ml-2 w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-user-layout>

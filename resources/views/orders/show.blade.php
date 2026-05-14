<x-user-layout>
    <div class="py-12  min-h-screen">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white rounded-[3rem] border border-gray-100 shadow-xl overflow-hidden">
                <!-- Header (Reduced Size) -->
                <div class="p-6 md:p-8 text-center bg-green-600 text-white">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="check" class="w-8 h-8 text-white"></i>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold mb-2 font-heading">Order #{{ $order->order_number }}
                    </h1>
                    <p class="text-green-100 text-sm md:text-base">Order Status: <span
                            class="font-bold underline">{{ $order->status }}</span></p>
                </div>

                <div class="p-8 md:p-12 space-y-12">
                    <!-- Progress Bar (Simple) -->
                    <div class="flex items-center justify-between relative px-4">
                        <div class="absolute h-1 bg-gray-100 left-8 right-8 top-1/2 -translate-y-1/2 z-0"></div>
                        <div class="absolute h-1 bg-green-500 left-8 top-1/2 -translate-y-1/2 z-0 transition-all"
                            style="width: {{ $order->status == 'Pending' ? '0%' : ($order->status == 'Confirmed' ? '33%' : ($order->status == 'Shipped' ? '66%' : '100%')) }}">
                        </div>

                        @foreach(['Pending', 'Confirmed', 'Shipped', 'Delivered'] as $index => $status)
                            <div class="relative z-10 flex flex-col items-center">
                                <div
                                    class="w-8 h-8 rounded-full {{ ($order->status == $status || ($index < array_search($order->status, ['Pending', 'Confirmed', 'Shipped', 'Delivered']))) ? 'bg-green-600' : 'bg-gray-200' }} flex items-center justify-center transition-colors">
                                    <i data-lucide="check" class="w-4 h-4 text-white"></i>
                                </div>
                                <span
                                    class="text-[10px] font-bold mt-2 uppercase tracking-tighter text-gray-400">{{ $status }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Delivery Address (Added) -->
                    <div class=" rounded-[2rem] p-8 border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <i data-lucide="truck" class="w-5 h-5 mr-3 text-green-600"></i>
                            Delivery Address
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Receiver</p>
                                <p class="font-bold text-gray-900">{{ $order->name }}</p>
                                <p class="text-gray-500 text-sm">{{ $order->phone }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Shipping to
                                </p>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    {{ $order->address_line_1 }}<br>
                                    @if($order->address_line_2) {{ $order->address_line_2 }}<br> @endif
                                    {{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Items -->
                    <div>
                        <h2 class="text-xl font-bold mb-6 font-heading">Basket Items</h2>
                        <div class="divide-y divide-gray-100 border-t border-gray-100">
                            @foreach($order->items as $item)
                                <div class="py-6 flex items-center space-x-6">
                                    <div
                                        class="w-16 h-16 rounded-2xl  overflow-hidden flex-shrink-0 border border-gray-100">
                                        <img src="{{ $item->product->thumbnail ? asset('storage/' . $item->product->thumbnail) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=100' }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} x ₹{{ $item->price }}
                                        </p>
                                    </div>
                                    <p class="font-bold text-gray-900">₹{{ $item->quantity * $item->price }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class=" p-6 rounded-[1.5rem] border border-gray-100">
                            <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Payment Method
                            </h2>
                            <p class="font-bold text-gray-900 mb-1">{{ $order->payment_method }}</p>
                            <p
                                class="text-xs font-bold {{ $order->payment_status == 'Paid' ? 'text-green-600' : 'text-orange-500' }} uppercase">
                                {{ $order->payment_status }}
                            </p>
                        </div>
                        <div class="bg-green-600 p-8 rounded-[1.5rem] text-white shadow-lg shadow-green-100">
                            <div class="flex justify-between items-center">
                                <span class="font-bold opacity-80">Total Amount</span>
                                <span
                                    class="text-3xl font-extrabold">₹{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 pt-8 border-t border-gray-100">
                        <a href="{{ route('orders.index') }}"
                            class="px-8 py-4 bg-gray-100 text-gray-700 font-bold rounded-2xl hover:bg-gray-200 transition-all text-center flex-1">My
                            Orders</a>
                        <a href="{{ route('home') }}"
                            class="px-8 py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition-all text-center flex-1">Continue
                            Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
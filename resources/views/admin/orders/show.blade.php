<x-admin-layout>
    <div class="p-6">
        <div class="flex items-center space-x-4 mb-8">
            <a href="{{ route('admin.orders.index') }}"
                class="p-2 bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-green-600 shadow-sm transition-all">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->order_number }}</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Order Items -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b  flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-900">Order Items</h2>
                        <span
                            class="px-4 py-1.5 bg-green-50 text-green-700 text-xs font-bold rounded-full uppercase">{{ $order->status }}</span>
                    </div>
                    <div class="p-8 space-y-6">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center space-x-6">
                                    <div
                                        class="w-20 h-20  rounded-2xl overflow-hidden flex-shrink-0 border border-gray-100">
                                        <img src="{{ $item->product->thumbnail ? asset('storage/' . $item->product->thumbnail) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=200' }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 group-hover:text-green-600 transition-colors">
                                            {{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-400">₹{{ $item->price }} x {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900 text-lg">
                                        ₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-8  border-t border-gray-100 flex justify-between items-center">
                        <span class="text-gray-500 font-medium">Order Total Amount</span>
                        <span
                            class="text-3xl font-extrabold text-green-600">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Delivery Address</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-green-50 rounded-2xl text-green-600">
                                <i data-lucide="user" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Receiver</p>
                                <p class="font-bold text-gray-900 text-lg">{{ $order->name }}</p>
                                <p class="text-gray-500">{{ $order->phone }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-green-50 rounded-2xl text-green-600">
                                <i data-lucide="map-pin" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Shipping
                                    Address</p>
                                <p class="font-bold text-gray-900">{{ $order->address_line_1 }}</p>
                                <p class="text-gray-500">{{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Status & Customer -->
            <div class="space-y-8">
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Update Status</h2>
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <select name="status"
                            class="w-full rounded-2xl border-gray-100  py-4 focus:ring-green-500 focus:border-green-500 transition-all font-bold text-gray-700">
                            @foreach(['Pending', 'Confirmed', 'Shipped', 'Delivered', 'Cancelled'] as $status)
                                <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ $status }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="w-full py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition-all shadow-xl shadow-green-100">Update
                            Order Status</button>
                    </form>
                </div>

                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Customer Details</h2>
                    <div class="flex items-center space-x-4 mb-6 pb-6 border-b ">
                        <div
                            class="h-16 w-16 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-2xl font-bold">
                            {{ substr($order->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">{{ $order->user->name }}</h3>
                            <p class="text-sm text-gray-500">Customer since
                                {{ $order->user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Email</span>
                            <span class="font-bold text-gray-900">{{ $order->user->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Payment Method</span>
                            <span class="font-bold text-gray-900 uppercase">{{ $order->payment_method }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
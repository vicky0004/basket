<x-user-layout>
    <div class="py-12  min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-900 font-heading">My Orders</h1>
                    <p class="text-gray-500">Track and manage your previous purchases.</p>
                </div>
            </div>

            @if($orders->count() > 0)
                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class=" text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                                <tr>
                                    <th class="px-8 py-5">Order ID</th>
                                    <th class="px-8 py-5">Date</th>
                                    <th class="px-8 py-5">Status</th>
                                    <th class="px-8 py-5">Total</th>
                                    <th class="px-8 py-5 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($orders as $order)
                                    <tr class="hover: transition-colors group">
                                        <td class="px-8 py-6">
                                            <span class="font-bold text-gray-900">#{{ $order->order_number }}</span>
                                        </td>
                                        <td class="px-8 py-6 text-sm text-gray-500">
                                            {{ $order->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-8 py-6">
                                            <span
                                                class="px-3 py-1 text-[10px] font-bold rounded-full 
                                                                        @if($order->status == 'Pending') bg-orange-100 text-orange-600
                                                                        @elseif($order->status == 'Delivered') bg-green-100 text-green-600
                                                                        @elseif($order->status == 'Cancelled') bg-red-100 text-red-600
                                                                        @else bg-blue-100 text-blue-600 @endif uppercase tracking-wider">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 text-sm font-bold text-gray-900">
                                            ₹{{ number_format($order->total_amount, 2) }}
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <a href="{{ route('orders.show', $order) }}"
                                                class="inline-flex items-center px-4 py-2 bg-white border-2 border-gray-100 rounded-xl text-sm font-bold text-gray-700 hover:bg-green-600 hover:text-white hover:border-green-600 transition-all">
                                                View Details
                                                <i data-lucide="eye" class="ml-2 w-4 h-4"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($orders->hasPages())
                        <div class="px-8 py-6 border-t ">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-gray-200">
                    <div class="w-24 h-24  rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="package" class="w-12 h-12 text-gray-300"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">No orders yet</h2>
                    <p class="text-gray-500 mb-8">You haven't placed any orders with us yet.</p>
                    <a href="{{ route('shop') }}"
                        class="inline-block px-8 py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition-all">Go
                        to Shop</a>
                </div>
            @endif
        </div>
    </div>
</x-user-layout>
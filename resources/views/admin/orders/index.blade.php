<x-admin-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Manage Orders</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class=" text-gray-400 text-xs uppercase tracking-widest font-bold">
                        <tr>
                            <th class="px-6 py-4">Order ID</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($orders as $order)
                            <tr class="hover: transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-900">#{{ $order->order_number }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-900">₹{{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-[10px] font-bold rounded-full 
                                        @if($order->status == 'Pending') bg-orange-100 text-orange-600
                                        @elseif($order->status == 'Delivered') bg-green-100 text-green-600
                                        @elseif($order->status == 'Cancelled') bg-red-100 text-red-600
                                        @else bg-blue-100 text-blue-600 @endif uppercase tracking-wider">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-xl text-xs font-bold hover:bg-green-100 transition-all">
                                        View Details
                                        <i data-lucide="eye" class="ml-2 w-4 h-4"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t ">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-500">Welcome back, Admin. Here's what's happening today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-4 bg-blue-50 rounded-xl mr-4">
                <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Users</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-4 bg-green-50 rounded-xl mr-4">
                <i data-lucide="package" class="w-6 h-6 text-green-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Products</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-4 bg-orange-50 rounded-xl mr-4">
                <i data-lucide="shopping-cart" class="w-6 h-6 text-orange-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Orders</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-4 bg-purple-50 rounded-xl mr-4">
                <i data-lucide="indian-rupee" class="w-6 h-6 text-purple-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
                <p class="text-2xl font-bold text-gray-900">₹{{ number_format($stats['revenue'], 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">Recent Orders</h2>
            <a href="{{ route('admin.orders.index') }}"
                class="text-sm font-semibold text-green-600 hover:text-green-700">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class=" text-gray-500 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($stats['recent_orders'] as $order)
                        <tr class="hover: transition-colors">
                            <td class="px-6 py-4 font-semibold">#{{ $order->order_number }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div
                                        class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center mr-3 text-xs font-bold text-gray-600">
                                        {{ substr($order->user->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $order->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                ₹{{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full 
                                    @if($order->status == 'Pending') bg-orange-100 text-orange-600
                                    @elseif($order->status == 'Delivered') bg-green-100 text-green-600
                                    @elseif($order->status == 'Cancelled') bg-red-100 text-red-600
                                    @else bg-blue-100 text-blue-600 @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                    class="p-2 text-gray-400 hover:text-green-600">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
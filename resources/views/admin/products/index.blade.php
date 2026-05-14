<x-admin-layout>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Products</h1>
            <p class="text-gray-500">Manage your grocery inventory.</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition ease-in-out duration-150">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add Product
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class=" text-gray-500 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Product</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Stock</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($products as $product)
                        <tr class="hover: transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                            class="w-12 h-12 rounded-lg object-cover mr-3">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 mr-3">
                                            <i data-lucide="package" class="w-6 h-6"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-500">SKU: {{ $product->sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-600">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    @if($product->discount_price)
                                        <p class="font-bold text-gray-900">₹{{ $product->discount_price }}</p>
                                        <p class="text-xs text-gray-400 line-through">₹{{ $product->price }}</p>
                                    @else
                                        <p class="font-bold text-gray-900">₹{{ $product->price }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="text-sm font-medium {{ $product->stock < 10 ? 'text-red-600 font-bold' : 'text-gray-600' }}">
                                    {{ $product->stock }} units
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col space-y-1">
                                    <span
                                        class="px-3 py-1 text-[10px] font-bold rounded-full w-fit {{ $product->status ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                    @if($product->featured)
                                        <span
                                            class="px-3 py-1 text-[10px] font-bold rounded-full w-fit bg-purple-100 text-purple-600">
                                            Featured
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right flex justify-end space-x-2 pt-6">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="p-2 text-blue-400 hover:text-blue-600">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 hover:text-red-600">
                                        <i data-lucide="trash" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $products->links() }}
        </div>
    </div>
</x-admin-layout>
<x-user-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-12">
                <!-- Filters Sidebar -->
                <aside class="w-full md:w-64 flex-shrink-0 space-y-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4 font-heading">Categories</h3>
                        <div class="space-y-2">
                            <a href="{{ route('shop') }}"
                                class="block px-4 py-2 rounded-xl text-sm font-medium {{ !request('category') ? 'bg-green-50 text-green-700 font-bold' : 'text-gray-600 hover:' }}">All
                                Categories</a>
                            @foreach($categories as $category)
                                <a href="{{ route('shop', ['category' => $category->slug]) }}"
                                    class="block px-4 py-2 rounded-xl text-sm font-medium {{ request('category') == $category->slug ? 'bg-green-50 text-green-700 font-bold' : 'text-gray-600 hover:' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-4 font-heading">Price Range</h3>
                        <form action="{{ route('shop') }}" method="GET" class="space-y-4">
                            @if(request('category')) <input type="hidden" name="category"
                            value="{{ request('category') }}"> @endif
                            <div class="flex space-x-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}"
                                    placeholder="Min" class="w-full rounded-xl border-gray-200 text-sm">
                                <input type="number" name="max_price" value="{{ request('max_price') }}"
                                    placeholder="Max" class="w-full rounded-xl border-gray-200 text-sm">
                            </div>
                            <button type="submit"
                                class="w-full py-3 bg-gray-900 text-white rounded-xl text-sm font-bold hover:bg-black transition-all">Apply
                                Filter</button>
                        </form>
                    </div>
                </aside>

                <!-- Product Grid -->
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-8">
                        <h1 class="text-3xl font-extrabold text-gray-900 font-heading">
                            @if(request('category'))
                                {{ $categories->firstWhere('slug', request('category'))->name }}
                            @elseif(request('search'))
                                Search results for "{{ request('search') }}"
                            @else
                                All Products
                            @endif
                        </h1>
                        <span class="text-sm text-gray-500">{{ $products->total() }} items found</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($products as $product)
                            <div
                                class="group bg-white rounded-[2rem] border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                                <a href="{{ route('product.show', $product->slug) }}"
                                    class="relative block aspect-square overflow-hidden ">
                                    <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=500' }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </a>
                                <div class="p-6">
                                    <span
                                        class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 block">{{ $product->category->name }}</span>
                                    <h3
                                        class="font-bold text-gray-900 mb-2 truncate hover:text-green-600 transition-colors">
                                        <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            @if($product->discount_price)
                                                <span
                                                    class="text-xl font-extrabold text-gray-900">₹{{ $product->discount_price }}</span>
                                                <span
                                                    class="text-sm text-gray-400 line-through ml-2">₹{{ $product->price }}</span>
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

                    <div class="mt-12">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
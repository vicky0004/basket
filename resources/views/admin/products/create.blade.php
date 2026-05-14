<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Add Product</h1>
        <p class="text-gray-500">List a new grocery item.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category_id" id="category_id" required class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Base Price (₹)</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500">
                        </div>
                        <div>
                            <label for="discount_price" class="block text-sm font-medium text-gray-700 mb-1">Discount Price (₹)</label>
                            <input type="number" step="0.01" name="discount_price" id="discount_price" value="{{ old('discount_price') }}" class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500">
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500">
                        </div>
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500">
                        </div>
                    </div>

                    <div>
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Main Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    </div>

                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Gallery Images (Multiple)</label>
                        <input type="file" name="images[]" id="images" multiple class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div>
                            <label for="featured" class="block text-sm font-medium text-gray-700 mb-1">Featured</label>
                            <select name="featured" id="featured" class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 border-t border-gray-100 pt-8">
                <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Cancel</a>
                <button type="submit" class="px-8 py-3 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-100">
                    Save Product
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

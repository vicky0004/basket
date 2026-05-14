<x-user-layout>
    <div class="py-12  min-h-screen" x-data="{ activeSection: 'profile', editingAddress: null }">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8 font-heading">Account Settings</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Sidebar Nav -->
                <aside class="lg:col-span-1 space-y-4">
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                        <div class="flex items-center space-x-4 mb-8">
                            <div
                                class="h-16 w-16 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-2xl font-bold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <div>
                                <h2 class="font-bold text-xl text-gray-900">{{ auth()->user()->name }}</h2>
                                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <nav class="space-y-2">
                            <button @click="activeSection = 'profile'"
                                :class="activeSection === 'profile' ? 'bg-green-50 text-green-700 font-bold' : 'text-gray-600 hover: font-medium'"
                                class="w-full flex items-center px-4 py-3 rounded-xl text-sm transition-all text-left">
                                <i data-lucide="user" class="w-5 h-5 mr-3"></i>
                                Profile Info
                            </button>
                            <button @click="activeSection = 'password'"
                                :class="activeSection === 'password' ? 'bg-green-50 text-green-700 font-bold' : 'text-gray-600 hover: font-medium'"
                                class="w-full flex items-center px-4 py-3 rounded-xl text-sm transition-all text-left">
                                <i data-lucide="lock" class="w-5 h-5 mr-3"></i>
                                Password
                            </button>
                            <button @click="activeSection = 'addresses'"
                                :class="activeSection === 'addresses' ? 'bg-green-50 text-green-700 font-bold' : 'text-gray-600 hover: font-medium'"
                                class="w-full flex items-center px-4 py-3 rounded-xl text-sm transition-all text-left">
                                <i data-lucide="map-pin" class="w-5 h-5 mr-3"></i>
                                Saved Addresses
                            </button>
                            <a href="{{ route('orders.index') }}"
                                class="flex items-center px-4 py-3 text-gray-600 hover: rounded-xl font-medium text-sm transition-all">
                                <i data-lucide="package" class="w-5 h-5 mr-3"></i>
                                Order History
                            </a>
                        </nav>
                    </div>
                </aside>

                <!-- Content -->
                <div class="lg:col-span-2">
                    <!-- Profile Section -->
                    <section x-show="activeSection === 'profile'"
                        class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-gray-100 shadow-sm">
                        <h3 class="text-2xl font-bold mb-8 font-heading">Profile Information</h3>
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                        required
                                        class="w-full rounded-2xl border-gray-100  py-4 focus:ring-green-500 focus:border-green-500 transition-all">
                                </div>
                                <div class="md:col-span-2 opacity-60">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address (Cannot
                                        be changed)</label>
                                    <input type="email" value="{{ auth()->user()->email }}" disabled
                                        class="w-full rounded-2xl border-gray-100 bg-gray-100 py-4 cursor-not-allowed">
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-8 py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition-all shadow-lg shadow-green-100">Update
                                    Profile</button>
                            </div>
                        </form>
                    </section>

                    <!-- Password Section -->
                    <section x-show="activeSection === 'password'"
                        class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-gray-100 shadow-sm" x-cloak>
                        <h3 class="text-2xl font-bold mb-8 font-heading">Change Password</h3>
                        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Current
                                        Password</label>
                                    <input type="password" name="current_password" required
                                        class="w-full rounded-2xl border-gray-100  py-4 focus:ring-green-500 focus:border-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                                    <input type="password" name="password" required
                                        class="w-full rounded-2xl border-gray-100  py-4 focus:ring-green-500 focus:border-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm New
                                        Password</label>
                                    <input type="password" name="password_confirmation" required
                                        class="w-full rounded-2xl border-gray-100  py-4 focus:ring-green-500 focus:border-green-500">
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-8 py-4 bg-gray-900 text-white font-bold rounded-2xl hover:bg-black transition-all">Change
                                    Password</button>
                            </div>
                        </form>
                    </section>

                    <!-- Addresses Section -->
                    <section x-show="activeSection === 'addresses'"
                        class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-gray-100 shadow-sm" x-cloak>
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-2xl font-bold font-heading">Saved Addresses</h3>
                            <button @click="editingAddress = 'new'"
                                class="px-4 py-2 bg-green-50 text-green-700 rounded-xl font-bold text-sm">Add
                                New</button>
                        </div>

                        <!-- Address Form (Add/Edit) -->
                        <div x-show="editingAddress"
                            class="mb-12 p-8 bg-green-50/50 rounded-3xl border border-green-100" x-cloak>
                            <h4 class="text-lg font-bold mb-6 text-green-800"
                                x-text="editingAddress === 'new' ? 'Add New Address' : 'Edit Address'"></h4>
                            <form
                                :action="editingAddress === 'new' ? '{{ route('addresses.store') }}' : '{{ url('addresses') }}/' + editingAddress.id"
                                method="POST" class="space-y-6">
                                @csrf
                                <template x-if="editingAddress !== 'new'">
                                    @method('PATCH')
                                </template>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Receiver
                                            Name</label>
                                        <input type="text" name="name" :value="editingAddress.name" required
                                            class="w-full rounded-2xl border-gray-100 bg-white py-4 focus:ring-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mobile
                                            Number</label>
                                        <input type="text" name="phone" :value="editingAddress.phone" required
                                            class="w-full rounded-2xl border-gray-100 bg-white py-4 focus:ring-green-500">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Address Line
                                            1</label>
                                        <input type="text" name="address_line_1" :value="editingAddress.address_line_1"
                                            required
                                            class="w-full rounded-2xl border-gray-100 bg-white py-4 focus:ring-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">City</label>
                                        <input type="text" name="city" :value="editingAddress.city" required
                                            class="w-full rounded-2xl border-gray-100 bg-white py-4 focus:ring-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">State</label>
                                        <input type="text" name="state" :value="editingAddress.state" required
                                            class="w-full rounded-2xl border-gray-100 bg-white py-4 focus:ring-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Zip Code</label>
                                        <input type="text" name="zip_code" :value="editingAddress.zip_code" required
                                            class="w-full rounded-2xl border-gray-100 bg-white py-4 focus:ring-green-500">
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-4">
                                    <button type="button" @click="editingAddress = null"
                                        class="px-6 py-4 font-bold text-gray-500">Cancel</button>
                                    <button type="submit"
                                        class="px-8 py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 shadow-lg shadow-green-100 transition-all"
                                        x-text="editingAddress === 'new' ? 'Save Address' : 'Update Address'"></button>
                                </div>
                            </form>
                        </div>

                        <!-- Address List -->
                        <div class="grid grid-cols-1 gap-4">
                            @foreach(auth()->user()->addresses as $address)
                                <div
                                    class="p-6 rounded-3xl border border-gray-100 bg-white hover:border-green-200 transition-all flex items-center justify-between group shadow-sm">
                                    <div class="flex items-start space-x-4">
                                        <div class="p-3  rounded-2xl text-gray-400">
                                            <i data-lucide="map-pin" class="w-6 h-6"></i>
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-gray-900">{{ $address->name }} <span
                                                    class="ml-2 text-xs font-normal text-gray-400">{{ $address->phone }}</span>
                                            </h5>
                                            <p class="text-sm text-gray-500">{{ $address->address_line_1 }},
                                                {{ $address->city }}, {{ $address->state }} {{ $address->zip_code }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button @click="editingAddress = {{ $address->toJson() }}"
                                            class="p-3 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition-colors">
                                            <i data-lucide="edit-3" class="w-5 h-5"></i>
                                        </button>
                                        <form action="{{ route('addresses.destroy', $address) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors">
                                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            @if(auth()->user()->addresses->count() == 0)
                                <div class="text-center py-12  rounded-3xl border-2 border-dashed border-gray-200">
                                    <i data-lucide="map-pin" class="w-10 h-10 text-gray-300 mx-auto mb-4"></i>
                                    <p class="text-gray-500">No addresses saved yet.</p>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-user-layout>
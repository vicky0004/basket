<x-admin-layout>
    <div class="p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Manage Users</h1>
            <p class="text-gray-500">Monitor and manage customer accounts.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class=" text-gray-400 text-xs uppercase tracking-widest font-bold">
                        <tr>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Joined At</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($users as $user)
                            <tr class="hover: transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold mr-3 uppercase">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-bold text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 text-[10px] font-bold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} uppercase tracking-wider">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.users.updateStatus', $user) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 {{ $user->status === 'active' ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600' }} rounded-xl text-xs font-bold hover:opacity-80 transition-all">
                                            {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
                                            <i data-lucide="{{ $user->status === 'active' ? 'user-minus' : 'user-check' }}"
                                                class="ml-2 w-4 h-4"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t ">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
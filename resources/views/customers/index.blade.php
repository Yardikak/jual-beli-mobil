<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <x-slot name="header">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Daftar Customer
            </h1>
        </x-slot>

        <div class="flex justify-end mb-4">
            <a href="{{ route('customers.create') }}"
               class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-300">
                Tambah Customer Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-center text-md font-semibold text-gray-700 uppercase tracking-wider">Customer Name</th>
                        <th class="px-6 py-3 text-center text-md font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-center text-md font-semibold text-gray-700 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-center text-md font-semibold text-gray-700 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-3 text-center text-md font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-center text-gray-800">{{ $customer->name }}</td>
                            <td class="px-6 py-4 text-center text-gray-600">{{ $customer->email }}</td>
                            <td class="px-6 py-4 text-center text-gray-600">{{ $customer->phone }}</td>
                            <td class="px-6 py-4 text-center text-gray-600">{{ $customer->address }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('customers.edit', $customer->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded transition duration-200">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus customer ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded transition duration-200">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada customer tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $customers->links('pagination::tailwind') }}
        </div>

    </div>
</x-layouts.app>

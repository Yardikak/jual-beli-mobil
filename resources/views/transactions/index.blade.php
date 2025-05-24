<x-layouts.app>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <x-slot name="header">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Daftar Transaksi
            </h1>
        </x-slot>

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('transactions.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                + Tambah Transaksi
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        @foreach(['Nomor Pelanggan', 'Pelanggan', 'Produk', 'Kuantitas', 'Total', 'Tanggal', 'Aksi'] as $header)
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transactions as $index => $transaction)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">{{ $transaction->customer->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">{{ $transaction->product->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">{{ $transaction->quantity }}</td>
                            <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('transactions.show', $transaction->id) }}"
                                       class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded transition">
                                        👁️ Lihat
                                    </a>
                                    <a href="{{ route('transactions.edit', $transaction->id) }}"
                                       class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded transition">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded transition">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
    </div>
</x-layouts.app>
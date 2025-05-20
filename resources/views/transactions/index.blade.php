<x-layouts.app>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <x-slot name="header">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Daftar Transaksi
            </h1>
        </x-slot>
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('transactions.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Tambah Transaksi</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Nomor</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($transactions as $index => $transaction)
                        <tr>
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3">{{ $transaction->customer->name ?? '-' }}</td>
                            <td class="p-3">{{ $transaction->product->name ?? '-' }}</td>
                            <td class="p-3">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('transactions.show', $transaction->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded transition duration-200">
                                        👁️ Lihat
                                    </a>
                                    <a href="{{ route('transactions.edit', $transaction->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded transition duration-200">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
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
                            <td colspan="6" class="p-3 text-center text-gray-500">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </div>
</x-layouts.app>
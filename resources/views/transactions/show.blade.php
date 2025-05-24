<x-layouts.app>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <x-slot name="header">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Detail Transaksi
            </h1>
        </x-slot>

        <div class="bg-white p-6 shadow rounded">
            <p class="mb-2"><strong>Pelanggan:</strong> {{ $transaction->customer->custFullN }}</p>
            <p class="mb-2"><strong>Produk:</strong> {{ $transaction->product->name }}</p>
            <p class="mb-2"><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
            <p class="mb-2"><strong>Tanggal Transaksi:</strong> {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-300 rounded">Kembali</a>
        </div>
    </div>
</x-layouts.app>
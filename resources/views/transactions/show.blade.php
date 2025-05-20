<x-layouts.app>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <h1 class="text-white text-2xl font-bold mb-6">Detail Transaksi</h1>

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
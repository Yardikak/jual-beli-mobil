<x-layouts.app>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <h1 class="text-white text-2xl font-bold mb-6">Edit Transaksi</h1>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="bg-white shadow p-6 rounded">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="customer_id" class="block font-semibold mb-1">Pelanggan</label>
                <select name="customer_id" id="customer_id" required class="w-full border rounded px-3 py-2">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $transaction->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="product_id" class="block font-semibold mb-1">Produk</label>
                <select name="product_id" id="product_id" required class="w-full border rounded px-3 py-2">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="total_price" class="block font-semibold mb-1">Total Harga</label>
                <input type="number" name="total_price" id="total_price" value="{{ $transaction->total_price }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="transaction_date" class="block font-semibold mb-1">Tanggal Transaksi</label>
                <input type="date" name="transaction_date" id="transaction_date" value="{{ $transaction->transaction_date }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</x-layouts.app>

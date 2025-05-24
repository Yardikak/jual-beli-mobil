<x-layouts.app>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <x-slot name="header">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                ✏️ Edit Transaksi
            </h1>
        </x-slot>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md p-6 rounded-lg space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">👤 Pilih Pelanggan</label>
                <select name="customer_id" id="customer_id" required
                        class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $transaction->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="product_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">📦 Pilih Produk</label>
                <select name="product_id" id="product_id" required
                        class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">🔢 Kuantitas</label>
                <input type="number" name="quantity" id="quantity" value="{{ $transaction->quantity }}" min="1" required
                        class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
            </div>

            <div>
                <label for="total_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">💰 Total Harga</label>
                <input type="number" name="total_price" id="total_price" value="{{ $transaction->total_price }}" readonly
                       class="w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white rounded-md shadow-sm px-4 py-2">
            </div>

            <div>
                <label for="transaction_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">📅 Tanggal Transaksi</label>
                <input type="date" name="transaction_date" id="transaction_date" value="{{ $transaction->transaction_date }}" required
                       class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('transactions.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    ❌ Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateTotalPrice() {
            const productSelect = document.getElementById('product_id');
            const quantityInput = document.getElementById('quantity');
            const totalPriceInput = document.getElementById('total_price');
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = selectedOption ? parseInt(selectedOption.getAttribute('data-price')) || 0 : 0;
            const quantity = parseInt(quantityInput.value) || 1;
            totalPriceInput.value = price * quantity;
        }

        document.getElementById('product_id').addEventListener('change', updateTotalPrice);
        document.getElementById('quantity').addEventListener('input', updateTotalPrice);

        window.addEventListener('DOMContentLoaded', updateTotalPrice);
    </script>
</x-layouts.app>
<x-layouts.app>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <x-slot name="header">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Tambah Transaksi
            </h1>
        </x-slot>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-white shadow">
                <strong class="font-bold">Warning!</strong>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transactions.store') }}" method="POST" class="bg-white shadow p-6 rounded">
            @csrf
            <div class="mb-4">
                <label for="customer_id" class="block font-semibold mb-1">Pelanggan</label>
                <select name="customer_id" id="customer_id" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}  ({{ $customer->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="product_id" class="block font-semibold mb-1">Produk</label>
                <select name="product_id" id="product_id" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block font-semibold mb-1">Kuantitas</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="total_price" class="block font-semibold mb-1">Total Harga</label>
                <input type="number" name="total_price" id="total_price" value="{{ old('total_price') }}" class="w-full border rounded px-3 py-2 bg-gray-100" readonly required>
            </div>

            <div class="mb-4">
                <label for="transaction_date" class="block font-semibold mb-1">Tanggal Transaksi</label>
                <input type="date" name="transaction_date" id="transaction_date" value="{{ old('transaction_date') }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
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
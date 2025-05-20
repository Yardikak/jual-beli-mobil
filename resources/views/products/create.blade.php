<x-layouts.app>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <x-slot name="header">
            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-white">
                Tambah Produk Baru
            </h1>
        </x-slot>

        <!-- Menampilkan error validasi jika ada -->
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-700 dark:text-white shadow">
                <h2 class="font-bold text-lg">Ada kesalahan:</h2>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk menambahkan produk baru -->
        <form method="POST" action="{{ route('products.store') }}" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                    placeholder="Contoh: Toyota Avanza" required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi Produk</label>
                <textarea id="description" name="description" rows="4" 
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                    placeholder="Contoh: Mobil keluarga dengan kapasitas 7 penumpang" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Produk</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" 
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                    placeholder="Contoh: 200000000" required>
            </div>

            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori Produk</label>
                <select id="category_id" name="category_id" 
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                    required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold text-lg rounded-lg shadow-lg hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
<x-layouts.app>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <x-slot name="header">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Detail Kategori
            </h1>
        </x-slot>

        <div class="mt-6 bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="p-6 md:flex md:items-start md:justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        📁 {{ $category->name }}
                    </h2>
                    <p class="text-gray-900 dark:text-gray-900 leading-relaxed">
                        {{ $category->description ? $category->description : 'Tidak ada deskripsi untuk kategori ini.' }}
                    </p>
                </div>

                <div class="mt-6 md:mt-0 md:ml-6">
                    <a href="{{ route('categories.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-gray-900  font-semibold text-sm rounded-lg transition duration-300 shadow">
                        ← Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="bg-gray-100 dark:bg-gray-800 border-t dark:border-gray-700 p-4 text-sm text-gray-500 dark:text-gray-400 text-center">
                Diperbarui pada: {{ $category->updated_at->format('d M Y, H:i') }}
            </div>
        </div>
    </div>
</x-layouts.app>

<x-layouts.app>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <x-slot name="header">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Edit Kategori
            </h1>
        </x-slot>

        <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kategori</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('name', $category->name) }}">
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('categories.index') }}"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-md shadow">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>

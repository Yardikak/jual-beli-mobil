<x-layouts.app>
    <div class="max-w-2xl mx-auto px-4 py-10">
        <x-slot name="header">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Data Pelanggan</h1>
        </x-slot>

        <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-500"
                        value="{{ old('name', $customer->name) }}">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-500"
                        value="{{ old('email', $customer->email) }}">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. Telepon</label>
                    <input type="text" name="phone" id="phone" required
                        class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-500"
                        value="{{ old('phone', $customer->phone) }}">
                    @error('phone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                    <textarea name="address" id="address" rows="3" required
                        class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-500">{{ old('address', $customer->address) }}</textarea>
                    @error('address')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('customers.index') }}"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md dark:bg-gray-700 dark:text-white">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Menyunting Pengaturan Event</h1>
        <a href="{{ route('admin.events.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center">
            &larr; Kembali
        </a>
    </div>

    <!-- Menampilkan Error Validasi -->
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 shadow-sm" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Perhatikan action route dan penambahan @method('PUT') -->
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Judul Event -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Event</label>
                    <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" 
                           value="{{ $event->title }}" required>
                </div>

                <!-- Kategori Event -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori Event</label>
                    <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" required>
                        @foreach($categories as $category)
                            <!-- Logika selected sesuai persis dengan modul -->
                            <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal & Waktu -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal & Waktu</label>
                    <!-- Menggunakan nilai langsung dari database sesuai modul -->
                    <input type="datetime-local" name="date" id="date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" 
                           value="{{ $event->date }}" required>
                </div>

                <!-- Harga Tiket -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Rencana Harga Masuk (Rp)</label>
                    <input type="number" name="price" id="price" min="0" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" 
                           value="{{ $event->price }}" required>
                </div>

                <!-- Kapasitas Stok -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Stok Kuota</label>
                    <input type="number" name="stock" id="stock" min="1" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" 
                           value="{{ $event->stock }}" required>
                </div>

                <!-- Lokasi / Gedung -->
                <div class="md:col-span-2">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi / Gedung</label>
                    <input type="text" name="location" id="location" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" 
                           value="{{ $event->location }}" required>
                </div>
                
                <!-- URL Poster (Link Gambar) -->
                <div class="md:col-span-2">
                    <label for="poster_path" class="block text-sm font-medium text-gray-700 mb-2">URL Poster (Link Gambar)</label>
                    <input type="url" name="poster_path" id="poster_path" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" 
                           value="{{ $event->poster_path }}" placeholder="https://..." required>
                </div>

                <!-- Deskripsi Pendek -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Pendek</label>
                    <!-- Pemanggilan description sesuai modul -->
                    <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" required>{{ $event->description }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow transition duration-150">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
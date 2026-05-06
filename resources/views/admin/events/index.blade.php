@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header dan Tombol Tambah -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Event</h1>
        <a href="{{ route('admin.events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
            + Tambah Event
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Tabel Data Event -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden overflow-x-auto">
        <table class="min-w-full w-full table-auto text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal border-b border-gray-200">
                    <th class="py-3 px-6 font-semibold">Judul Event</th>
                    <th class="py-3 px-6 font-semibold">Kategori</th>
                    <th class="py-3 px-6 font-semibold text-center">Tanggal</th>
                    <th class="py-3 px-6 font-semibold text-center">Aksi Pilihan</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($events as $event)
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                    <td class="py-3 px-6 whitespace-nowrap">
                        <span class="font-medium text-gray-800">{{ $event->title }}</span>
                    </td>
                    <td class="py-3 px-6">
                        <!-- Mengambil nama kategori dari relasi, jika kosong tampilkan '-' -->
                        {{ $event->category->name ?? '-' }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        <!-- Format tanggal menggunakan Carbon -->
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                    </td>
                    <td class="py-3 px-6 text-center flex justify-center space-x-2">
                        <!-- Tombol Edit -->
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-3 rounded text-xs transition duration-150">
                            Edit
                        </a>

                        <!-- Form Hapus (Menggunakan Method DELETE) -->
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded text-xs transition duration-150">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-6 px-6 text-center text-gray-500">
                        Belum ada data event yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Navigasi Pagination -->
    <div class="mt-6">
        {{ $events->links() }}
    </div>
</div>
@endsection
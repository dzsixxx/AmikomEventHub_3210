@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header dan Form Pencarian (Soal 3) -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
        
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex w-full sm:w-auto">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori..." 
                   class="w-full sm:w-64 border-gray-300 rounded-l-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-4 rounded-r-md transition duration-150">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.categories.index') }}" class="ml-2 text-red-500 flex items-center hover:underline">Reset</a>
            @endif
        </form>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 shadow-sm" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-6">
        
        <!-- Tabel Data Kategori (Soal 1) -->
        <div class="flex-1 bg-white shadow-md rounded-lg overflow-hidden overflow-x-auto">
            <table class="min-w-full w-full table-auto text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal border-b border-gray-200">
                        <th class="py-3 px-6 font-semibold">ID</th>
                        <th class="py-3 px-6 font-semibold">Nama Kategori</th>
                        <th class="py-3 px-6 font-semibold text-center">Aksi Pilihan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($categories as $category)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                        <td class="py-3 px-6 whitespace-nowrap">{{ $category->id }}</td>
                        <td class="py-3 px-6">
                            <span class="font-medium text-gray-800">{{ $category->name }}</span>
                        </td>
                        <td class="py-3 px-6 text-center flex justify-center space-x-2">
                            <!-- Tombol Edit (Membuka Modal) -->
                            <button type="button" onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}')" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-3 rounded text-xs transition duration-150">
                                Edit
                            </button>

                            <!-- Form Hapus -->
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                        <td colspan="3" class="py-6 px-6 text-center text-gray-500">
                            Belum ada data kategori yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="p-4 border-t border-gray-200">
                {{ $categories->links() }}
            </div>
        </div>

        <!-- Form Tambah Kategori (Soal 1) -->
        <div class="lg:w-1/3">
            <div class="bg-white shadow-md rounded-lg p-6 sticky top-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Tambah Kategori Baru</h2>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-150">
                        Simpan Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div id="editCatModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Menyunting Kategori</h3>
            <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 font-bold text-xl">&times;</button>
        </div>
        
        <form id="editCatForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" id="edit_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded transition duration-150">Batal</button>
                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded transition duration-150">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name) {
        // Mengubah action form sesuai dengan ID kategori yang diklik
        document.getElementById('editCatForm').action = `/admin/categories/${id}`;
        document.getElementById('edit_name').value = name;
        
        // Tampilkan modal
        document.getElementById('editCatModal').classList.remove('hidden');
        document.getElementById('editCatModal').classList.add('flex');
    }

    function closeEditModal() {
        // Sembunyikan modal
        document.getElementById('editCatModal').classList.remove('flex');
        document.getElementById('editCatModal').classList.add('hidden');
    }
</script>
@endsection
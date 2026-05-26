@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto relative">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <h1 class="text-3xl font-extrabold text-slate-800">Manajemen Partner</h1>
        
        <!-- JAWABAN SOAL 3: Form Input Search -->
        <form action="{{ route('admin.partners.index') }}" method="GET" class="w-full md:w-auto relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama partner..." 
                   class="w-full md:w-72 pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">
            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            @if(request('search'))
                <a href="{{ route('admin.partners.index') }}" class="absolute right-3 top-3 text-red-500 hover:text-red-700 text-sm font-bold">X</a>
            @endif
        </form>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl font-bold flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Form Tambah Partner -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-10">
        <h2 class="text-xl font-bold mb-4 text-slate-800">Tambah Partner Baru</h2>
        <form action="{{ route('admin.partners.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
            @csrf
            <input type="text" name="name" placeholder="Nama Partner" class="flex-1 px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none" required>
            <input type="url" name="logo_url" placeholder="URL Logo (https://...)" class="flex-1 px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none" required>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Simpan</button>
        </form>
    </div>

    <!-- Tabel / List Partner -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($partners as $partner)
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm text-center relative group hover:shadow-md transition">
            
            <!-- Aksi (Edit & Hapus) - Muncul saat di hover -->
            <div class="absolute top-3 right-3 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <!-- Tombol Edit (Membuka Modal) -->
                <button type="button" onclick="openEditModal({{ $partner->id }}, '{{ addslashes($partner->name) }}', '{{ $partner->logo_url }}')" class="bg-indigo-50 text-indigo-500 hover:bg-indigo-500 hover:text-white p-2 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>

                <!-- Tombol Hapus -->
                <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-500 hover:text-white p-2 rounded-lg transition" onclick="return confirm('Yakin ingin menghapus partner {{ $partner->name }}?')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>

            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="w-20 h-20 mx-auto mb-4 rounded-full object-cover border-4 border-indigo-50">
            <h3 class="font-bold text-slate-800 line-clamp-2">{{ $partner->name }}</h3>
        </div>
        @endforeach
    </div>
</div>

<!-- MODAL EDIT PARTNER (Disembunyikan secara default) -->
<div id="editModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 transform transition-all">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800">Edit Partner</h3>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <!-- Form Edit -->
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Partner</label>
                <input type="text" id="edit_name" name="name" class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">URL Logo</label>
                <input type="url" id="edit_logo_url" name="logo_url" class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeEditModal()" class="px-6 py-2.5 bg-slate-100 text-slate-700 font-bold rounded-xl hover:bg-slate-200 transition">Batal</button>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Update Data</button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT UNTUK MENGENDALIKAN MODAL -->
<script>
    function openEditModal(id, name, logo_url) {
        // 1. Ubah action URL form agar mengarah ke route update yang benar
        const form = document.getElementById('editForm');
        form.action = `/admin/partners/${id}`; // Menggunakan route dinamis
        
        // 2. Isi input form dengan data partner saat ini
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_logo_url').value = logo_url;
        
        // 3. Tampilkan Modal (hilangkan class 'hidden', tambahkan 'flex')
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        // Sembunyikan Modal kembali
        const modal = document.getElementById('editModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
@endsection
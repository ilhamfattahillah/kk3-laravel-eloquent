@extends('layouts.main')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-700 to-blue-700 text-transparent bg-clip-text">
            Data Karyawan
        </h2>

        <a href="{{ route('karyawan.tambah') }}" 
           class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white px-5 py-2 rounded-xl shadow hover:scale-105 transition">
           + Tambah
        </a>
    </div>

    <!-- SEARCH -->
    <form method="GET" action="{{ route('karyawan') }}" class="mb-6 flex gap-3">

        <select name="kategori" class="px-3 py-2 rounded-xl border border-slate-300">

        <option value="nama" {{ request('kategori') == 'nama' ? 'selected' : '' }}>
            Nama
        </option>

        <option value="posisi" {{ request('kategori') == 'posisi' ? 'selected' : '' }}>
            Posisi
        </option>

        <option value="departemen" {{ request('kategori') == 'departemen' ? 'selected' : '' }}>
            Departemen
        </option>

        </select>

    <input 
        type="text" 
        name="search" 
        placeholder="Cari..." 
        value="{{ request('search') }}"
        class="w-full px-4 py-2 rounded-xl border border-slate-300">

    <button class="bg-slate-800 text-white px-5 py-2 rounded-xl">
        Cari
    </button>

</form>

    <!-- TABLE -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden border border-slate-200">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Posisi</th>
                    <th class="px-6 py-3 text-left">Departemen</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($karyawan as $p)
                <tr class="border-t hover:bg-indigo-50 hover:scale-[1.01] transition duration-200">
                    <td class="px-6 py-4">{{ $p->id }}</td>

                    <td class="px-6 py-4 font-medium text-slate-800">
                        {{ $p->nama }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $p->posisi }}
                    </td>

                    <!-- BADGE DEPARTEMEN -->
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-600 font-medium">
                            {{ $p->departemen->nama_departemen ?? '-' }}
                        </span>
                    </td>

                    <!-- AKSI -->
                    <td class="px-6 py-4 flex gap-4 items-center">
                        <a href="{{ route('karyawan.edit', $p->id) }}" 
                           class="text-indigo-600 hover:text-indigo-800 font-medium">
                           Edit
                        </a>

                        <form action="{{ route('karyawan.delete', $p->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:text-red-700 font-medium">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="mt-6 flex justify-center">
        {{ $karyawan->links() }}
    </div>

</div>

@endsection
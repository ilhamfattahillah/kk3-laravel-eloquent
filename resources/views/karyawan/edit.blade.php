@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Edit Data Karyawan
        </h2>

        <a href="{{ route('karyawan') }}" 
           class="text-sm text-indigo-600 hover:underline">
           ← Kembali
        </a>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-md p-6">

        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">
                    Nama
                </label>
                <input 
                    type="text" 
                    name="nama" 
                    value="{{ $karyawan->nama }}"
                    class="w-full px-4 py-2 rounded-xl border border-slate-300 
                           focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 
                           outline-none transition"
                >
            </div>

            <!-- POSISI -->
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">
                    Posisi
                </label>
                <input 
                    type="text" 
                    name="posisi" 
                    value="{{ $karyawan->posisi }}"
                    class="w-full px-4 py-2 rounded-xl border border-slate-300 
                           focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 
                           outline-none transition"
                >
            </div>

            <!-- 🔥 DEPARTEMEN (TAMBAH DI SINI) -->
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">
                    Departemen
                </label>
                <select 
                    name="departemen_id"
                    class="w-full px-4 py-2 rounded-xl border border-slate-300 
                           focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 
                           outline-none transition"
                >
                    @foreach ($departemen as $d)
                        <option value="{{ $d->id }}"
                            {{ $karyawan->departemen_id == $d->id ? 'selected' : '' }}>
                            {{ $d->nama_departemen }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- BUTTON -->
            <div class="pt-4">
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-indigo-500 to-indigo-600 
                           text-white py-2 rounded-xl font-medium 
                           hover:from-indigo-600 hover:to-indigo-700 
                           transition duration-200 shadow-sm">
                    Update Data
                </button>
            </div>
            
        </form>

    </div>
</div>
@endsection
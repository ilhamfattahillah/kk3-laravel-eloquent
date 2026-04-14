<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\Departemen;

class KaryawanController extends Controller
{
    // READ
    public function index(Request $request)
{
    $search = $request->search;

    $karyawan = Karyawan::with('departemen')
        ->when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%$search%");
        })
        ->paginate(5);

    return view('karyawan.index', compact('karyawan'));
}
    public function show()
    {
        return view('karyawan.tambah');
    }

    // CREATE
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'posisi' => 'required'
        ]);
    
        Karyawan::create([
            'nama' => $validatedData['nama'],
            'posisi' => $validatedData['posisi']
        ]);

        return redirect('/karyawan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $departemen = Departemen::all();

        return view('karyawan.edit', compact('karyawan', 'departemen'));
    }
    // UPDATE
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'posisi' => 'required'
        ]);
        
        $karyawan->update([
        'nama' => $request->nama,
        'posisi' => $request->posisi,
        'departemen_id' => $request->departemen_id
        ]);
        return redirect('/karyawan');
    }

    // DELETE
    public function destroy($id)
    {
        Karyawan::destroy($id);

        return redirect('/karyawan');
    }


}
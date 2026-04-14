<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\Departemen;

class KaryawanController extends Controller
{
    // READ + SEARCH + PAGINATION
    public function index(Request $request)
    {
        $search = $request->search;
        $kategori = $request->kategori;

        $karyawan = Karyawan::with('departemen')
            ->when($search, function ($query) use ($search, $kategori) {

        if ($kategori == 'nama') {
            $query->where('nama', 'like', "%$search%");
        }

        elseif ($kategori == 'posisi') {
            $query->where('posisi', 'like', "%$search%");
        }

        elseif ($kategori == 'departemen') {
            $query->whereHas('departemen', function ($q) use ($search) {
                $q->where('nama_departemen', 'like', "%$search%");
            });
        }

    })
    ->paginate(5);

        return view('karyawan.index', compact('karyawan'));
    }

    // FORM TAMBAH
    public function show()
    {
        $departemen = Departemen::all();

        return view('karyawan.tambah', compact('departemen'));
    }

    // CREATE
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'posisi' => 'required',
            'departemen_id' => 'required'
        ]);

        Karyawan::create([
            'nama' => $validatedData['nama'],
            'posisi' => $validatedData['posisi'],
            'departemen_id' => $validatedData['departemen_id']
        ]);

        return redirect('/karyawan');
    }

    // FORM EDIT
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
            'posisi' => 'required',
            'departemen_id' => 'required'
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PemberiController extends Controller
{
    public function index()
    {
        return view('pemberi.dashboard');
    }

    // Tampilkan semua hewan milik user pemberi
    public function hewanIndex()
    {
        $hewan = ChelsiAnimal::where('user_id', Auth::id())->get();
        return view('pemberi.hewan.index', compact('hewan'));
    }

    // Form tambah hewan
    public function create()
    {
        return view('pemberi.hewan.create');
    }

    // Simpan hewan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'jenis' => 'required|string',
            'ras' => 'nullable|string',
            'usia' => 'required|numeric|min:0',
            'jenis_kelamin' => 'required|in:jantan,betina',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foto = $request->file('foto')->store('hewan', 'public');

        ChelsiAnimal::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'ras' => $request->ras,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
            'user_id' => Auth::id(),
        ]);

        return redirect('/pemberi/hewan')->with('success', 'Hewan berhasil ditambahkan.');
    }

    // Form edit hewan
    public function edit($id)
    {
        $hewan = ChelsiAnimal::where('user_id', Auth::id())->findOrFail($id);
        return view('pemberi.hewan.edit', compact('hewan'));
    }

    // Update data hewan
    public function update(Request $request, $id)
    {
        $hewan = ChelsiAnimal::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'jenis' => 'required|string',
            'ras' => 'nullable|string',
            'usia' => 'required|numeric|min:0',
            'jenis_kelamin' => 'required|in:jantan,betina',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            try {
                Storage::disk('public')->delete($hewan->foto);
            } catch (\Exception $e) {
                // File mungkin sudah dihapus sebelumnya, aman untuk diabaikan
            }

            $foto = $request->file('foto')->store('hewan', 'public');
            $hewan->foto = $foto;
        }

        $hewan->update($request->except('foto') + ['foto' => $hewan->foto]);

        return redirect('/pemberi/hewan')->with('success', 'Data hewan berhasil diperbarui.');
    }

    // Hapus hewan
    public function destroy($id)
    {
        $hewan = ChelsiAnimal::where('user_id', Auth::id())->findOrFail($id);

        try {
            Storage::disk('public')->delete($hewan->foto);
        } catch (\Exception $e) {
            // Aman jika file sudah tidak ada
        }

        $hewan->delete();

        return redirect('/pemberi/hewan')->with('success', 'Hewan berhasil dihapus.');
    }
}

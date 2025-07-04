<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ChelsiUser;
use App\Models\ChelsiAnimal;
use App\Models\ChelsiAdoptionRequest;
use App\Models\ChelsiMedicalRecord;
use App\Models\ChelsiArticle;
use Illuminate\Support\Facades\Storage;



class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = ChelsiUser::where('role', '!=', 'admin')->get(); // Semua kecuali admin
        return view('admin.users', compact('users'));
    }

    public function hewanIndex()
    {
        $hewan = ChelsiAnimal::with('user')->latest()->get();
        return view('admin.hewan.index', compact('hewan'));
    }

    public function adopsiIndex()
    {
        $permintaan = ChelsiAdoptionRequest::with(['hewan', 'adopter'])->latest()->get();
        return view('admin.adopsi.index', compact('permintaan'));
    }

    public function setujuiAdopsi($id)
    {
        $adopsi = ChelsiAdoptionRequest::findOrFail($id);
        $adopsi->status = 'disetujui';
        $adopsi->save();

        return back()->with('success', 'Permintaan adopsi disetujui.');
    }

    public function tolakAdopsi($id)
    {
        $adopsi = ChelsiAdoptionRequest::findOrFail($id);
        $adopsi->status = 'ditolak';
        $adopsi->save();

        return back()->with('success', 'Permintaan adopsi ditolak.');
    }
    public function rekamMedisIndex()
    {
        $rekam = ChelsiMedicalRecord::with(['hewan', 'dokter'])->latest()->get();
        return view('admin.medis.index', compact('rekam'));
    }

    public function artikelIndex()
    {
        $artikel = ChelsiArticle::latest()->get();
        return view('admin.artikel.index', compact('artikel'));
    }

    public function artikelCreate()
    {
        return view('admin.artikel.create');
    }

    public function artikelStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        $foto = $request->file('foto') ? $request->file('foto')->store('artikel', 'public') : null;

        ChelsiArticle::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'foto' => $foto,
            'created_by' => Auth::id(),

        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function artikelEdit($id)
    {
        $artikel = ChelsiArticle::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function artikelUpdate(Request $request, $id)
    {
        $artikel = ChelsiArticle::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($artikel->foto) {
                Storage::disk('public')->delete($artikel->foto);
            }

            $fotoBaru = $request->file('foto')->store('artikel', 'public');
            $artikel->foto = $fotoBaru;
        }

        $artikel->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'foto' => $artikel->foto,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function hapusArtikel($id)
    {
        $artikel = ChelsiArticle::findOrFail($id);

        // Hapus file foto jika ada
        if ($artikel->foto) {
            try {
                Storage::disk('public')->delete($artikel->foto);
            } catch (\Exception $e) {
                // Abaikan jika file tidak ditemukan
            }
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
    
      




    
}

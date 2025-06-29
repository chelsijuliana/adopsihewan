<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ChelsiUser;
use App\Models\ChelsiAnimal;
use App\Models\ChelsiAdoptionRequest;

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


    
}

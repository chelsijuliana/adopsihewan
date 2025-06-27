<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;
use Illuminate\Support\Facades\Auth;

class AdopterController extends Controller
{
    public function index()
    {
        return view('adopter.dashboard');
    }

    public function hewanIndex()
    {
        $hewan = ChelsiAnimal::where('user_id', '!=', Auth::id())->get();
        return view('adopter.hewan.index', compact('hewan'));
    }

    public function show($id)
    {
        $hewan = \App\Models\ChelsiAnimal::findOrFail($id);

        // Jangan tampilkan hewan milik sendiri
        if ($hewan->user_id == Auth::id()) {
            abort(403, 'Tidak boleh melihat hewan milik sendiri.');
        }

        return view('adopter.hewan.show', compact('hewan'));
    }

}

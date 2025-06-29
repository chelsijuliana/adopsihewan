<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;


class DokterController extends Controller
{
    public function index()
    {
        return view('dokter.dashboard');
    }
    public function hewanIndex()
    {
        $hewan = ChelsiAnimal::with('user')->get(); // opsional: relasi ke pemberi
        return view('dokter.hewan.index', compact('hewan'));
    }
    
}

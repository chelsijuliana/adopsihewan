<?php

namespace App\Http\Controllers;

use App\Models\ChelsiAdoptionRequest;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $adopsi = ChelsiAdoptionRequest::with(['hewan', 'adopter'])
                    ->where('status', 'disetujui')
                    ->latest()
                    ->get();

        return view('galeri.index', compact('adopsi'));
    }
}

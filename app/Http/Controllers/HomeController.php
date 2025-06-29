<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;

class HomeController extends Controller
{
    public function index()
    {
        $hewan = ChelsiAnimal::latest()->whereDoesntHave('adoptionRequest', function ($query) {
            $query->where('status', 'disetujui');
        })->take(6)->get();

        return view('home', compact('hewan'));
    }
}

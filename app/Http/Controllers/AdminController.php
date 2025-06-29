<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ChelsiUser;
use App\Models\ChelsiAnimal;

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
    

    
}

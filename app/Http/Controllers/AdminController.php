<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        echo "Halo selamat datang di Panel Admin";
        echo "<h1>" . Auth::user()->name . "</h1>";
    }
}

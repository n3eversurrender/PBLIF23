<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainAdminController extends Controller
{
    public function mainAdmin()
    {
        return view('layouts/mainAdmin', [
        ]);
    }
}

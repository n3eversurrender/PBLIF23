<?php

namespace App\Http\Controllers;

use App\Models\UmpanBalik;
use Illuminate\Http\Request;

class UmpanBalikController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'nama_komentar' => 'required|string|max:255',
            'komentar' => 'required|string',
        ], [
            'nama_komentar.required' => "Nama Wajib diisi",
            'komentar.required' => 'Komentar Wajib diisi',
        ]);

        UmpanBalik::create([
            'nama_komentar' => $validated['nama_komentar'],
            'komentar' => $validated['komentar'],
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UmpanBalik;

class DataUmpanBalikController extends Controller
{
    public function dataUmpanBalik()
    {

        $umpanBalik = UmpanBalik::paginate(10);

        return view('Admin.DataUmpanBalik', compact('umpanBalik'));
    }

    public function destroy($id)
    {
        $umpanBalik = UmpanBalik::findOrFail($id);

        $umpanBalik->delete();

        return redirect()->back()->with('success', 'Umpan Balik berhasil dihapus.');
    }
}

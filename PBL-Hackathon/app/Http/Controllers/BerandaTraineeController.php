<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Kategori;

class BerandaTraineeController extends Controller
{
    public function berandaTrainee(Request $request)
    {
        $kategori_id = $request->input('kategori_id'); // Ambil kategori dari filter
        $tingkat_kesulitan = $request->input('tingkat_kesulitan'); // Ambil tingkat kesulitan dari filter

        // Query kursus
        $query = Kursus::with(['kategori', 'ratingKursus'])
            ->withAvg('ratingKursus as average_rating', 'rating')
            ->where('status', 'Aktif');

        if ($kategori_id) {
            $query->where('kategori_id', $kategori_id);
        }

        if ($tingkat_kesulitan && $tingkat_kesulitan !== '-') {
            $query->where('tingkat_kesulitan', $tingkat_kesulitan);
        }

        $kursus = $query->paginate(9);

        $uniqueTingkatKesulitan = Kursus::select('tingkat_kesulitan')
            ->whereIn('kursus_id', $kursus->pluck('kursus_id'))
            ->distinct()
            ->get();

        $kategori = Kategori::all();

        return view('Traineev2.BerandaTrainee', [
            'kursus' => $kursus,
            'kategori' => $kategori,
            'uniqueTingkatKesulitan' => $uniqueTingkatKesulitan,
        ]);
    }
}

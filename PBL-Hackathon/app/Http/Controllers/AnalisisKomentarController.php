<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\ConnectionException;

class AnalisisKomentarController extends Controller
{
    public function apiHasil(Request $request)
    {
        $penggunaId = Auth::user()->pengguna_id;

        try {
            $response = Http::timeout(600)->post('http://127.0.0.1:9999/proses-ulasan-realtime', [
                'pengguna_id' => $penggunaId
            ]);
            if ($response->ok() && $response->header('Content-Type') === 'application/json') {
                return response()->json($response->json());
            } else {
                Log::error('Respon bukan JSON: ' . $response->body());
                return response()->json(['error' => 'Respon tidak valid dari engine.'], 500);
            }
        } catch (ConnectionException $e) {
            Log::error('Gagal koneksi ke Flask: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal menghubungi engine analisis. Coba lagi nanti.'], 500);
        }
    }
}

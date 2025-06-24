<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProsesAnalisisKomentarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $penggunaId;

    public function __construct($penggunaId)
    {
        $this->penggunaId = $penggunaId;
    }

    public function handle()
    {
        try {
            $response = Http::timeout(120)->post('http://127.0.0.1:9999/proses-ulasan-realtime', [
                'pengguna_id' => $this->penggunaId
            ]);

            if ($response->successful()) {
                Storage::disk('local')->put(
                    "analisis/hasil_{$this->penggunaId}.json",
                    json_encode($response->json())
                );
            } else {
                Log::warning("Analisis komentar gagal (HTTP {$response->status()}) untuk pengguna {$this->penggunaId}");
            }
        } catch (\Exception $e) {
            Log::error("Analisis komentar error: " . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfilController extends Controller
{

    public function profil()
    {
        $user = Auth::user();

        // Ambil data peserta dari relasi
        $peserta = $user->peserta; // Ini otomatis query ke tabel peserta via pengguna_id

        // Kirim ke view
        return view('Traineev2.Profil', compact('user', 'peserta'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'status' => 'nullable|string',
            'pendidikan' => 'nullable|string',
            'bidang_saat_ini' => 'nullable|string',
            'tahun_pengalaman' => 'nullable|integer',
            'bulan_pengalaman' => 'nullable|integer',
            'minat_bidang' => 'nullable|string',
            'kemampuan' => 'nullable|string',
        ]);

        // Update data pengguna
        $user->nama = $request->nama;
        $user->no_telepon = $request->no_telepon;
        $user->alamat = $request->alamat;

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $user->foto_profil = $path;
        }

        $user->save();

        // Update data peserta (relasi)
        $peserta = $user->peserta;
        if (!$peserta) {
            $peserta = new \App\Models\Peserta();
            $peserta->pengguna_id = $user->pengguna_id;
        }

        $peserta->status = $request->status;
        $peserta->pendidikan = $request->pendidikan;

        // Format bidang_saat_ini jadi array of objects: [{ bidang: "X" }]
        $bidangArray = array_map(fn($b) => ['bidang' => trim($b)], explode(',', $request->bidang_saat_ini));
        $peserta->bidang_saat_ini = json_encode($bidangArray);

        $peserta->tahun_pengalaman = $request->tahun_pengalaman;
        $peserta->bulan_pengalaman = $request->bulan_pengalaman;

        // Handle minat_bidang dari format [{"value":"X"}, ...] → ["X", ...]
        $minat = json_decode($request->minat_bidang, true);
        if (is_array($minat) && isset($minat[0]['value'])) {
            $minat = array_column($minat, 'value');
        }
        $peserta->minat_bidang = $minat;

        $kemampuan = json_decode($request->kemampuan, true);
        if (is_array($kemampuan) && isset($kemampuan[0]['value'])) {
            $kemampuan = array_column($kemampuan, 'value');
        }
        $peserta->kemampuan = $kemampuan;


        $peserta->save();

        return redirect()->route('Profil')->with('success', 'Profil berhasil diperbarui.');
    }
}

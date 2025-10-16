<?php

namespace App\Http\Controllers;

use App\Models\Pengguna; // Pastikan Anda punya model ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show($id)
    {
        // 1. Ambil data utama pengguna
        $pengguna = Pengguna::findOrFail($id);

        // 2. Kalkulasi Player Status dari tabel riwayatpertandingan
        $playerStats = DB::table('riwayatpertandingan')
            ->where('pengguna_id', $id)
            ->selectRaw('
                COUNT(*) as matches,
                SUM(CASE WHEN hasil = "menang" THEN 1 ELSE 0 END) as wins,
                SUM(jumlah_kill) as kills,
                SUM(jumlah_death) as deaths
            ')
            ->first();

        // Hitung KDR (Kill Death Ratio), hindari pembagian dengan nol
        $kdr = ($playerStats->deaths > 0)
                ? round($playerStats->kills / $playerStats->deaths, 2)
                : $playerStats->kills;

        // 3. Kalkulasi Tournament Stats dari tabel pesertaturnamen
        $tournamentStats = DB::table('pesertaturnamen')
            ->where('pengguna_id', $id)
            ->selectRaw('
                COUNT(*) as matches,
                SUM(CASE WHEN peringkat = 1 THEN 1 ELSE 0 END) as wins,
                SUM(jumlah_kill) as kills
            ')
            ->first();

        // 4. Kirim semua data ke view
        return view('profil', [
            'pengguna' => $pengguna,
            'playerStats' => $playerStats,
            'kdr' => $kdr,
            'tournamentStats' => $tournamentStats,
        ]);
    }
}

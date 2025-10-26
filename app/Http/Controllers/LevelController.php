<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\KisiKisi;
use App\Models\Pertanyaan;
use App\Models\Pilihanjawaban;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function map()
    {
        $levels = Level::orderBy('nomor_level', 'asc')->get();
        return view('siswa.maplevel', compact('levels'));
    }

    public function preview($id)
    {
        $level = Level::with('kisiKisi')->where('id_level', $id)->first();
        if (!$level) {
            return abort(404, 'Level tidak ditemukan.');
        }

        $kisi = $level->kisiKisi->first();

        return view('siswa.levels.preview', [
            'id' => $id,
            'level' => $level,
            'kisi' => $kisi,
            'kisiList' => $level->kisiKisi,
        ]);
    }

    // menampilkan soal dan yang lain-lain
    public function start($id)
    {
        // ✅ Ambil data level termasuk durasi
        $level = Level::where('id_level', $id)->first();
        if (!$level) {
            return abort(404, 'Level tidak ditemukan.');
        }

        // Ambil 10 pertanyaan acak sesuai level
        $pertanyaanList = Pertanyaan::where('id_level', $id)
            ->with(['pilihanjawaban'])
            ->inRandomOrder()
            ->take(10)
            ->get();

        if ($pertanyaanList->isEmpty()) {
            return redirect()->route('level.preview', $id)
                             ->with('error', 'Belum ada soal untuk level ini.');
        }

        // Gunakan durasi dari level, bukan dari pertanyaan
        $soalData = $pertanyaanList->map(function ($pertanyaan) use ($level) {
            return [
                'id' => $pertanyaan->id_pertanyaan,
                'q' => $pertanyaan->teks_pertanyaan ?? 'Pertanyaan tidak tersedia',
                'a' => $pertanyaan->pilihanjawaban->pluck('teks_jawaban')->shuffle()->toArray(),
                'correct' => optional(
                    $pertanyaan->pilihanjawaban->firstWhere('adalah_benar', 1)
                )->teks_jawaban,
                'durasi' => $level->durasi ?? 60, // ambil durasi dari tabel level
            ];
        });

        return view('siswa.levels.start', [
            'id' => $id,
            'level' => $level,
            'pertanyaanList' => $pertanyaanList,
            'soalData' => $soalData,
            'durasiLevel' => $level->durasi ?? 60, // ✅ tambahkan ini
        ]);
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'pertanyaan_id' => 'required|integer',
            'jawaban_id' => 'required|integer'
        ]);

        $pertanyaanId = $request->input('pertanyaan_id');
        $jawabanId = $request->input('jawaban_id');

        $pertanyaan = Pertanyaan::where('id_pertanyaan', $pertanyaanId)
                                 ->where('id_level', $id)
                                 ->first();

        if (!$pertanyaan) {
            return redirect()->back()->with('error', 'Soal tidak valid untuk level ini.');
        }

        $jawaban = Pilihanjawaban::where('id_jawaban', $jawabanId)
                                 ->where('id_pertanyaan', $pertanyaanId)
                                 ->first();

        if (!$jawaban) {
            return redirect()->back()->with('error', 'Pilihan jawaban tidak ditemukan.');
        }

        $isCorrect = (bool) $jawaban->adalah_benar;

        try {
            DB::table('riwayatpertandingan')->insert([
                'id_pengguna' => session('pengguna_id') ?? null,
                'id_level' => $id,
                'exp_didapat' => $isCorrect ? 50 : 0,
                'bintang_didapat' => $isCorrect ? 1 : 0,
                'waktu_selesai' => now()
            ]);
        } catch (\Exception $e) {
            // Abaikan jika tabel tidak ada
        }

        return redirect()->route('level.preview', $id)
                         ->with('result', [
                             'pertanyaan_id' => $pertanyaanId,
                             'jawaban_id' => $jawabanId,
                             'is_correct' => $isCorrect,
                             'pesan' => $isCorrect ? 'Jawaban benar! 🎉' : 'Jawaban salah. Coba lagi.'
                         ]);
    }
}
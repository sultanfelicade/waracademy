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
    /**
     * Tampilkan peta level (map).
     * view: resources/views/siswa/maplevel.blade.php
     */
    public function map()
    {
        // Ambil semua level (urut berdasarkan nomor)
        $levels = Level::orderBy('nomor_level', 'asc')->get();

        return view('siswa.maplevel', compact('levels'));
    }

    /**
     * Preview (kisi-kisi) untuk satu level.
     * view: resources/views/siswa/levels/preview.blade.php
     */
    public function preview($id)
    {
        // Ambil level + relasi kisi (one-to-many)
        $level = Level::with('kisiKisi')->where('id_level', $id)->first();

        if (!$level) {
            return abort(404, 'Level tidak ditemukan.');
        }

        // Ambil satu kisi (jika per level hanya ada satu)
        $kisi = $level->kisiKisi->first();

        return view('siswa.levels.preview', [
            'id' => $id,
            'level' => $level,
            'kisi' => $kisi,
            'kisiList' => $level->kisiKisi,
        ]);
    }

    /**
     * Mulai level -> ambil soal (random) untuk level tersebut.
     * view: resources/views/siswa/levels/start.blade.php
     */
    public function start($id)
    {
        $level = Level::where('id_level', $id)->first();
        if (!$level) {
            return abort(404, 'Level tidak ditemukan.');
        }

        // Ambil 10 pertanyaan acak beserta pilihan jawabannya
        $pertanyaanList = Pertanyaan::where('id_level', $id)
            ->with(['pilihanjawaban'])
            ->inRandomOrder()
            ->take(10)
            ->get();

        if ($pertanyaanList->isEmpty()) {
            return redirect()->route('level.preview', $id)
                            ->with('error', 'Belum ada soal untuk level ini.');
        }

        // Format ulang agar bisa dipakai di JS
        $soalData = $pertanyaanList->map(function ($pertanyaan) {
            return [
                'id' => $pertanyaan->id_pertanyaan,
                'q' => $pertanyaan->isi_pertanyaan ?? 'Pertanyaan tidak tersedia',
                'a' => $pertanyaan->pilihanjawaban->pluck('isi_jawaban')->toArray(),
                'correct' => optional(
                    $pertanyaan->pilihanjawaban->firstWhere('adalah_benar', 1)
                )->isi_jawaban,
            ];
        });

        return view('siswa.levels.start', [
            'id' => $id,
            'level' => $level,
            'pertanyaanList' => $pertanyaanList, // kalau masih ingin dipakai di backend
            'soalData' => $soalData,             // khusus untuk Blade & JS
        ]);
    }

    /**
     * Submit jawaban user untuk soal level.
     */
    public function submit(Request $request, $id)
    {
        $request->validate([
            'pertanyaan_id' => 'required|integer',
            'jawaban_id' => 'required|integer'
        ]);

        $pertanyaanId = $request->input('pertanyaan_id');
        $jawabanId = $request->input('jawaban_id');

        // Validasi pertanyaan sesuai level
        $pertanyaan = Pertanyaan::where('id_pertanyaan', $pertanyaanId)
                                 ->where('id_level', $id)
                                 ->first();

        if (!$pertanyaan) {
            return redirect()->back()->with('error', 'Soal tidak valid untuk level ini.');
        }

        // Ambil jawaban yang dipilih
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
            // Jika tabel belum ada atau error lainnya, abaikan
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

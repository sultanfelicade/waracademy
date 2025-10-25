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
        // ambil semua level (urut berdasarkan nomor)
        $levels = Level::orderBy('nomor_level', 'asc')->get();

        return view('siswa.maplevel', compact('levels'));
    }

    /**
     * Preview (kisi-kisi) untuk satu level.
     * view: resources/views/siswa/levels/preview.blade.php
     */
    public function preview($id)
    {
        // ambil level + relasi kisi (one-to-many)
        $level = Level::with('kisiKisi')->where('id_level', $id)->first();

        if (!$level) {
            return abort(404, 'Level tidak ditemukan.');
        }

        // ambil satu kisi (kalau per level cuma ada satu kisi)
        $kisi = $level->KisiKisi->first();

        // kalau nanti mau looping semua, bisa juga pakai $kisiList = $level->kisiKisi;
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
    
        // ambil semua pertanyaan level ini (bukan cuma 1)
        $pertanyaanList = Pertanyaan::where('id_level', $id)
                        ->with(['pilihanjawaban'])
                        ->take(5)
                        ->get();
    
        // kalau database kosong, gunakan dummy (sementara)
        if ($pertanyaanList->isEmpty()) {
            $pertanyaanList = collect([
                (object)[
                    'id_pertanyaan' => 1,
                    'teks_pertanyaan' => 'Siapa tokoh utama dalam sejarah WarAcademy?',
                    'pilihanjawaban' => collect([
                        (object)['id_jawaban' => 1, 'teks_jawaban' => 'Ares', 'adalah_benar' => false],
                        (object)['id_jawaban' => 2, 'teks_jawaban' => 'Luna', 'adalah_benar' => true],
                        (object)['id_jawaban' => 3, 'teks_jawaban' => 'Zeon', 'adalah_benar' => false],
                        (object)['id_jawaban' => 4, 'teks_jawaban' => 'Orion', 'adalah_benar' => false],
                    ])
                ],
                (object)[
                    'id_pertanyaan' => 2,
                    'teks_pertanyaan' => 'Apa warna energi cahaya suci?',
                    'pilihanjawaban' => collect([
                        (object)['id_jawaban' => 5, 'teks_jawaban' => 'Merah', 'adalah_benar' => false],
                        (object)['id_jawaban' => 6, 'teks_jawaban' => 'Emas', 'adalah_benar' => true],
                        (object)['id_jawaban' => 7, 'teks_jawaban' => 'Ungu', 'adalah_benar' => false],
                        (object)['id_jawaban' => 8, 'teks_jawaban' => 'Hijau', 'adalah_benar' => false],
                    ])
                ],
                (object)[
                    'id_pertanyaan' => 3,
                    'teks_pertanyaan' => 'Berapa jumlah elemen dasar di WarAcademy?',
                    'pilihanjawaban' => collect([
                        (object)['id_jawaban' => 9, 'teks_jawaban' => '3', 'adalah_benar' => false],
                        (object)['id_jawaban' => 10, 'teks_jawaban' => '4', 'adalah_benar' => true],
                        (object)['id_jawaban' => 11, 'teks_jawaban' => '5', 'adalah_benar' => false],
                        (object)['id_jawaban' => 12, 'teks_jawaban' => '6', 'adalah_benar' => false],
                    ])
                ],
                (object)[
                    'id_pertanyaan' => 4,
                    'teks_pertanyaan' => 'Senjata khas unit penjaga?',
                    'pilihanjawaban' => collect([
                        (object)['id_jawaban' => 13, 'teks_jawaban' => 'Tombak', 'adalah_benar' => true],
                        (object)['id_jawaban' => 14, 'teks_jawaban' => 'Busur', 'adalah_benar' => false],
                        (object)['id_jawaban' => 15, 'teks_jawaban' => 'Pedang', 'adalah_benar' => false],
                        (object)['id_jawaban' => 16, 'teks_jawaban' => 'Perisai', 'adalah_benar' => false],
                    ])
                ],
                (object)[
                    'id_pertanyaan' => 5,
                    'teks_pertanyaan' => 'Apa makna bintang dalam pertempuran?',
                    'pilihanjawaban' => collect([
                        (object)['id_jawaban' => 17, 'teks_jawaban' => 'Tanda kemenangan', 'adalah_benar' => true],
                        (object)['id_jawaban' => 18, 'teks_jawaban' => 'Simbol gagal', 'adalah_benar' => false],
                        (object)['id_jawaban' => 19, 'teks_jawaban' => 'Peringkat lawan', 'adalah_benar' => false],
                        (object)['id_jawaban' => 20, 'teks_jawaban' => 'Nilai moral', 'adalah_benar' => false],
                    ])
                ],
            ]);
        }
    
        return view('siswa.levels.start', [
            'id' => $id,
            'level' => $level,
            'pertanyaanList' => $pertanyaanList,
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

        $pert = Pertanyaan::where('id_pertanyaan', $pertanyaanId)
                          ->where('id_level', $id)
                          ->first();

        if (!$pert) {
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
            // abaikan jika tabel belum ada
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

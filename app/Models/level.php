<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'level';
    protected $primaryKey = 'id_level';
    public $timestamps = false;

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nomor_level',
        'durasi',
        'tingkat_kesulitan',
    ];

    // Relasi ke tabel kisi_kisi (jika 1 level punya 1 kisi)
    public function kisiKisi()
    {
        return $this->hasOne(KisiKisi::class, 'level_id', 'id_level');
    }

    // Akses custom: menampilkan durasi dalam format menit:detik
    public function getDurasiFormattedAttribute()
    {
        $menit = floor($this->durasi / 60);
        $detik = $this->durasi % 60;
        return sprintf('%02d:%02d', $menit, $detik);
    }
}

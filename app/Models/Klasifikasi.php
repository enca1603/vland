<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    protected $table = 'klasifikasi';
    protected $guarded = [''];

    public function surat_masuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    public function surat_keluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }
}

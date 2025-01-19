<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SuratKeluar extends Model
{
    use HasUuids;

    protected $table = 'surat_keluar';
    protected $guarded = [''];

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class);
    }
}

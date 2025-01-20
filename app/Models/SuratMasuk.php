<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasUuids;

    protected $table = 'surat_masuk';
    protected $guarded = [''];

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class);
    }

    public function disposisis()
    {
        return $this->hasMany(Disposisi::class);
    }
}

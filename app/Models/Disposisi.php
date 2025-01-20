<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposisi extends Model
{
    use HasUuids;

    protected $table = 'disposisi';
    protected $guarded = [''];

    public function surat_masuk(): BelongsTo
    {
        return $this->belongsTo(SuratMasuk::class, 'suratmasuk_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Sifat::class, 'sifat_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Disposisi extends Model
{
    use HasUuids;

    protected $table = 'disposisi';
    protected $guarded = [''];

    public function getFormatTanggal(): string
    {
        return Carbon::parse($this->tanggal)->format('d F Y');
    }

    public function surat_masuk(): BelongsTo
    {
        return $this->belongsTo(SuratMasuk::class, 'suratmasuk_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Sifat::class, 'sifat_id', 'id');
    }
}

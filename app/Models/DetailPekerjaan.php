<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'detail_pekerjaans';

    public function pekerjaan() : BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan', 'id');
    }

    protected $fillable = [
        'id_pekerjaan', 'nama_pekerjaan', 'desc_pekerjaan', 'jam_kerja', 'tgl_kerja', 'tipe'
    ];


}

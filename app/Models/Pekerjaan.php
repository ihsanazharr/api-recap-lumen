<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaans';


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    protected $fillable = [
        'id_user', 'bulan', 'jam_toleransi', 'total_jam'
    ];
}

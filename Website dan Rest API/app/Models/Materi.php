<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $fillable = [
        'mapel_id','judul','deskripsi','gambar','lampiran'
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

}

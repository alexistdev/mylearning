<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswakelas extends Model
{
    use HasFactory;
    protected $fillable = [
        'siswa_id','kelas_id'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class)->with('user');
    }
}

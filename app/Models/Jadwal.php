<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jadwal';
    protected $table = 'jadwal';
    protected $guarded = [];


    public function jamaah()
    {
        return $this->hasMany(Jamaah::class, 'jadwal_id', 'id_jadwal');
    }
}
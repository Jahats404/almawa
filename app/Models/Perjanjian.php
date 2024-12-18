<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjanjian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_perjanjian';
    protected $table = 'perjanjian';
    protected $guarded = [];


    public function agen()
    {
        return $this->belongsTo(Agen::class,'agen_id', 'no_registrasi');
    }
}
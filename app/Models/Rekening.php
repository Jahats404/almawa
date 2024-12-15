<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_rekening';
    protected $table = 'rekening';
    protected $guaraded = [];
    protected $casts = ['id_rekening' => 'string'];
    
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class,'rekening_id','id_rekening');
    }
}
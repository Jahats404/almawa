<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranJamaah extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pembayaran';
    protected $table = 'pembayaran_jamaah';
    protected $guarded = [];

    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class, 'jamaah_id','id_pendaftaran');
    }
    public function detail_pembayaran_jamaah()
    {
        return $this->hasMany(DetailPembayaranJamaah::class, 'pembayaran_id', 'id_pembayaran');
    }
    
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    protected $table = 'transaksi';
    protected $guarded = [];

    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'rekening_id','id_rekening');
    }
    public function detail_pembayaran_jamaah()
    {
        return $this->belongsTo(DetailPembayaranJamaah::class,'detail_pembayaran_jamaah_id','id_detail_pembayaran_jamaah');
    }
}
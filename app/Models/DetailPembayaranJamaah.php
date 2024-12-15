<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaranJamaah extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail_pembayaran_jamaah';
    protected $table = 'detail_pembayaran_jamaah';
    protected $guarded = [];

    public function pembayaran_jamaah()
    {
        return $this->belongsTo(PembayaranJamaah::class,'pembayaran_id', 'id_pembayaran');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id','id');
    }
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'detail_pembayaran_jamaah_id','id_detail_pembayaran_jamaah');
    }
}
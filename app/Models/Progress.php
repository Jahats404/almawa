<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $primaryKey = "id_progress";
    protected $table = 'progress';
    protected $guarded = [];

    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class,'jamaah_id','id_pendaftaran');
    }
}
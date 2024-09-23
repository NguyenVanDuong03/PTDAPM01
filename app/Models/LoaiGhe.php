<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoaiGhe extends Model
{
    use SoftDeletes;
    protected $fillable = ['TenLoaiGhe','GiaVe'];
    protected $primaryKey = 'MaLoaiGhe';
    protected $table = 'loai_ghes';
    protected $dates = ['deleted_at'];
    public function ghengoi()
    {
        return $this->hasMany(GheNgoi::class);
    }
    public function lichsugiave()
    {
        return $this->hasMany(LichSuGiaVe::class);
    }
}

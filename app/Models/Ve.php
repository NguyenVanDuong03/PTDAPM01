<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ve extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaVe';
    public $fillable = ['MaHoaDon', 'MaLichChieu', 'MaGhe'];
}

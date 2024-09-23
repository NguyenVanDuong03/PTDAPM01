<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon_DoAn extends Model
{
    use HasFactory;
    public $fillable = ['MaDoAn', 'MaHoaDon', 'SoLuongMua'];
}

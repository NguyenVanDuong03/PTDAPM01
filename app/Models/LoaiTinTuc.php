<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTinTuc extends Model
{
    use HasFactory;

    protected $primaryKey = 'MaLoaiTinTuc';
    public $fillable = ['TenLoaiTinTuc', 'MoTa'];
}

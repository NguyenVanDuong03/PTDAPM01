<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiPhong extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaLoaiPhong';

    public $fillable = ['TenLoaiPhong'];
}

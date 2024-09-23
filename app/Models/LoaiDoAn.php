<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoaiDoAn extends Model
{
    use HasFactory;
    public $fillable = ['TenTheLoai', 'MoTa'];
    protected $primaryKey = 'MaTheLoai';
    use SoftDeletes;
}

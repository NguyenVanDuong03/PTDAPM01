<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TheLoai extends Model
{
    use SoftDeletes;
    protected $fillable = ['TenTheLoai', 'MoTa'];
    protected $table = 'the_loais';
    protected $primaryKey = 'MaTheLoai';
    protected $dates = ['deleted_at'];
    public function phims()
    {
        return $this->hasMany(Phim::class);
    }
}

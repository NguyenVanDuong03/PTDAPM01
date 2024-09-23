<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhaCungCap extends Model
{
    protected $table = 'nha_cung_caps';
    protected $primaryKey = 'MaNCC';
    use SoftDeletes;
    protected $fillable = [
        'TenNCC',
        'TinhTrang',
        'QuocGia',
    ];

    protected $dates = ['deleted_at'];
    public function phims()
    {
        return $this->hasMany(Phim::class);
    }
}

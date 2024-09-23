<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DoAn;
use Illuminate\Database\Eloquent\SoftDeletes;

class LichSuGiaDoAn extends Model
{
    use HasFactory;
    public $fillable = ['MaDoAn', 'ThoiGianTao', 'Gia'];
    protected $primaryKey = 'MaGiaDoAn';
    use SoftDeletes;
    public function getDoAn()
    {
        $doan = DoAn::withTrashed()->where('MaDoAn', $this->MaDoAn)->first();
        return $doan;
        // return DoAn::find($this->MaDoAn);
    }
}

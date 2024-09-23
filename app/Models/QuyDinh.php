<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuyDinh extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'MaQuyDinh';

    public $fillable = [ 'TieuDe','NoiDung'];

    protected $table = 'quy_dinhs';
    protected $dates = ['deleted_at'];

}

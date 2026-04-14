<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = ['nama', 'posisi','departemen_id'];
    public function departemen()
{
    return $this->belongsTo(Departemen::class);
}
}



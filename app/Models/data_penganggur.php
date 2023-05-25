<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_penganggur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_kota',
        'tahun_2020',
        'tahun_2021',
        'tahun_2022',
    ];
}

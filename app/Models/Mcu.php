<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcu extends Model
{
    use HasFactory;
    protected $table = 't_mcu';

    protected $fillable = [
        'id_mcu',
        'id_daftar',
        'tgl_mcu',
        'lab',
        'med_finding',
        'recommend',
        'id_conclusion',
        'jenis',
        'no_surat_mcu',
    ];
}

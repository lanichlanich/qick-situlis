<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarRuangan extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const KONDISI_RUANGAN_RADIO = [
        'Baik'         => 'Baik',
        'Rusak Ringan' => 'Rusak Ringan',
        'Rusak Sedang' => 'Rusak Sedang',
        'Rusak Berat'  => 'Rusak Berat',
    ];

    public $table = 'daftar_ruangans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_ruangan',
        'kondisi_ruangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

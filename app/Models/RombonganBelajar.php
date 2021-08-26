<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RombonganBelajar extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const JURUSAN_RADIO = [
        'MIPA' => 'MIPA',
        'IPS'  => 'IPS',
    ];

    public $table = 'rombongan_belajars';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_rombel',
        'jurusan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

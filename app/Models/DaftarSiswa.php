<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarSiswa extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_RADIO = [
        'Aktif'  => 'Aktif',
        'Keluar' => 'Keluar',
        'Lulus'  => 'Lulus',
    ];

    public $table = 'daftar_siswas';

    protected $dates = [
        'tgl_masuk',
        'tgl_keluar',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'no_induk',
        'nama_siswa',
        'nisn',
        'tgl_masuk',
        'asal_sekolah_id',
        'status',
        'tgl_keluar',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTglMasukAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglMasukAttribute($value)
    {
        $this->attributes['tgl_masuk'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function asal_sekolah()
    {
        return $this->belongsTo(SmpMt::class, 'asal_sekolah_id');
    }

    public function getTglKeluarAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglKeluarAttribute($value)
    {
        $this->attributes['tgl_keluar'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SkCpn extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const PANGKAT_GOLONGAN_SELECT = [
        'II.A'  => 'II.A',
        'II.B'  => 'II.B',
        'II.C'  => 'II.C',
        'II.D'  => 'II.D',
        'III.A' => 'III.A',
        'III.B' => 'III.B',
        'III.C' => 'III.C',
        'III.D' => 'III.D',
    ];

    public $table = 'sk_cpns';

    protected $appends = [
        'softfile',
    ];

    protected $dates = [
        'tgl_surat',
        'tmt_cpns',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'no_surat',
        'tgl_surat',
        'nama_ptk_id',
        'tmt_cpns',
        'masa_kerja_golongan',
        'masa_kerja_bulan',
        'pangkat_golongan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getTglSuratAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglSuratAttribute($value)
    {
        $this->attributes['tgl_surat'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function nama_ptk()
    {
        return $this->belongsTo(Ptk::class, 'nama_ptk_id');
    }

    public function getTmtCpnsAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTmtCpnsAttribute($value)
    {
        $this->attributes['tmt_cpns'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSoftfileAttribute()
    {
        return $this->getMedia('softfile')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

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

class SkKgbPn extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'sk_kgb_pns';

    protected $appends = [
        'softfile',
    ];

    protected $dates = [
        'tgl_surat',
        'tmt_kgb',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'no_surat',
        'tgl_surat',
        'nama_ptk_id',
        'tmt_kgb',
        'masa_kerja_golongan',
        'masa_kerja_bulan',
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

    public function getTmtKgbAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTmtKgbAttribute($value)
    {
        $this->attributes['tmt_kgb'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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

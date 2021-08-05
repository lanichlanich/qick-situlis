<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArsipKependudukan extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'arsip_kependudukans';

    protected $appends = [
        'ktp',
        'kartu_keluarga',
        'akta_lahir',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_ptk_id',
        'no_nik',
        'no_kk',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function nama_ptk()
    {
        return $this->belongsTo(Ptk::class, 'nama_ptk_id');
    }

    public function getKtpAttribute()
    {
        return $this->getMedia('ktp')->last();
    }

    public function getKartuKeluargaAttribute()
    {
        return $this->getMedia('kartu_keluarga')->last();
    }

    public function getAktaLahirAttribute()
    {
        return $this->getMedia('akta_lahir')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

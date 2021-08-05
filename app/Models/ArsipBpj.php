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

class ArsipBpj extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'arsip_bpjs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'kartu_bpjs_pegawai',
        'kartu_bpjs_suami_istri',
        'kartu_anak_1',
        'kartu_anak_2',
        'kartu_anak_3',
    ];

    protected $fillable = [
        'nama_ptk_id',
        'no_bpjs_pegawai',
        'no_bpjs_suami_istri',
        'no_bpjs_anak_1',
        'no_bpjs_anak_2',
        'no_bpjs_anak_3',
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

    public function getKartuBpjsPegawaiAttribute()
    {
        return $this->getMedia('kartu_bpjs_pegawai')->last();
    }

    public function getKartuBpjsSuamiIstriAttribute()
    {
        return $this->getMedia('kartu_bpjs_suami_istri')->last();
    }

    public function getKartuAnak1Attribute()
    {
        return $this->getMedia('kartu_anak_1')->last();
    }

    public function getKartuAnak2Attribute()
    {
        return $this->getMedia('kartu_anak_2')->last();
    }

    public function getKartuAnak3Attribute()
    {
        return $this->getMedia('kartu_anak_3')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

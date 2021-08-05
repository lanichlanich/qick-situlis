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

class ArsipPnsLainnya extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'arsip_pns_lainnyas';

    protected $appends = [
        'karpeg',
        'karis_karsu',
        'taspen',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_ptk_id',
        'no_karpeg',
        'no_karis_karsu',
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

    public function getKarpegAttribute()
    {
        return $this->getMedia('karpeg')->last();
    }

    public function getKarisKarsuAttribute()
    {
        return $this->getMedia('karis_karsu')->last();
    }

    public function getTaspenAttribute()
    {
        return $this->getMedia('taspen')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

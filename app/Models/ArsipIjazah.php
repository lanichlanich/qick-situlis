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

class ArsipIjazah extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'arsip_ijazahs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_ptk_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'sd',
        'smp_mts',
        'sma_smk_ma',
        'd_3',
        's_1',
        's_2',
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

    public function getSdAttribute()
    {
        return $this->getMedia('sd')->last();
    }

    public function getSmpMtsAttribute()
    {
        return $this->getMedia('smp_mts')->last();
    }

    public function getSmaSmkMaAttribute()
    {
        return $this->getMedia('sma_smk_ma')->last();
    }

    public function getD3Attribute()
    {
        return $this->getMedia('d_3')->last();
    }

    public function getS1Attribute()
    {
        return $this->getMedia('s_1')->last();
    }

    public function getS2Attribute()
    {
        return $this->getMedia('s_2')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

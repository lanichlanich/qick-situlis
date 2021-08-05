<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarBukuPerpustakaan extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'daftar_buku_perpustakaans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_buku_id',
        'jumlah',
        'tempat_penyimpanan_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function nama_buku()
    {
        return $this->belongsTo(DaftarBuku::class, 'nama_buku_id');
    }

    public function tempat_penyimpanan()
    {
        return $this->belongsTo(TempatPenyimpananBuku::class, 'tempat_penyimpanan_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarInventarisBarang extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_RADIO = [
        'Layak'             => 'Layak',
        'Tidak Layak/Rusak' => 'Tidak Layak/Rusak',
        'Hilang'            => 'Hilang',
    ];

    public $table = 'daftar_inventaris_barangs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_barang_id',
        'jumlah',
        'daftar_ruangan_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function nama_barang()
    {
        return $this->belongsTo(DaftarNamaBarang::class, 'nama_barang_id');
    }

    public function daftar_ruangan()
    {
        return $this->belongsTo(DaftarRuangan::class, 'daftar_ruangan_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeminjamanBuku extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_RADIO = [
        'Sedang dipinjam'    => 'Sedang dipinjam',
        'Sudah dikembalikan' => 'Sudah dikembalikan',
    ];

    public $table = 'peminjaman_bukus';

    protected $dates = [
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'peminjam_buku_id',
        'nama_buku_id',
        'tempat_penyimpanan_buku_id',
        'jumlah_pinjam',
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function peminjam_buku()
    {
        return $this->belongsTo(PeminjamBuku::class, 'peminjam_buku_id');
    }

    public function nama_buku()
    {
        return $this->belongsTo(DaftarBuku::class, 'nama_buku_id');
    }

    public function tempat_penyimpanan_buku()
    {
        return $this->belongsTo(TempatPenyimpananBuku::class, 'tempat_penyimpanan_buku_id');
    }

    public function getTanggalPinjamAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalPinjamAttribute($value)
    {
        $this->attributes['tanggal_pinjam'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getTanggalPengembalianAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalPengembalianAttribute($value)
    {
        $this->attributes['tanggal_pengembalian'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 24,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 25,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 26,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 27,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 28,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 29,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 30,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 31,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 32,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 33,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 34,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 35,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 36,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 37,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 38,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 39,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 40,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 41,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 42,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 43,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 44,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 45,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 46,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 47,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 48,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 49,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 50,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 51,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 52,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 53,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 54,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 55,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 56,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 57,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 58,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 59,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 60,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 61,
                'title' => 'expense_create',
            ],
            [
                'id'    => 62,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 63,
                'title' => 'expense_show',
            ],
            [
                'id'    => 64,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 65,
                'title' => 'expense_access',
            ],
            [
                'id'    => 66,
                'title' => 'income_create',
            ],
            [
                'id'    => 67,
                'title' => 'income_edit',
            ],
            [
                'id'    => 68,
                'title' => 'income_show',
            ],
            [
                'id'    => 69,
                'title' => 'income_delete',
            ],
            [
                'id'    => 70,
                'title' => 'income_access',
            ],
            [
                'id'    => 71,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 72,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 73,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 74,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 75,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 76,
                'title' => 'persuratan_access',
            ],
            [
                'id'    => 77,
                'title' => 'surat_keluar_create',
            ],
            [
                'id'    => 78,
                'title' => 'surat_keluar_edit',
            ],
            [
                'id'    => 79,
                'title' => 'surat_keluar_show',
            ],
            [
                'id'    => 80,
                'title' => 'surat_keluar_delete',
            ],
            [
                'id'    => 81,
                'title' => 'surat_keluar_access',
            ],
            [
                'id'    => 82,
                'title' => 'surat_masuk_create',
            ],
            [
                'id'    => 83,
                'title' => 'surat_masuk_edit',
            ],
            [
                'id'    => 84,
                'title' => 'surat_masuk_show',
            ],
            [
                'id'    => 85,
                'title' => 'surat_masuk_delete',
            ],
            [
                'id'    => 86,
                'title' => 'surat_masuk_access',
            ],
            [
                'id'    => 87,
                'title' => 'sk_kgb_pn_create',
            ],
            [
                'id'    => 88,
                'title' => 'sk_kgb_pn_edit',
            ],
            [
                'id'    => 89,
                'title' => 'sk_kgb_pn_show',
            ],
            [
                'id'    => 90,
                'title' => 'sk_kgb_pn_delete',
            ],
            [
                'id'    => 91,
                'title' => 'sk_kgb_pn_access',
            ],
            [
                'id'    => 92,
                'title' => 'sk_cpn_create',
            ],
            [
                'id'    => 93,
                'title' => 'sk_cpn_edit',
            ],
            [
                'id'    => 94,
                'title' => 'sk_cpn_show',
            ],
            [
                'id'    => 95,
                'title' => 'sk_cpn_delete',
            ],
            [
                'id'    => 96,
                'title' => 'sk_cpn_access',
            ],
            [
                'id'    => 97,
                'title' => 'sk_kepangkatan_pn_create',
            ],
            [
                'id'    => 98,
                'title' => 'sk_kepangkatan_pn_edit',
            ],
            [
                'id'    => 99,
                'title' => 'sk_kepangkatan_pn_show',
            ],
            [
                'id'    => 100,
                'title' => 'sk_kepangkatan_pn_delete',
            ],
            [
                'id'    => 101,
                'title' => 'sk_kepangkatan_pn_access',
            ],
            [
                'id'    => 102,
                'title' => 'sk_pengangkatan_honorer_create',
            ],
            [
                'id'    => 103,
                'title' => 'sk_pengangkatan_honorer_edit',
            ],
            [
                'id'    => 104,
                'title' => 'sk_pengangkatan_honorer_show',
            ],
            [
                'id'    => 105,
                'title' => 'sk_pengangkatan_honorer_delete',
            ],
            [
                'id'    => 106,
                'title' => 'sk_pengangkatan_honorer_access',
            ],
            [
                'id'    => 107,
                'title' => 'ptk_create',
            ],
            [
                'id'    => 108,
                'title' => 'ptk_edit',
            ],
            [
                'id'    => 109,
                'title' => 'ptk_show',
            ],
            [
                'id'    => 110,
                'title' => 'ptk_delete',
            ],
            [
                'id'    => 111,
                'title' => 'ptk_access',
            ],
            [
                'id'    => 112,
                'title' => 'arsip_digital_access',
            ],
            [
                'id'    => 113,
                'title' => 'arsip_ijazah_create',
            ],
            [
                'id'    => 114,
                'title' => 'arsip_ijazah_edit',
            ],
            [
                'id'    => 115,
                'title' => 'arsip_ijazah_show',
            ],
            [
                'id'    => 116,
                'title' => 'arsip_ijazah_delete',
            ],
            [
                'id'    => 117,
                'title' => 'arsip_ijazah_access',
            ],
            [
                'id'    => 118,
                'title' => 'arsip_bpj_create',
            ],
            [
                'id'    => 119,
                'title' => 'arsip_bpj_edit',
            ],
            [
                'id'    => 120,
                'title' => 'arsip_bpj_show',
            ],
            [
                'id'    => 121,
                'title' => 'arsip_bpj_delete',
            ],
            [
                'id'    => 122,
                'title' => 'arsip_bpj_access',
            ],
            [
                'id'    => 123,
                'title' => 'arsip_pns_lainnya_create',
            ],
            [
                'id'    => 124,
                'title' => 'arsip_pns_lainnya_edit',
            ],
            [
                'id'    => 125,
                'title' => 'arsip_pns_lainnya_show',
            ],
            [
                'id'    => 126,
                'title' => 'arsip_pns_lainnya_delete',
            ],
            [
                'id'    => 127,
                'title' => 'arsip_pns_lainnya_access',
            ],
            [
                'id'    => 128,
                'title' => 'arsip_npwp_create',
            ],
            [
                'id'    => 129,
                'title' => 'arsip_npwp_edit',
            ],
            [
                'id'    => 130,
                'title' => 'arsip_npwp_show',
            ],
            [
                'id'    => 131,
                'title' => 'arsip_npwp_delete',
            ],
            [
                'id'    => 132,
                'title' => 'arsip_npwp_access',
            ],
            [
                'id'    => 133,
                'title' => 'arsip_kependudukan_create',
            ],
            [
                'id'    => 134,
                'title' => 'arsip_kependudukan_edit',
            ],
            [
                'id'    => 135,
                'title' => 'arsip_kependudukan_show',
            ],
            [
                'id'    => 136,
                'title' => 'arsip_kependudukan_delete',
            ],
            [
                'id'    => 137,
                'title' => 'arsip_kependudukan_access',
            ],
            [
                'id'    => 138,
                'title' => 'perpustakaan_access',
            ],
            [
                'id'    => 139,
                'title' => 'tempat_penyimpanan_buku_create',
            ],
            [
                'id'    => 140,
                'title' => 'tempat_penyimpanan_buku_edit',
            ],
            [
                'id'    => 141,
                'title' => 'tempat_penyimpanan_buku_show',
            ],
            [
                'id'    => 142,
                'title' => 'tempat_penyimpanan_buku_delete',
            ],
            [
                'id'    => 143,
                'title' => 'tempat_penyimpanan_buku_access',
            ],
            [
                'id'    => 144,
                'title' => 'daftar_buku_create',
            ],
            [
                'id'    => 145,
                'title' => 'daftar_buku_edit',
            ],
            [
                'id'    => 146,
                'title' => 'daftar_buku_show',
            ],
            [
                'id'    => 147,
                'title' => 'daftar_buku_delete',
            ],
            [
                'id'    => 148,
                'title' => 'daftar_buku_access',
            ],
            [
                'id'    => 149,
                'title' => 'daftar_buku_perpustakaan_create',
            ],
            [
                'id'    => 150,
                'title' => 'daftar_buku_perpustakaan_edit',
            ],
            [
                'id'    => 151,
                'title' => 'daftar_buku_perpustakaan_show',
            ],
            [
                'id'    => 152,
                'title' => 'daftar_buku_perpustakaan_delete',
            ],
            [
                'id'    => 153,
                'title' => 'daftar_buku_perpustakaan_access',
            ],
            [
                'id'    => 154,
                'title' => 'peminjam_buku_create',
            ],
            [
                'id'    => 155,
                'title' => 'peminjam_buku_edit',
            ],
            [
                'id'    => 156,
                'title' => 'peminjam_buku_show',
            ],
            [
                'id'    => 157,
                'title' => 'peminjam_buku_delete',
            ],
            [
                'id'    => 158,
                'title' => 'peminjam_buku_access',
            ],
            [
                'id'    => 159,
                'title' => 'peminjaman_buku_create',
            ],
            [
                'id'    => 160,
                'title' => 'peminjaman_buku_edit',
            ],
            [
                'id'    => 161,
                'title' => 'peminjaman_buku_show',
            ],
            [
                'id'    => 162,
                'title' => 'peminjaman_buku_delete',
            ],
            [
                'id'    => 163,
                'title' => 'peminjaman_buku_access',
            ],
            [
                'id'    => 164,
                'title' => 'inventaris_barang_access',
            ],
            [
                'id'    => 165,
                'title' => 'daftar_ruangan_create',
            ],
            [
                'id'    => 166,
                'title' => 'daftar_ruangan_edit',
            ],
            [
                'id'    => 167,
                'title' => 'daftar_ruangan_show',
            ],
            [
                'id'    => 168,
                'title' => 'daftar_ruangan_delete',
            ],
            [
                'id'    => 169,
                'title' => 'daftar_ruangan_access',
            ],
            [
                'id'    => 170,
                'title' => 'daftar_nama_barang_create',
            ],
            [
                'id'    => 171,
                'title' => 'daftar_nama_barang_edit',
            ],
            [
                'id'    => 172,
                'title' => 'daftar_nama_barang_show',
            ],
            [
                'id'    => 173,
                'title' => 'daftar_nama_barang_delete',
            ],
            [
                'id'    => 174,
                'title' => 'daftar_nama_barang_access',
            ],
            [
                'id'    => 175,
                'title' => 'daftar_inventaris_barang_create',
            ],
            [
                'id'    => 176,
                'title' => 'daftar_inventaris_barang_edit',
            ],
            [
                'id'    => 177,
                'title' => 'daftar_inventaris_barang_show',
            ],
            [
                'id'    => 178,
                'title' => 'daftar_inventaris_barang_delete',
            ],
            [
                'id'    => 179,
                'title' => 'daftar_inventaris_barang_access',
            ],
            [
                'id'    => 180,
                'title' => 'kepegawaian_access',
            ],
            [
                'id'    => 181,
                'title' => 'kesiswaan_access',
            ],
            [
                'id'    => 182,
                'title' => 'tahun_ajaran_create',
            ],
            [
                'id'    => 183,
                'title' => 'tahun_ajaran_edit',
            ],
            [
                'id'    => 184,
                'title' => 'tahun_ajaran_show',
            ],
            [
                'id'    => 185,
                'title' => 'tahun_ajaran_delete',
            ],
            [
                'id'    => 186,
                'title' => 'tahun_ajaran_access',
            ],
            [
                'id'    => 187,
                'title' => 'rombongan_belajar_create',
            ],
            [
                'id'    => 188,
                'title' => 'rombongan_belajar_edit',
            ],
            [
                'id'    => 189,
                'title' => 'rombongan_belajar_show',
            ],
            [
                'id'    => 190,
                'title' => 'rombongan_belajar_delete',
            ],
            [
                'id'    => 191,
                'title' => 'rombongan_belajar_access',
            ],
            [
                'id'    => 192,
                'title' => 'data_model_access',
            ],
            [
                'id'    => 193,
                'title' => 'penghasilan_create',
            ],
            [
                'id'    => 194,
                'title' => 'penghasilan_edit',
            ],
            [
                'id'    => 195,
                'title' => 'penghasilan_show',
            ],
            [
                'id'    => 196,
                'title' => 'penghasilan_delete',
            ],
            [
                'id'    => 197,
                'title' => 'penghasilan_access',
            ],
            [
                'id'    => 198,
                'title' => 'pendidikan_terakhir_create',
            ],
            [
                'id'    => 199,
                'title' => 'pendidikan_terakhir_edit',
            ],
            [
                'id'    => 200,
                'title' => 'pendidikan_terakhir_show',
            ],
            [
                'id'    => 201,
                'title' => 'pendidikan_terakhir_delete',
            ],
            [
                'id'    => 202,
                'title' => 'pendidikan_terakhir_access',
            ],
            [
                'id'    => 203,
                'title' => 'kabupaten_create',
            ],
            [
                'id'    => 204,
                'title' => 'kabupaten_edit',
            ],
            [
                'id'    => 205,
                'title' => 'kabupaten_show',
            ],
            [
                'id'    => 206,
                'title' => 'kabupaten_delete',
            ],
            [
                'id'    => 207,
                'title' => 'kabupaten_access',
            ],
            [
                'id'    => 208,
                'title' => 'kecamatan_create',
            ],
            [
                'id'    => 209,
                'title' => 'kecamatan_edit',
            ],
            [
                'id'    => 210,
                'title' => 'kecamatan_show',
            ],
            [
                'id'    => 211,
                'title' => 'kecamatan_delete',
            ],
            [
                'id'    => 212,
                'title' => 'kecamatan_access',
            ],
            [
                'id'    => 213,
                'title' => 'agama_create',
            ],
            [
                'id'    => 214,
                'title' => 'agama_edit',
            ],
            [
                'id'    => 215,
                'title' => 'agama_show',
            ],
            [
                'id'    => 216,
                'title' => 'agama_delete',
            ],
            [
                'id'    => 217,
                'title' => 'agama_access',
            ],
            [
                'id'    => 218,
                'title' => 'no_urut_create',
            ],
            [
                'id'    => 219,
                'title' => 'no_urut_edit',
            ],
            [
                'id'    => 220,
                'title' => 'no_urut_show',
            ],
            [
                'id'    => 221,
                'title' => 'no_urut_delete',
            ],
            [
                'id'    => 222,
                'title' => 'no_urut_access',
            ],
            [
                'id'    => 223,
                'title' => 'bahasa_create',
            ],
            [
                'id'    => 224,
                'title' => 'bahasa_edit',
            ],
            [
                'id'    => 225,
                'title' => 'bahasa_show',
            ],
            [
                'id'    => 226,
                'title' => 'bahasa_delete',
            ],
            [
                'id'    => 227,
                'title' => 'bahasa_access',
            ],
            [
                'id'    => 228,
                'title' => 'desa_create',
            ],
            [
                'id'    => 229,
                'title' => 'desa_edit',
            ],
            [
                'id'    => 230,
                'title' => 'desa_show',
            ],
            [
                'id'    => 231,
                'title' => 'desa_delete',
            ],
            [
                'id'    => 232,
                'title' => 'desa_access',
            ],
            [
                'id'    => 233,
                'title' => 'moda_transportasi_create',
            ],
            [
                'id'    => 234,
                'title' => 'moda_transportasi_edit',
            ],
            [
                'id'    => 235,
                'title' => 'moda_transportasi_show',
            ],
            [
                'id'    => 236,
                'title' => 'moda_transportasi_delete',
            ],
            [
                'id'    => 237,
                'title' => 'moda_transportasi_access',
            ],
            [
                'id'    => 238,
                'title' => 'tahun_create',
            ],
            [
                'id'    => 239,
                'title' => 'tahun_edit',
            ],
            [
                'id'    => 240,
                'title' => 'tahun_show',
            ],
            [
                'id'    => 241,
                'title' => 'tahun_delete',
            ],
            [
                'id'    => 242,
                'title' => 'tahun_access',
            ],
            [
                'id'    => 243,
                'title' => 'smp_mt_create',
            ],
            [
                'id'    => 244,
                'title' => 'smp_mt_edit',
            ],
            [
                'id'    => 245,
                'title' => 'smp_mt_show',
            ],
            [
                'id'    => 246,
                'title' => 'smp_mt_delete',
            ],
            [
                'id'    => 247,
                'title' => 'smp_mt_access',
            ],
            [
                'id'    => 248,
                'title' => 'kela_create',
            ],
            [
                'id'    => 249,
                'title' => 'kela_edit',
            ],
            [
                'id'    => 250,
                'title' => 'kela_show',
            ],
            [
                'id'    => 251,
                'title' => 'kela_delete',
            ],
            [
                'id'    => 252,
                'title' => 'kela_access',
            ],
            [
                'id'    => 253,
                'title' => 'mata_pelajaran_create',
            ],
            [
                'id'    => 254,
                'title' => 'mata_pelajaran_edit',
            ],
            [
                'id'    => 255,
                'title' => 'mata_pelajaran_show',
            ],
            [
                'id'    => 256,
                'title' => 'mata_pelajaran_delete',
            ],
            [
                'id'    => 257,
                'title' => 'mata_pelajaran_access',
            ],
            [
                'id'    => 258,
                'title' => 'pangkat_golongan_create',
            ],
            [
                'id'    => 259,
                'title' => 'pangkat_golongan_edit',
            ],
            [
                'id'    => 260,
                'title' => 'pangkat_golongan_show',
            ],
            [
                'id'    => 261,
                'title' => 'pangkat_golongan_delete',
            ],
            [
                'id'    => 262,
                'title' => 'pangkat_golongan_access',
            ],
            [
                'id'    => 263,
                'title' => 'tugas_tambahan_create',
            ],
            [
                'id'    => 264,
                'title' => 'tugas_tambahan_edit',
            ],
            [
                'id'    => 265,
                'title' => 'tugas_tambahan_show',
            ],
            [
                'id'    => 266,
                'title' => 'tugas_tambahan_delete',
            ],
            [
                'id'    => 267,
                'title' => 'tugas_tambahan_access',
            ],
            [
                'id'    => 268,
                'title' => 'pekerjaan_create',
            ],
            [
                'id'    => 269,
                'title' => 'pekerjaan_edit',
            ],
            [
                'id'    => 270,
                'title' => 'pekerjaan_show',
            ],
            [
                'id'    => 271,
                'title' => 'pekerjaan_delete',
            ],
            [
                'id'    => 272,
                'title' => 'pekerjaan_access',
            ],
            [
                'id'    => 273,
                'title' => 'daftar_siswa_create',
            ],
            [
                'id'    => 274,
                'title' => 'daftar_siswa_edit',
            ],
            [
                'id'    => 275,
                'title' => 'daftar_siswa_show',
            ],
            [
                'id'    => 276,
                'title' => 'daftar_siswa_delete',
            ],
            [
                'id'    => 277,
                'title' => 'daftar_siswa_access',
            ],
            [
                'id'    => 278,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}

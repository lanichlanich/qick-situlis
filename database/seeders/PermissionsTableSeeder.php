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
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 24,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 25,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 26,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 27,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 28,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 29,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 30,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 31,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 32,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 33,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 34,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 35,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 36,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 37,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 38,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 39,
                'title' => 'asset_create',
            ],
            [
                'id'    => 40,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 41,
                'title' => 'asset_show',
            ],
            [
                'id'    => 42,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 43,
                'title' => 'asset_access',
            ],
            [
                'id'    => 44,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 45,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 46,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 47,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 48,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 49,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 50,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 51,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 52,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 53,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 54,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 55,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 56,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 57,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 58,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 59,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 60,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 61,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 62,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 63,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 64,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 65,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 66,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 67,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 68,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 69,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 70,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 71,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 72,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 73,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 74,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 75,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 76,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 77,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 78,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 79,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 80,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 81,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 82,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 83,
                'title' => 'expense_create',
            ],
            [
                'id'    => 84,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 85,
                'title' => 'expense_show',
            ],
            [
                'id'    => 86,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 87,
                'title' => 'expense_access',
            ],
            [
                'id'    => 88,
                'title' => 'income_create',
            ],
            [
                'id'    => 89,
                'title' => 'income_edit',
            ],
            [
                'id'    => 90,
                'title' => 'income_show',
            ],
            [
                'id'    => 91,
                'title' => 'income_delete',
            ],
            [
                'id'    => 92,
                'title' => 'income_access',
            ],
            [
                'id'    => 93,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 94,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 95,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 96,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 97,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 98,
                'title' => 'persuratan_access',
            ],
            [
                'id'    => 99,
                'title' => 'surat_keluar_create',
            ],
            [
                'id'    => 100,
                'title' => 'surat_keluar_edit',
            ],
            [
                'id'    => 101,
                'title' => 'surat_keluar_show',
            ],
            [
                'id'    => 102,
                'title' => 'surat_keluar_delete',
            ],
            [
                'id'    => 103,
                'title' => 'surat_keluar_access',
            ],
            [
                'id'    => 104,
                'title' => 'surat_masuk_create',
            ],
            [
                'id'    => 105,
                'title' => 'surat_masuk_edit',
            ],
            [
                'id'    => 106,
                'title' => 'surat_masuk_show',
            ],
            [
                'id'    => 107,
                'title' => 'surat_masuk_delete',
            ],
            [
                'id'    => 108,
                'title' => 'surat_masuk_access',
            ],
            [
                'id'    => 109,
                'title' => 'sk_kgb_pn_create',
            ],
            [
                'id'    => 110,
                'title' => 'sk_kgb_pn_edit',
            ],
            [
                'id'    => 111,
                'title' => 'sk_kgb_pn_show',
            ],
            [
                'id'    => 112,
                'title' => 'sk_kgb_pn_delete',
            ],
            [
                'id'    => 113,
                'title' => 'sk_kgb_pn_access',
            ],
            [
                'id'    => 114,
                'title' => 'sk_cpn_create',
            ],
            [
                'id'    => 115,
                'title' => 'sk_cpn_edit',
            ],
            [
                'id'    => 116,
                'title' => 'sk_cpn_show',
            ],
            [
                'id'    => 117,
                'title' => 'sk_cpn_delete',
            ],
            [
                'id'    => 118,
                'title' => 'sk_cpn_access',
            ],
            [
                'id'    => 119,
                'title' => 'sk_kepangkatan_pn_create',
            ],
            [
                'id'    => 120,
                'title' => 'sk_kepangkatan_pn_edit',
            ],
            [
                'id'    => 121,
                'title' => 'sk_kepangkatan_pn_show',
            ],
            [
                'id'    => 122,
                'title' => 'sk_kepangkatan_pn_delete',
            ],
            [
                'id'    => 123,
                'title' => 'sk_kepangkatan_pn_access',
            ],
            [
                'id'    => 124,
                'title' => 'sk_pengangkatan_honorer_create',
            ],
            [
                'id'    => 125,
                'title' => 'sk_pengangkatan_honorer_edit',
            ],
            [
                'id'    => 126,
                'title' => 'sk_pengangkatan_honorer_show',
            ],
            [
                'id'    => 127,
                'title' => 'sk_pengangkatan_honorer_delete',
            ],
            [
                'id'    => 128,
                'title' => 'sk_pengangkatan_honorer_access',
            ],
            [
                'id'    => 129,
                'title' => 'ptk_create',
            ],
            [
                'id'    => 130,
                'title' => 'ptk_edit',
            ],
            [
                'id'    => 131,
                'title' => 'ptk_show',
            ],
            [
                'id'    => 132,
                'title' => 'ptk_delete',
            ],
            [
                'id'    => 133,
                'title' => 'ptk_access',
            ],
            [
                'id'    => 134,
                'title' => 'arsip_digital_access',
            ],
            [
                'id'    => 135,
                'title' => 'arsip_ijazah_create',
            ],
            [
                'id'    => 136,
                'title' => 'arsip_ijazah_edit',
            ],
            [
                'id'    => 137,
                'title' => 'arsip_ijazah_show',
            ],
            [
                'id'    => 138,
                'title' => 'arsip_ijazah_delete',
            ],
            [
                'id'    => 139,
                'title' => 'arsip_ijazah_access',
            ],
            [
                'id'    => 140,
                'title' => 'arsip_bpj_create',
            ],
            [
                'id'    => 141,
                'title' => 'arsip_bpj_edit',
            ],
            [
                'id'    => 142,
                'title' => 'arsip_bpj_show',
            ],
            [
                'id'    => 143,
                'title' => 'arsip_bpj_delete',
            ],
            [
                'id'    => 144,
                'title' => 'arsip_bpj_access',
            ],
            [
                'id'    => 145,
                'title' => 'arsip_pns_lainnya_create',
            ],
            [
                'id'    => 146,
                'title' => 'arsip_pns_lainnya_edit',
            ],
            [
                'id'    => 147,
                'title' => 'arsip_pns_lainnya_show',
            ],
            [
                'id'    => 148,
                'title' => 'arsip_pns_lainnya_delete',
            ],
            [
                'id'    => 149,
                'title' => 'arsip_pns_lainnya_access',
            ],
            [
                'id'    => 150,
                'title' => 'arsip_npwp_create',
            ],
            [
                'id'    => 151,
                'title' => 'arsip_npwp_edit',
            ],
            [
                'id'    => 152,
                'title' => 'arsip_npwp_show',
            ],
            [
                'id'    => 153,
                'title' => 'arsip_npwp_delete',
            ],
            [
                'id'    => 154,
                'title' => 'arsip_npwp_access',
            ],
            [
                'id'    => 155,
                'title' => 'arsip_kependudukan_create',
            ],
            [
                'id'    => 156,
                'title' => 'arsip_kependudukan_edit',
            ],
            [
                'id'    => 157,
                'title' => 'arsip_kependudukan_show',
            ],
            [
                'id'    => 158,
                'title' => 'arsip_kependudukan_delete',
            ],
            [
                'id'    => 159,
                'title' => 'arsip_kependudukan_access',
            ],
            [
                'id'    => 160,
                'title' => 'perpustakaan_access',
            ],
            [
                'id'    => 161,
                'title' => 'tempat_penyimpanan_buku_create',
            ],
            [
                'id'    => 162,
                'title' => 'tempat_penyimpanan_buku_edit',
            ],
            [
                'id'    => 163,
                'title' => 'tempat_penyimpanan_buku_show',
            ],
            [
                'id'    => 164,
                'title' => 'tempat_penyimpanan_buku_delete',
            ],
            [
                'id'    => 165,
                'title' => 'tempat_penyimpanan_buku_access',
            ],
            [
                'id'    => 166,
                'title' => 'daftar_buku_create',
            ],
            [
                'id'    => 167,
                'title' => 'daftar_buku_edit',
            ],
            [
                'id'    => 168,
                'title' => 'daftar_buku_show',
            ],
            [
                'id'    => 169,
                'title' => 'daftar_buku_delete',
            ],
            [
                'id'    => 170,
                'title' => 'daftar_buku_access',
            ],
            [
                'id'    => 171,
                'title' => 'daftar_buku_perpustakaan_create',
            ],
            [
                'id'    => 172,
                'title' => 'daftar_buku_perpustakaan_edit',
            ],
            [
                'id'    => 173,
                'title' => 'daftar_buku_perpustakaan_show',
            ],
            [
                'id'    => 174,
                'title' => 'daftar_buku_perpustakaan_delete',
            ],
            [
                'id'    => 175,
                'title' => 'daftar_buku_perpustakaan_access',
            ],
            [
                'id'    => 176,
                'title' => 'peminjam_buku_create',
            ],
            [
                'id'    => 177,
                'title' => 'peminjam_buku_edit',
            ],
            [
                'id'    => 178,
                'title' => 'peminjam_buku_show',
            ],
            [
                'id'    => 179,
                'title' => 'peminjam_buku_delete',
            ],
            [
                'id'    => 180,
                'title' => 'peminjam_buku_access',
            ],
            [
                'id'    => 181,
                'title' => 'peminjaman_buku_create',
            ],
            [
                'id'    => 182,
                'title' => 'peminjaman_buku_edit',
            ],
            [
                'id'    => 183,
                'title' => 'peminjaman_buku_show',
            ],
            [
                'id'    => 184,
                'title' => 'peminjaman_buku_delete',
            ],
            [
                'id'    => 185,
                'title' => 'peminjaman_buku_access',
            ],
            [
                'id'    => 186,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}

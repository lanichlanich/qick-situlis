<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Content Category
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Content Tag
    Route::apiResource('content-tags', 'ContentTagApiController');

    // Content Page
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Expense Category
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Category
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expense
    Route::apiResource('expenses', 'ExpenseApiController');

    // Income
    Route::apiResource('incomes', 'IncomeApiController');

    // Surat Keluar
    Route::post('surat-keluars/media', 'SuratKeluarApiController@storeMedia')->name('surat-keluars.storeMedia');
    Route::apiResource('surat-keluars', 'SuratKeluarApiController');

    // Surat Masuk
    Route::post('surat-masuks/media', 'SuratMasukApiController@storeMedia')->name('surat-masuks.storeMedia');
    Route::apiResource('surat-masuks', 'SuratMasukApiController');

    // Sk Kgb Pns
    Route::post('sk-kgb-pns/media', 'SkKgbPnsApiController@storeMedia')->name('sk-kgb-pns.storeMedia');
    Route::apiResource('sk-kgb-pns', 'SkKgbPnsApiController');

    // Sk Cpns
    Route::post('sk-cpns/media', 'SkCpnsApiController@storeMedia')->name('sk-cpns.storeMedia');
    Route::apiResource('sk-cpns', 'SkCpnsApiController');

    // Sk Kepangkatan Pns
    Route::post('sk-kepangkatan-pns/media', 'SkKepangkatanPnsApiController@storeMedia')->name('sk-kepangkatan-pns.storeMedia');
    Route::apiResource('sk-kepangkatan-pns', 'SkKepangkatanPnsApiController');

    // Sk Pengangkatan Honorer
    Route::post('sk-pengangkatan-honorers/media', 'SkPengangkatanHonorerApiController@storeMedia')->name('sk-pengangkatan-honorers.storeMedia');
    Route::apiResource('sk-pengangkatan-honorers', 'SkPengangkatanHonorerApiController');

    // Ptk
    Route::apiResource('ptks', 'PtkApiController');

    // Arsip Ijazah
    Route::post('arsip-ijazahs/media', 'ArsipIjazahApiController@storeMedia')->name('arsip-ijazahs.storeMedia');
    Route::apiResource('arsip-ijazahs', 'ArsipIjazahApiController');

    // Arsip Bpjs
    Route::post('arsip-bpjs/media', 'ArsipBpjsApiController@storeMedia')->name('arsip-bpjs.storeMedia');
    Route::apiResource('arsip-bpjs', 'ArsipBpjsApiController');

    // Arsip Pns Lainnya
    Route::post('arsip-pns-lainnyas/media', 'ArsipPnsLainnyaApiController@storeMedia')->name('arsip-pns-lainnyas.storeMedia');
    Route::apiResource('arsip-pns-lainnyas', 'ArsipPnsLainnyaApiController');

    // Arsip Npwp
    Route::post('arsip-npwps/media', 'ArsipNpwpApiController@storeMedia')->name('arsip-npwps.storeMedia');
    Route::apiResource('arsip-npwps', 'ArsipNpwpApiController');

    // Arsip Kependudukan
    Route::post('arsip-kependudukans/media', 'ArsipKependudukanApiController@storeMedia')->name('arsip-kependudukans.storeMedia');
    Route::apiResource('arsip-kependudukans', 'ArsipKependudukanApiController');

    // Tempat Penyimpanan Buku
    Route::apiResource('tempat-penyimpanan-bukus', 'TempatPenyimpananBukuApiController');

    // Daftar Buku
    Route::apiResource('daftar-bukus', 'DaftarBukuApiController');

    // Daftar Buku Perpustakaan
    Route::apiResource('daftar-buku-perpustakaans', 'DaftarBukuPerpustakaanApiController');

    // Peminjam Buku
    Route::apiResource('peminjam-bukus', 'PeminjamBukuApiController');

    // Peminjaman Buku
    Route::apiResource('peminjaman-bukus', 'PeminjamanBukuApiController');

    // Daftar Ruangan
    Route::apiResource('daftar-ruangans', 'DaftarRuanganApiController');

    // Daftar Nama Barang
    Route::apiResource('daftar-nama-barangs', 'DaftarNamaBarangApiController');

    // Daftar Inventaris Barang
    Route::apiResource('daftar-inventaris-barangs', 'DaftarInventarisBarangApiController');

    // Tahun Ajaran
    Route::apiResource('tahun-ajarans', 'TahunAjaranApiController');

    // Rombongan Belajar
    Route::apiResource('rombongan-belajars', 'RombonganBelajarApiController');

    // Penghasilan
    Route::apiResource('penghasilans', 'PenghasilanApiController');

    // Pendidikan Terakhir
    Route::apiResource('pendidikan-terakhirs', 'PendidikanTerakhirApiController');

    // Kabupaten
    Route::apiResource('kabupatens', 'KabupatenApiController');

    // Kecamatan
    Route::apiResource('kecamatans', 'KecamatanApiController');

    // Agama
    Route::apiResource('agamas', 'AgamaApiController');

    // No Urut
    Route::apiResource('no-uruts', 'NoUrutApiController');

    // Bahasa
    Route::apiResource('bahasas', 'BahasaApiController');

    // Desa
    Route::apiResource('desas', 'DesaApiController');

    // Moda Transportasi
    Route::apiResource('moda-transportasis', 'ModaTransportasiApiController');

    // Tahun
    Route::apiResource('tahuns', 'TahunApiController');

    // Smp Mts
    Route::apiResource('smp-mts', 'SmpMtsApiController');

    // Kelas
    Route::apiResource('kelas', 'KelasApiController');

    // Mata Pelajaran
    Route::apiResource('mata-pelajarans', 'MataPelajaranApiController');

    // Pangkat Golongan
    Route::apiResource('pangkat-golongans', 'PangkatGolonganApiController');

    // Tugas Tambahan
    Route::apiResource('tugas-tambahans', 'TugasTambahanApiController');

    // Pekerjaan
    Route::apiResource('pekerjaans', 'PekerjaanApiController');

    // Daftar Siswa
    Route::apiResource('daftar-siswas', 'DaftarSiswaApiController');
});

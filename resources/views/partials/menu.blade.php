<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('kepegawaian_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/ptks*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-user-friends">

                            </i>
                            <p>
                                {{ trans('cruds.kepegawaian.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ptk_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.ptks.index") }}" class="nav-link {{ request()->is("admin/ptks") || request()->is("admin/ptks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ptk.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('persuratan_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/surat-keluars*") ? "menu-open" : "" }} {{ request()->is("admin/surat-masuks*") ? "menu-open" : "" }} {{ request()->is("admin/sk-kgb-pns*") ? "menu-open" : "" }} {{ request()->is("admin/sk-cpns*") ? "menu-open" : "" }} {{ request()->is("admin/sk-kepangkatan-pns*") ? "menu-open" : "" }} {{ request()->is("admin/sk-pengangkatan-honorers*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-envelope-square">

                            </i>
                            <p>
                                {{ trans('cruds.persuratan.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('surat_keluar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.surat-keluars.index") }}" class="nav-link {{ request()->is("admin/surat-keluars") || request()->is("admin/surat-keluars/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.suratKeluar.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('surat_masuk_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.surat-masuks.index") }}" class="nav-link {{ request()->is("admin/surat-masuks") || request()->is("admin/surat-masuks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.suratMasuk.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sk_kgb_pn_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sk-kgb-pns.index") }}" class="nav-link {{ request()->is("admin/sk-kgb-pns") || request()->is("admin/sk-kgb-pns/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.skKgbPn.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sk_cpn_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sk-cpns.index") }}" class="nav-link {{ request()->is("admin/sk-cpns") || request()->is("admin/sk-cpns/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.skCpn.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sk_kepangkatan_pn_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sk-kepangkatan-pns.index") }}" class="nav-link {{ request()->is("admin/sk-kepangkatan-pns") || request()->is("admin/sk-kepangkatan-pns/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.skKepangkatanPn.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sk_pengangkatan_honorer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sk-pengangkatan-honorers.index") }}" class="nav-link {{ request()->is("admin/sk-pengangkatan-honorers") || request()->is("admin/sk-pengangkatan-honorers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.skPengangkatanHonorer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('kesiswaan_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/daftar-siswas*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-user-graduate">

                            </i>
                            <p>
                                {{ trans('cruds.kesiswaan.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('daftar_siswa_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.daftar-siswas.index") }}" class="nav-link {{ request()->is("admin/daftar-siswas") || request()->is("admin/daftar-siswas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.daftarSiswa.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('arsip_digital_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/arsip-kependudukans*") ? "menu-open" : "" }} {{ request()->is("admin/arsip-ijazahs*") ? "menu-open" : "" }} {{ request()->is("admin/arsip-bpjs*") ? "menu-open" : "" }} {{ request()->is("admin/arsip-npwps*") ? "menu-open" : "" }} {{ request()->is("admin/arsip-pns-lainnyas*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-file-archive">

                            </i>
                            <p>
                                {{ trans('cruds.arsipDigital.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('arsip_kependudukan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.arsip-kependudukans.index") }}" class="nav-link {{ request()->is("admin/arsip-kependudukans") || request()->is("admin/arsip-kependudukans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-address-card">

                                        </i>
                                        <p>
                                            {{ trans('cruds.arsipKependudukan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('arsip_ijazah_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.arsip-ijazahs.index") }}" class="nav-link {{ request()->is("admin/arsip-ijazahs") || request()->is("admin/arsip-ijazahs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-graduation-cap">

                                        </i>
                                        <p>
                                            {{ trans('cruds.arsipIjazah.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('arsip_bpj_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.arsip-bpjs.index") }}" class="nav-link {{ request()->is("admin/arsip-bpjs") || request()->is("admin/arsip-bpjs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase-medical">

                                        </i>
                                        <p>
                                            {{ trans('cruds.arsipBpj.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('arsip_npwp_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.arsip-npwps.index") }}" class="nav-link {{ request()->is("admin/arsip-npwps") || request()->is("admin/arsip-npwps/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-credit-card">

                                        </i>
                                        <p>
                                            {{ trans('cruds.arsipNpwp.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('arsip_pns_lainnya_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.arsip-pns-lainnyas.index") }}" class="nav-link {{ request()->is("admin/arsip-pns-lainnyas") || request()->is("admin/arsip-pns-lainnyas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-copy">

                                        </i>
                                        <p>
                                            {{ trans('cruds.arsipPnsLainnya.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('perpustakaan_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/daftar-buku-perpustakaans*") ? "menu-open" : "" }} {{ request()->is("admin/peminjam-bukus*") ? "menu-open" : "" }} {{ request()->is("admin/peminjaman-bukus*") ? "menu-open" : "" }} {{ request()->is("admin/daftar-bukus*") ? "menu-open" : "" }} {{ request()->is("admin/tempat-penyimpanan-bukus*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-book-open">

                            </i>
                            <p>
                                {{ trans('cruds.perpustakaan.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('daftar_buku_perpustakaan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.daftar-buku-perpustakaans.index") }}" class="nav-link {{ request()->is("admin/daftar-buku-perpustakaans") || request()->is("admin/daftar-buku-perpustakaans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.daftarBukuPerpustakaan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('peminjam_buku_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.peminjam-bukus.index") }}" class="nav-link {{ request()->is("admin/peminjam-bukus") || request()->is("admin/peminjam-bukus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.peminjamBuku.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('peminjaman_buku_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.peminjaman-bukus.index") }}" class="nav-link {{ request()->is("admin/peminjaman-bukus") || request()->is("admin/peminjaman-bukus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-calendar-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.peminjamanBuku.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('daftar_buku_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.daftar-bukus.index") }}" class="nav-link {{ request()->is("admin/daftar-bukus") || request()->is("admin/daftar-bukus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.daftarBuku.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tempat_penyimpanan_buku_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tempat-penyimpanan-bukus.index") }}" class="nav-link {{ request()->is("admin/tempat-penyimpanan-bukus") || request()->is("admin/tempat-penyimpanan-bukus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-archive">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tempatPenyimpananBuku.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('inventaris_barang_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/daftar-ruangans*") ? "menu-open" : "" }} {{ request()->is("admin/daftar-nama-barangs*") ? "menu-open" : "" }} {{ request()->is("admin/daftar-inventaris-barangs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-toolbox">

                            </i>
                            <p>
                                {{ trans('cruds.inventarisBarang.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('daftar_ruangan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.daftar-ruangans.index") }}" class="nav-link {{ request()->is("admin/daftar-ruangans") || request()->is("admin/daftar-ruangans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hospital">

                                        </i>
                                        <p>
                                            {{ trans('cruds.daftarRuangan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('daftar_nama_barang_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.daftar-nama-barangs.index") }}" class="nav-link {{ request()->is("admin/daftar-nama-barangs") || request()->is("admin/daftar-nama-barangs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-toolbox">

                                        </i>
                                        <p>
                                            {{ trans('cruds.daftarNamaBarang.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('daftar_inventaris_barang_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.daftar-inventaris-barangs.index") }}" class="nav-link {{ request()->is("admin/daftar-inventaris-barangs") || request()->is("admin/daftar-inventaris-barangs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-toolbox">

                                        </i>
                                        <p>
                                            {{ trans('cruds.daftarInventarisBarang.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('content_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/content-categories*") ? "menu-open" : "" }} {{ request()->is("admin/content-tags*") ? "menu-open" : "" }} {{ request()->is("admin/content-pages*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.contentManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('content_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-categories.index") }}" class="nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-tags.index") }}" class="nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-pages.index") }}" class="nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentPage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('expense_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/expense-categories*") ? "menu-open" : "" }} {{ request()->is("admin/income-categories*") ? "menu-open" : "" }} {{ request()->is("admin/expenses*") ? "menu-open" : "" }} {{ request()->is("admin/incomes*") ? "menu-open" : "" }} {{ request()->is("admin/expense-reports*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-money-bill">

                            </i>
                            <p>
                                {{ trans('cruds.expenseManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('expense_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-categories.index") }}" class="nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expenseCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.income-categories.index") }}" class="nav-link {{ request()->is("admin/income-categories") || request()->is("admin/income-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.incomeCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expenses.index") }}" class="nav-link {{ request()->is("admin/expenses") || request()->is("admin/expenses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expense.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.incomes.index") }}" class="nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.income.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_report_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-reports.index") }}" class="nav-link {{ request()->is("admin/expense-reports") || request()->is("admin/expense-reports/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chart-line">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expenseReport.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('faq_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/faq-categories*") ? "menu-open" : "" }} {{ request()->is("admin/faq-questions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.faqManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faq_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-categories.index") }}" class="nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('faq_question_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-questions.index") }}" class="nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('data_model_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/tahun-ajarans*") ? "menu-open" : "" }} {{ request()->is("admin/rombongan-belajars*") ? "menu-open" : "" }} {{ request()->is("admin/penghasilans*") ? "menu-open" : "" }} {{ request()->is("admin/pendidikan-terakhirs*") ? "menu-open" : "" }} {{ request()->is("admin/kabupatens*") ? "menu-open" : "" }} {{ request()->is("admin/kecamatans*") ? "menu-open" : "" }} {{ request()->is("admin/agamas*") ? "menu-open" : "" }} {{ request()->is("admin/no-uruts*") ? "menu-open" : "" }} {{ request()->is("admin/bahasas*") ? "menu-open" : "" }} {{ request()->is("admin/desas*") ? "menu-open" : "" }} {{ request()->is("admin/moda-transportasis*") ? "menu-open" : "" }} {{ request()->is("admin/tahuns*") ? "menu-open" : "" }} {{ request()->is("admin/smp-mts*") ? "menu-open" : "" }} {{ request()->is("admin/kelas*") ? "menu-open" : "" }} {{ request()->is("admin/mata-pelajarans*") ? "menu-open" : "" }} {{ request()->is("admin/pangkat-golongans*") ? "menu-open" : "" }} {{ request()->is("admin/tugas-tambahans*") ? "menu-open" : "" }} {{ request()->is("admin/pekerjaans*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.dataModel.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('tahun_ajaran_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tahun-ajarans.index") }}" class="nav-link {{ request()->is("admin/tahun-ajarans") || request()->is("admin/tahun-ajarans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tahunAjaran.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('rombongan_belajar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.rombongan-belajars.index") }}" class="nav-link {{ request()->is("admin/rombongan-belajars") || request()->is("admin/rombongan-belajars/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.rombonganBelajar.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('penghasilan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.penghasilans.index") }}" class="nav-link {{ request()->is("admin/penghasilans") || request()->is("admin/penghasilans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.penghasilan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('pendidikan_terakhir_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.pendidikan-terakhirs.index") }}" class="nav-link {{ request()->is("admin/pendidikan-terakhirs") || request()->is("admin/pendidikan-terakhirs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.pendidikanTerakhir.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('kabupaten_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.kabupatens.index") }}" class="nav-link {{ request()->is("admin/kabupatens") || request()->is("admin/kabupatens/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.kabupaten.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('kecamatan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.kecamatans.index") }}" class="nav-link {{ request()->is("admin/kecamatans") || request()->is("admin/kecamatans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.kecamatan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('agama_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.agamas.index") }}" class="nav-link {{ request()->is("admin/agamas") || request()->is("admin/agamas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.agama.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('no_urut_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.no-uruts.index") }}" class="nav-link {{ request()->is("admin/no-uruts") || request()->is("admin/no-uruts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.noUrut.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('bahasa_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.bahasas.index") }}" class="nav-link {{ request()->is("admin/bahasas") || request()->is("admin/bahasas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.bahasa.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('desa_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.desas.index") }}" class="nav-link {{ request()->is("admin/desas") || request()->is("admin/desas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.desa.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('moda_transportasi_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.moda-transportasis.index") }}" class="nav-link {{ request()->is("admin/moda-transportasis") || request()->is("admin/moda-transportasis/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.modaTransportasi.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tahun_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tahuns.index") }}" class="nav-link {{ request()->is("admin/tahuns") || request()->is("admin/tahuns/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tahun.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('smp_mt_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.smp-mts.index") }}" class="nav-link {{ request()->is("admin/smp-mts") || request()->is("admin/smp-mts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.smpMt.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('kela_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.kelas.index") }}" class="nav-link {{ request()->is("admin/kelas") || request()->is("admin/kelas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.kela.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('mata_pelajaran_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.mata-pelajarans.index") }}" class="nav-link {{ request()->is("admin/mata-pelajarans") || request()->is("admin/mata-pelajarans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.mataPelajaran.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('pangkat_golongan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.pangkat-golongans.index") }}" class="nav-link {{ request()->is("admin/pangkat-golongans") || request()->is("admin/pangkat-golongans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.pangkatGolongan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tugas_tambahan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tugas-tambahans.index") }}" class="nav-link {{ request()->is("admin/tugas-tambahans") || request()->is("admin/tugas-tambahans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tugasTambahan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('pekerjaan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.pekerjaans.index") }}" class="nav-link {{ request()->is("admin/pekerjaans") || request()->is("admin/pekerjaans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.pekerjaan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
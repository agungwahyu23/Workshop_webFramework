<?php
$uri3 = $this->uri->segment(2);
$uri4 = $this->uri->segment(3);

?>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="<?= base_url('assets/new/img/profile.jpg') ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    <?= $this->session->userdata('nama_pengguna') ?>
                                    <span class="user-level">Administrator</span>
                                    <!-- <span class="caret"></span> -->
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">

                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item <?= $uri3 == 'dashboard' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/dashboard') ?>">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'mengajar' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/mengajar') ?>">
                                <i class="fas fa-layer-group"></i>
                                <p>Data Mengajar</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item <?= $uri3 == 'mengajar' ? 'active' : '' ?>">
                            <a data-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group"></i>
                                <p>Hasil Mengajar</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse  <?= $uri3 == 'mengajar' ? 'show' : '' ?>" id="base">
                                <ul class="nav nav-collapse">
                                    <li class="<?= $uri3 == 'mengajar' && $uri4 == 'hariini' ? 'active' : '' ?>">
                                        <a href="<?= base_url('backoffice/mengajar/hariini') ?>">
                                            <span class="sub-item">Hari Ini</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/buttons.html">
                                            <span class="sub-item">Minggu Ini</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/gridsystem.html">
                                            <span class="sub-item">Bulan Ini</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/panels.html">
                                            <span class="sub-item">Semua</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <li class="nav-item <?= $uri3 == 'permintaan' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/permintaan') ?>">
                                <i class="fas fa-exchange-alt"></i>
                                <p>Permintaan Mengajar</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'penarikan' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/penarikan') ?>">
                                <i class="fas fa-layer-group"></i>
                                <p>Penarikan Saldo</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'guru' && $uri4 == 'izin' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/guru/izin') ?>">
                                <i class="fas fa-envelope"></i>
                                <p>Izin Guru</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'guru' && $uri4 == 'statistik' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/guru/statistik') ?>">
                                <i class="fas fa-chart-bar"></i>
                                <p>Statistik Guru</p>
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Master Data</h4>
                        </li>
                        <li class="nav-item <?= $uri3 == 'tahun' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/tahun') ?>">
                                <i class="fas fa-list"></i>
                                <p>Tahun Ajaran</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'jurusan' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/jurusan') ?>">
                                <i class="fas fa-list"></i>
                                <p>Data Jurusan</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'kelas' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/kelas') ?>">
                                <i class="fas fa-list"></i>
                                <p>Data Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'guru' && $uri4 != 'izin' && $uri4 != 'statistik' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/guru') ?>">
                                <i class="fas fa-users"></i>
                                <p>Data Guru</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'mapel' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/mapel') ?>">
                                <i class="fas fa-list"></i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'jadwal' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/jadwal') ?>">
                                <i class="fas fa-calendar-alt"></i>
                                <p>Jadwal</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'pengaturan' ? 'active' : '' ?>">
                            <a href="<?= base_url('backoffice/pengaturan') ?>">
                                <i class="fas fa-cog"></i>
                                <p>Pengaturan Aplikasi</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $uri3 == 'pengguna' ? 'active' : '' ?>">
                            <a data-toggle="collapse" href="#pengguna">
                                <i class="fas fa-user"></i>
                                <p>Data Pengguna</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse  <?= $uri3 == 'pengguna' ? 'show' : '' ?>" id="pengguna">
                                <ul class="nav nav-collapse">
                                    <li class="<?= $uri3 == 'pengguna' && $uri4 == 'admin' ? 'active' : '' ?>">
                                        <a href="<?= base_url('backoffice/pengguna/admin') ?>">
                                            <span class="sub-item">Administrator</span>
                                        </a>
                                    </li>
                                    <li class="<?= $uri3 == 'pengguna' && $uri4 == 'guru' ? 'active' : '' ?>">
                                        <a href="<?= base_url('backoffice/pengguna/guru') ?>">
                                            <span class="sub-item">Guru</span>
                                        </a>
                                    </li>
                                    <li class="<?= $uri3 == 'pengguna' && $uri4 == 'siswa' ? 'active' : '' ?>">
                                        <a href="<?= base_url('backoffice/pengguna/siswa') ?>">
                                            <span class="sub-item">Siswa</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="mx-4 mt-2">
                            <a href="<?= base_url('auth/logout') ?>" onclick="return confirm('Apakah yakin ingin keluar?');" class="btn btn-danger btn-block"><span class="btn-label mr-2"> <i class="fas fa-sign-out-alt"></i> </span>Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->

    <!-- End Bottom points-->
</aside>
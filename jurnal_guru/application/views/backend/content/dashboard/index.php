<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard Admin</h2>
                <!-- <h5 class="text-white op-7 mb-2">Free Bootstrap 4 Admin Dashboard</h5> -->
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <h2 class="text-white pb-2 fw-bold">Tahun Ajaran Aktif</h2>
                <p class="text-white pb-2 fw-bold">
                    <?php

                    $set = Data_helper::get_setting();
                    $cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
                    echo $cekset['tahun'] . ' Semester ' . ($set['semester'] == '1' ? 'Ganjil' : 'Genap');
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-primary card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="flaticon-interface-6"></i>
                                            </div>
                                        </div>
                                        <div class="col-9 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Jadwal Hari Ini</p>
                                                <h4 class="card-title"><?= $jadwal ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-info card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="flaticon-interface-6"></i>
                                            </div>
                                        </div>
                                        <div class="col-9 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Persentase Mengajar</p>
                                                <h4 class="card-title"><?= $mengajar . '/' . $jadwal . ' (' . number_format(( ($mengajar == 0 || $mengajar == null ? 0 : $mengajar / $jadwal) * 100),'2') . '%)' ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-success card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="flaticon-envelope"></i>
                                            </div>
                                        </div>
                                        <div class="col-9 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Permintaan Izin</p>
                                                <h4 class="card-title"><?= $izin ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-secondary card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="flaticon-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-9 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Permintaan Guru Aktif</p>
                                                <h4 class="card-title"><?= $permintaan ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="page-title">Data Mengajar Hari Ini Yang Masih Aktif</h4>


                    <div class="table-responsive m-t-10">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Kelas</th>
                                    <th>Nama Guru</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tipe Guru</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($datamengajar as $p) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $p['no_kelas'] . ' ' . $p['nama_singkat'] . ' ' . $p['rombel'] ?></td>
                                        <td><?= $p['nama_guru'] ?></td>
                                        <td><?= $p['nama_mapel'] ?></td>
                                        <td><?= ($p['tipe'] == '1' ? 'Guru Sesuai Jadwal' : 'Guru Pengganti') ?></td>
                                        <td><?= ($p['status'] == '1' ? 'Proses' : 'Menunggu Rating') ?></td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="page-inner">
    <!-- <div class="page-header">
        <h4 class="page-title"><?= $title ?></h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?= $title ?></a>
            </li>
        </ul>
    </div> -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title"><?= $title ?></h4>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<br/>
                                <div class='alert alert-" . $_SESSION['message'][0] . "'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>
                                <h3 class='text-" . $_SESSION['message'][0] . "'><i class='fa fa-check-circle'></i>" . $_SESSION['message'][2] . "</h3>" . $_SESSION['message'][1] . "
                                </div>";
                    }
                    ?>
                    <div class="table-responsive m-t-10">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Dibuat Pada</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                    <th>Diambil Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tip = ['', 'Guru Satu Mapel', 'Semua Guru'];
                                $st = ['Tidak Berlaku', 'Tersedia', 'Selesai'];
                                foreach ($data as $p) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $p['no_kelas'] . ' ' . $p['nama_singkat'] . ' ' . $p['rombel'] ?></td>
                                        <td><?= $p['nama_mapel'] ?></td>
                                        <td><?= Response_helper::waktu($p['create_at']) ?></td>
                                        <td><?= $tip[(int) $p['tipe']] ?></td>
                                        <td><?= $st[(int) $p['status']] ?></td>
                                        <td><?= $p['nama_guru'] ?></td>
                                        <td>
                                            <?php
                                            if ($p['status'] == '1') { ?>

                                                <a href="#" onclick="modal_konfir('<?= base_url('backoffice/permintaan/delete/' . $p['kode_req']); ?>','Apakah anda yakin ingin>')">Non-Aktifkan</a>

                                            <?php } else {
                                                echo "-";
                                            } ?>
                                        </td>
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
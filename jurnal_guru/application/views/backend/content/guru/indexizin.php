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
                                    <th>Nama Guru</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Dibuat Pada</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $st = ['Di Batalkan', 'Menunggu Konfirmasi', 'Di Terima', 'Di Tolak'];
                                $no = 1;
                                foreach ($data as $p) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $p['nama_guru'] ?></td>
                                        <td><?= $p['keterangan'] ?></td>
                                        <td><?= Response_helper::waktu($p['awal']) ?></td>
                                        <td><?= Response_helper::waktu($p['akhir']) ?></td>
                                        <td><?= Response_helper::waktu($p['create_at']) ?></td>
                                        <td><?= $st[(int) $p['status']] ?></td>
                                        <td>
                                            <?php
                                            if ($p['status'] == '1') { ?>
                                                <a href="#" onclick="modal_konfir('<?= base_url('backoffice/guru/setstatusizin/Terima/' . $p['kode_ijin']); ?>','Apakah anda yakin ingin menerima permintaan Izin ini?')"><i class='fas fa-check'></i></a>&nbsp;
                                                <a href="#" onclick="modal_konfir('<?= base_url('backoffice/guru/setstatusizin/Tolak/' . $p['kode_ijin']); ?>','Apakah anda yakin ingin menolak permintaan Izin ini?')"><i class='fas fa-times'></i></a>
                                            <?php } else {
                                                echo '-';
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
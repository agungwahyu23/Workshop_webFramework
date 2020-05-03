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
                            <a href="<?= base_url("backoffice/mapel/add") ?>">
                                <button class="btn btn-primary">
                                    <span class="btn-label">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    Tambah
                                </button>
                            </a>
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
                        <table id="example23" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mata Pelajaran</th>
                                    <th>Tanggal Input</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $p) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $p['nama_mapel'] ?></td>
                                        <td><?= Response_helper::waktu($p['create_at']) ?></td>
                                        <td><?= $p['nama_pengguna'] ?></td>
                                        <td>

                                            <a href="<?= base_url('backoffice/mapel/edit/' . $p['kode_mapel']) ?>"><i class='fas fa-edit'></i>Edit</a>&nbsp;

                                            <td><a href="#" onclick="confirm_modal('<?= base_url('backoffice/mapel/delete/' . $p['kode_mapel']); ?>')"><i class='fas fa-trash'></i>Hapus</a></td>

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
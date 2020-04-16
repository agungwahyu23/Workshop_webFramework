<div class="page-inner">
    <div class="page-header">
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
                <a href="#">Data Kelas</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?= $title ?></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0"><?= $title ?></h4>
                </div>
                <div class="card-body">

                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<div class='alert alert-" . $_SESSION['message'][0] . "'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>
                                        <h3 class='text-" . $_SESSION['message'][0] . "'><i class='fa fa-check-circle'></i>" . $_SESSION['message'][2] . "</h3>" . $_SESSION['message'][1] . "
                                        </div>";
                    }
                    ?>

                    <form class="m-t-10" method="post" action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Pilih Jurusan <span class="text-danger">*</span></h5>
                                    <select class="form-control form-control" required name="jurusan" id="defaultSelect">
                                        <option value="">Pilih Jurusan</option>
                                        <?php
                                        foreach ($datajurusan as $p) { ?>
                                            <option value="<?= $p['kode_jurusan'] ?>" <?= ($data['kode_jurusan'] == $p['kode_jurusan'] ? 'selected' : '') ?>><?= $p['nama_jurusan'] ?></option>
                                        <?php  }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>No Kelas <span class="text-danger">*</span></h5>
                                    <select class="form-control form-control" required name="no_kelas" id="defaultSelect">
                                        <option value="">Pilih No Kelas</option>
                                        <option value="10" <?= ($data['no_kelas'] == '10' ? 'selected' : '') ?>>10</option>
                                        <option value="11" <?= ($data['no_kelas'] == '11' ? 'selected' : '') ?>>11</option>
                                        <option value="12" <?= ($data['no_kelas'] == '12' ? 'selected' : '') ?>>12</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Rombel <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="rombel" value="<?= Input_helper::postOrOr('rombel', $data['rombel']) ?>" class="form-control" required placeholder="Contoh : B">
                                    </div>
                                </div>
                            </div>
                            <?php
                                if($action == "Tambah Data") { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Username Akun <span class="text-danger">*</span> <small>Akan Menjadi Username & Password Awal</small></h5>
                                    <div class="controls">
                                        <input type="text" name="username" value="<?= Input_helper::postOrOr('username') ?>" class="form-control" required placeholder="Masukkan Username">
                                    </div>
                                </div>
                            </div>
                                <?php } ?>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <div class="text-xs-right">
                                    <button type="reset" class="btn btn-inverse">Reset</button>
                                    <button type="submit" class="btn btn-primary"> <?= $action ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
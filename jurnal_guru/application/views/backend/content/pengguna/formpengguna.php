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
                <a href="#">Data Pengguna</a>
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
                    <h4 class="m-b-0 ">Form <?= $title ?></h4>
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

                    <form class="m-t-10" method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Nama Pengguna <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="nama_pengguna" value="<?= Input_helper::postOrOr('nama_pengguna', $data['nama_pengguna']) ?>" class="form-control" placeholder="Masukkan Nama Pengguna" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Username<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="email" value="<?= Input_helper::postOrOr('email', $data['email']) ?>" class="form-control" placeholder="Masukkan Username" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Password <?= ($title != 'Edit Pengguna' ? "<span class='text-danger'>*</span>" : '') ?></h5>
                                    <div class="controls">
                                        <input type="password" name="password" value="" class="form-control" placeholder="Masukkan Password" <?= ($title != 'Edit Pengguna' ? "required" : '') ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Akses Data <?= ($level != '1' ? '<span class="text-danger">*</span>' : '') ?></h5>
                                    <?php
                                    if ($level == "1") {
                                        echo "<input type='hidden' name='akses' value='Admin' class='form-control'>";
                                        echo "<p>Admin</p>";
                                    } else if ($level == "2") { ?>
                                        <select class="form-control select2" required name="akses" id="defaultSelect">
                                            <option value="">Pilih Guru</option>
                                            <?php
                                            foreach ($dataguru as $p) { ?>
                                                <option value="<?= $p['kode_guru'] ?>" <?= ($data['akses_data'] == $p['kode_guru'] ? 'selected' : '') ?>><?= $p['nama_guru']  ?></option>
                                            <?php  }
                                            ?>
                                        </select>
                                    <?php
                                    } else if ($level == "3") { ?>
                                        <select class="form-control select2" required name="akses" id="defaultSelect">
                                            <option value="">Pilih Kelas</option>
                                            <?php
                                            foreach ($datakelas as $p) { ?>
                                                <option value="<?= $p['kode_kelas'] ?>" <?= ($data['akses_data'] == $p['kode_kelas'] ? 'selected' : '') ?>><?= $p['no_kelas'] . ' ' . $p['nama_singkat'] . ' ' . $p['rombel']  ?></option>
                                            <?php  }
                                            ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="text-xs-right">
                                    <button type="reset" class="btn btn-inverse">Reset</button>
                                    <button type="submit" class="btn btn-info">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
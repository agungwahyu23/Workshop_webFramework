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
                <a href="#"><?= $title ?></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h2>Pengaturan Aplikasi</h2>
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

                    <form class="m-t-10" method="post" action="" enctype="multipart/form-data">
                        <h3 class="card-title">Data</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Upah Lembur/Jam</h5>
                                    <div class="controls">
                                        <input type="text" name="gaji_lembur" value="<?= Input_helper::postOrOr('gaji_lembur', Response_helper::uang($data['gaji_lembur'])) ?>" class="form-control duit" placeholder="Masukkan Upah Lembur">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Semester Aktif</h5>
                                    <div class="controls">
                                        <select class="form-control" name="semester">
                                            <option value="1" <?= ($data['semester'] == '1' ? 'selected' : '') ?>>Ganjil</option>
                                            <option value="2" <?= ($data['semester'] == '2' ? 'selected' : '') ?>>Genap</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Hari Aktif</label><br />
                                    <div class="selectgroup selectgroup-pills">
                                        <?php
                                        foreach ($datahari as $val) { ?>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="hari[]" value="<?= $val['kode_hari'] ?>" class="selectgroup-input" <?= ($val['aktif'] == '1' ? 'checked' : '') ?>>
                                                <span class="selectgroup-button"><?= $val['kode_hari'] ?></span>
                                            </label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Durasi Permintaan Guru Per Mapel</h5>
                                    <div class="controls">
                                        <input type="number" name="min_notif_jurusan" value="<?= Input_helper::postOrOr('min_notif_jurusan', $data['min_notif_jurusan']) ?>" min='1' class="form-control" placeholder="Dalam Satuan Menit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Durasi Permintaan Semua Guru</h5>
                                    <div class="controls">
                                        <input type="number" name="min_notif_semua" value="<?= Input_helper::postOrOr('min_notif_semua', $data['min_notif_semua']) ?>" min='1' class="form-control" placeholder="Dalam Satuan Menit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Aktifkan Permintaan Guru Otomatis</h5>
                                    <div class="controls">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="aktif_kirim_auto" value="1" class="selectgroup-input" <?= ($data['aktif_kirim_auto'] == '1' ? 'checked' : '') ?>>
                                            <span class="selectgroup-button">Ya</span>
                                        </label>
                                        <label class="selectgroup-item" style="margin-left: 10px;">
                                            <input type="radio" name="aktif_kirim_auto" value="0" class="selectgroup-input" <?= ($data['aktif_kirim_auto'] == '0' ? 'checked' : '') ?>>
                                            <span class="selectgroup-button">Tidak</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Lama Guru Terlambat Check-in <small>(membuat permintaan guru otomatis)</small></h5>
                                    <div class="controls">
                                        <input type="number" name="interval_kirim_auto" value="<?= Input_helper::postOrOr('interval_kirim_auto', $data['interval_kirim_auto']) ?>" min='1' class="form-control" placeholder="Dalam Satuan Menit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>No Telphone</h5>
                                    <div class="controls">
                                        <input type="number" name="nohp" value="<?= Input_helper::postOrOr('nohp', $data['nohp']) ?>" class="form-control" placeholder="Masukkan Nomer Telephone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>No Wa</h5>
                                    <div class="controls">
                                        <input type="number" name="nowa" value="<?= Input_helper::postOrOr('nowa', $data['nowa']) ?>" class="form-control" placeholder="Masukkan Nomer WA">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Email</h5>
                                    <div class="controls">
                                        <input type="email" name="email_cs" value="<?= Input_helper::postOrOr('email_cs', $data['email_cs']) ?>" class="form-control" placeholder="Masukkan Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title">Pengiriman Email <code><small>Di Isi Oleh Developer</small></code></h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>SMTP User<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="smtp_user" required value="<?= Input_helper::postOrOr('smtp_user', $data['smtp_user']) ?>" class="form-control" placeholder="Masukkan SMTP User">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>SMTP Password<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" name="smtp_pass" required value="<?= Input_helper::postOrOr('smtp_pass', $data['smtp_pass']) ?>" class="form-control" placeholder="Masukkan SMTP Password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>SMTP Port<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="smtp_port" required value="<?= Input_helper::postOrOr('smtp_port', $data['smtp_port']) ?>" class="form-control" placeholder="Masukkan SMTP Port">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>SMTP Host<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="smtp_host" required value="<?= Input_helper::postOrOr('smtp_host', $data['smtp_host']) ?>" class="form-control" placeholder="Masukkan SMTP Host">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title">Push Notification Android <code><small>Di Isi Oleh Developer</small></code></h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Kunci server<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="key_fcm" required value="<?= Input_helper::postOrOr('key_fcm', $data['key_fcm']) ?>" class="form-control" placeholder="Masukkan Kunci Server">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>ID pengirim<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="id_fcm" required value="<?= Input_helper::postOrOr('id_fcm', $data['id_fcm']) ?>" class="form-control" placeholder="Masukkan ID Pengirim">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="text-xs-right">
                                    <button type="reset" class="btn btn-inverse">Reset</button>
                                    <button type="submit" class="btn btn-info"> Simpan Pengaturan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
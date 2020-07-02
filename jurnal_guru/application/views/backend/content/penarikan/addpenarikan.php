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
                <a href="#">Data Penarikan</a>
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
                                    <h5>Pilih Guru <span class="text-danger">*</span></h5>
                                    <select class="form-control select2" required name="kode_guru" id="defaultSelect">
                                        <option value="">Pilih Guru</option>
                                        <?php
                                        foreach ($dataguru as $p) {
                                            if ((int) $p['upah'] > 0) {
                                        ?>
                                                <option value="<?= $p['kode_guru'] ?>"><?= $p['nama_guru'] . ' (' . Response_helper::price($p['upah']) . ')' ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Jumlah Penarikan <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="jml_penarikan" class="form-control duit" required placeholder="Masukkan Jumlah Penarikan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Waktu Transaksi <span class="text-danger">*</span></h5>
                                    <div class="controls row">
                                        <input type="date" name="tgl" class="form-control col-md-6" required max="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>">
                                        <input type="time" name="waktu" class="form-control col-md-4" required value="<?= date('H:i') ?>">
                                    </div>
                                </div>
                            </div>
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
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
                <a href="#">Data Mata Pelajaran</a>
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
                    <p>
                        Note : Data Yang Kosong Tidak Akan Di Simpan
                    </p>

                    <form class="m-t-10" method="post" action="">
                        <div class="row tmpinput" id="tmpinput">
                            <div class="col-md-12" style="margin-top: 10px;">
                                <input type="text" name="nama_mapel" class="form-control col-md-6" placeholder="Masukkan Nama Mata Pelajaran">
                            </div>
                        </div>
                        <div class="row m-t-10" style="margin-top: 20px;">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <div class="text-xs-right">
                                    <button type="button" onclick="addrow()" class="btn btn-inverse">Tambah Baris</button>
                                    <button type="submit" class="btn btn-primary"> <?= $action ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addrow() {
            var rowbaru = '<div class="col-md-12" style="margin-top: 10px;">' +
                '<input type="text" name="nama_mapel[]" class="form-control col-md-6" placeholder="Masukkan Nama Mata Pelajaran"></div>';
            $('.tmpinput').append(rowbaru)
        }
    </script>
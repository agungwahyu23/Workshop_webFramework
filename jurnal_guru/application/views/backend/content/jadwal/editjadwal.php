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
                <a href="#">Data Jadwal</a>
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
                                    <h5>Pilih Kelas <span class="text-danger">*</span></h5>
                                    <select class="form-control select2" required name="kelas" id="defaultSelect">
                                        <option value="">Pilih Kelas</option>
                                        <?php
                                        foreach ($datakelas as $p) { ?>
                                            <option value="<?= $p['kode_kelas'] ?>" <?= ($data['kode_kelas'] == $p['kode_kelas'] ? 'selected' : '') ?>><?= $p['no_kelas'] . ' ' . $p['nama_singkat'] . ' ' . $p['rombel']  ?></option>
                                        <?php  }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Pilih Guru <span class="text-danger">*</span></h5>
                                    <select class="form-control select2" required name="guru" id="defaultSelect">
                                        <option value="">Pilih Guru</option>
                                        <?php
                                        foreach ($dataguru as $p) { ?>
                                            <option value="<?= $p['kode_guru'] ?>" <?= ($data['kode_guru'] == $p['kode_guru'] ? 'selected' : '') ?>><?= $p['nama_guru']  ?></option>
                                        <?php  }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Pilih Mata Pelajaran <span class="text-danger">*</span></h5>
                                    <select class="form-control select2" required name="mapel" id="defaultSelect">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        <?php
                                        foreach ($datamapel as $p) { ?>
                                            <option value="<?= $p['kode_mapel'] ?>" <?= ($data['kode_mapel'] == $p['kode_mapel'] ? 'selected' : '') ?>><?= $p['nama_mapel']  ?></option>
                                        <?php  }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Hari <span class="text-danger">*</span></h5>
                                    <select class="form-control form-control" required name="hari" id="defaultSelect">
                                        <option value="">Pilih Hari</option>
                                        <?php
                                        foreach ($datahari as $ky) { ?>
                                            <option value="<?= $ky['kode_hari'] ?>" <?= ($ky['kode_hari'] == $data['hari'] ? 'selected' : '') ?>><?= $ky['kode_hari'] ?></option>
                                        <?php   }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5>Waktu Mulai <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="time" name="jam_awal" class="form-control" value="<?= Input_helper::postOrOr('jam_awal', $data['jam_awal']) ?>" required placeholder="Contoh : 12:00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5>Waktu Selesai <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="time" name="jam_akhir" class="form-control" value="<?= Input_helper::postOrOr('jam_akhir', $data['jam_akhir']) ?>" required placeholder="Contoh : 14:00">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row" id="tmpinput">
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Pilih Mata Pelajaran <span class="text-danger">*</span></h5>
                                        <select class="form-control select2" required name="kode_mapel[]" id="defaultSelect">
                                            <option value="">Pilih Mata Pelajaran</option>
                                            <?php
                                            foreach ($datamapel as $p) { ?>
                                                <option value="<?= $p['kode_mapel'] ?>"><?= $p['nama_mapel']  ?></option>
                                            <?php  }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Waktu Mulai <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="time" name="jam_awal[]" class="form-control" required placeholder="Contoh : 12:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row m-t-10">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <div class="text-xs-right">
                                    <!-- <button type="button" onclick="addrow()" class="btn btn-inverse">Tambah Baris</button> -->
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
        var arrnya = "<?= json_encode($datamapel) ?>";

        function addrow() {

            console.log('tes');

            var rowbaru = '<div class="row col-md-12"><div class="col-md-4"><div class="form-group"><h5>Pilih Mata Pelajaran <span class="text-danger">*</span></h5><select class="form-control select2" required name="kode_mapel[]" id="defaultSelect"><option value="">Pilih Mata Pelajaran</option>';
            for (let index = 0; index < arrnya.length; index++) {
                const element = arrnya[index];
                console.log(element);

                rowbaru += '<option value="' + element.kode_mapel + '">' + element.nama_mapel + '</option>';
            }

            rowbaru += '</select></div></div></div>';
            $('.tmpinput').append(rowbaru)
        }
    </script>
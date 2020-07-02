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

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Pilih Tahun Ajaran <span class="text-danger">*</span></h5>
                                <select class="form-control form-control" onchange="getalldata()" required name="tahunnya" id="tahunnya">
                                    <option value="">Pilih Tahun Ajaran</option>
                                    <?php
                                    $set = Data_helper::get_setting();
                                    foreach ($tahun as $p) { ?>
                                        <option value="<?= $p['kode_tahun'] . '-1' ?>" <?= ($p['aktif'] == '1' && $set['semester'] == '1' ? 'selected' : '') ?>><?= $p['tahun'] . ' Ganjil' ?></option>
                                        <option value="<?= $p['kode_tahun'] . '-2' ?>" <?= ($p['aktif'] == '1' && $set['semester'] == '2' ? 'selected' : '') ?>><?= $p['tahun'] . ' Genap' ?></option>
                                    <?php  }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Tipe Statistik <span class="text-danger">*</span></h5>
                                <select class="form-control form-control" onchange="getalldata()" required name="tipefilter" id="tipefilter">
                                    <option value="">Pilih Tipe Statistik </option>
                                    <option value="1">Rating Tertinggi</option>
                                    <option value="2">Paling Sering Mengajar</option>
                                    <option value="3">Paling Banyak Tidak Masuk</option>
                                    <option value="4">Paling Banyak Izin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive m-t-10" id="tempatdata">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getalldata() {
            var vtahun = document.getElementById('tahunnya').value;
            var vtipefilter = document.getElementById('tipefilter').value;
            if (vtahun != '' && vtipefilter != '') {

                $.ajax({
                    type: 'post',
                    url: '<?= base_url() . "backoffice/guru/getstatistik" ?>',
                    data: {
                        tahunnya: vtahun,
                        tipenya: vtipefilter,
                    },
                    dataType: 'JSON',
                    success: function(dataku) {
                        var html = '';
                        var i, no = 1;
                        var data = dataku.data;
                        // console.log(dataku);

                        if (data.length > 0) {
                            var vrtipe = ['', 'Sesuai Jadwal', 'Pengganti'];
                            var vrstatus = ['', 'Proses', 'Menunggu Rating', 'Selesai', 'Tidak Masuk', 'Izin'];
                            html += '<table id="tabeldata" class="table table-bordered table-striped"><thead><tr><th>No</th><th>Nama Guru</th><th>Jurusan</th><th>Jumlah</th></tr></thead><tbody id="show_data">';
                            for (i = 0; i < data.length; i++) {


                                html += '<tr>' +
                                    '<td>' + no + '</td>' +
                                    '<td>' + data[i].nama_guru + '</td>' +
                                    '<td>' + data[i].nama_jurusan + '</td>' +
                                    '<td>' + data[i].kolombanding + '</td>' +
                                    '</tr>';
                                no++;
                            }
                            html += '</tbody></table>';
                            document.getElementById('tempatdata').innerHTML = html;
                            $('#tabeldata').DataTable();
                        } else {
                            html += "<div class='alert alert-danger' style='margin-top: 10px;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button><h3 class='text-danger'><i class='fa fa-check-circle'></i> Informasi</h3>Untuk Saat Ini Data Yang Anda Minta Belum Tersedia</div>";
                            document.getElementById('tempatdata').innerHTML = html;
                        }
                    }
                });
            }
        }


        // function tanggalku(tgl) {

        //     var splitwaktu = tgl.split(' ');
        //     var explode = splitwaktu[0].split('-');
        //     var thn = explode[0];
        //     var bln = explode[1];
        //     var hari = explode[2];
        //     var listbulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        //     var harinya = hari + ' ' + listbulan[parseInt(bln)] + ' ' + thn + ' ' + splitwaktu[1];
        //     return harinya;
        // }
    </script>
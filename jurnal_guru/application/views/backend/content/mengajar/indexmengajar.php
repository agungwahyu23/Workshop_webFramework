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
                                <select class="form-control form-control" required name="tahunnya" id="tahunnya">
                                    <option value="">Pilih Tahun Ajaran</option>
                                    <?php
                                    $set = Data_helper::get_setting();
                                    foreach ($datatahun as $p) { ?>
                                        <option value="<?= $p['kode_tahun'] . '-1' ?>" <?= ($p['aktif'] == '1' && $set['semester'] == '1' ? 'selected' : '') ?>><?= $p['tahun'] . ' Ganjil' ?></option>
                                        <option value="<?= $p['kode_tahun'] . '-2' ?>" <?= ($p['aktif'] == '1' && $set['semester'] == '2' ? 'selected' : '') ?>><?= $p['tahun'] . ' Genap' ?></option>
                                    <?php  }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Rentang Tanggal <span class="text-danger">*</span></h5>
                                <!-- <?php
                                        $tujuh_hari        = mktime(0, 0, 0, date("n"), date("j") - 14, date("Y"));
                                        $kembali        = date("m/d/Y", $tujuh_hari);
                                        $val = $kembali . ' - ' . date("m/d/Y");
                                        ?>
                                <input class="form-control input-daterange-datepicker" id="input-daterange-datepicker" required novalidate type="text" name="daterange" value="<?= $val ?>" /> -->
                                <input class="form-control" required novalidate type="date" name="tglmulai" id="tglmulai" max="<?= date('Y-m-d') ?>" />s/d
                                <input class="form-control" required novalidate type="date" name="tglakhir" id="tglakhir" max="<?= date('Y-m-d') ?>" />

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <h5>Tipe Filter <span class="text-danger">*</span></h5>
                                <select class="form-control form-control" onchange="getdatatipe(this.options[this.selectedIndex].value)" required name="tipefilter" id="tipefilter">
                                    <option value="">Pilih Tipe Filter </option>
                                    <option value="1">Guru</option>
                                    <option value="2">Mata Pelajaran</option>
                                    <option value="3">Kelas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" id="selectdatanya">

                        </div>
                        <div class="col-md-1">
                            <button type="button" style="margin-top: 35px;" class="btn btn-primary" onclick="getalldata()">
                                Cari
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive m-t-10" id="tempatdata">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modaldetailmengajar">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdjudul">Detail Mengajar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <p id="mdmapel"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Guru</label>
                                <p id="mnguru"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kelas</label>
                                <p id="mdkelas"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipe Guru</label>
                                <p id="mdtipe"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Waktu Mulai</label>
                                <p id="mdwktmulai"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Waktu Selesai</label>
                                <p id="mdwktselesai"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Materi</label>
                                <p id="mdmateri"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rating</label>
                                <p id="mdrating"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Catatan Siswa</label>
                                <p id="mdcatatan"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Reward</label>
                                <p id="mdreward"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <p id="mdstatus"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" style="float: right;" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- <script src="<?= base_url() ?>assets/new/js/core/jquery.3.2.1.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>assets/new/js/plugin/datatables/datatables.min.js"></script> -->
    <script>
        function detail(kodemengajar) {
            var arstatus = ['','Proses Mengajar','Menunggu Rating','Selesai','Tidak Masuk','Izin'], 
            artipe=['','Guru Sesuai Jadwal','Guru Pengganti'],
            arrating=['Belum da Rating','Buruk Sekali','Buruk','Cukup','Baik','Baik Sekali'];
            $.ajax({
                type: "POST",
                url: '<?= base_url() . "backoffice/mengajar/detailmengajar" ?>',
                dataType: "JSON",
                data: {
                    kode: kodemengajar
                },
                success: function(data) {
                    console.log(data);
                    document.getElementById("mdmapel").textContent = data.nama_mapel
                    document.getElementById("mnguru").textContent = data.nama_guru
                    document.getElementById("mdkelas").textContent = data.no_kelas + ' ' + data.nama_singkat +' '+data.rombel
                    document.getElementById("mdtipe").textContent = artipe[parseInt(data.tipe)]
                    document.getElementById("mdwktmulai").textContent = tanggalku(data.mulai)
                    document.getElementById("mdwktselesai").textContent = tanggalku(data.akhir)
                    document.getElementById("mdmateri").textContent = data.materi
                    document.getElementById("mdrating").textContent = arrating[parseInt(data.rating)]
                    document.getElementById("mdcatatan").textContent = data.catatan_siswa
                    document.getElementById("mdreward").textContent = 'Rp '+ data.reward
                    document.getElementById("mdstatus").textContent = arstatus[parseInt(data.status)]
                    $('#modaldetailmengajar').modal('show', {
                        backdrop: 'static'
                    });
                }

            });
            return false;

        }

        function getdatatipe(paramsnya) {
            $.ajax({
                type: 'post',
                url: '<?= base_url() . "backoffice/mengajar/getapitipe" ?>',
                data: {
                    tipenya: paramsnya
                },
                success: function(data) {

                    document.getElementById("selectdatanya").innerHTML = data;
                    jQuery(document).ready(function() {
                        // For select 2
                        $(".select2").select2();

                    });
                }
            });
        }

        function getalldata() {
            $.ajax({
                type: 'post',
                url: '<?= base_url() . "backoffice/mengajar/getalldata" ?>',
                data: {
                    tahunnya: document.getElementById('tahunnya').value,
                    tglmulai: document.getElementById('tglmulai').value,
                    tglakhir: document.getElementById('tglakhir').value,
                    kode_tipe: document.getElementById('kode_tipe').value,
                    tipenya: document.getElementById('tipefilter').value,
                },
                dataType: 'JSON',
                success: function(dataku) {
                    var html = '';
                    var i, no = 1;
                    var data = dataku.data;
                    console.log(dataku);

                    if (data.length > 0) {
                        var vrtipe = ['', 'Sesuai Jadwal', 'Pengganti'];
                        var vrstatus = ['', 'Proses', 'Menunggu Rating', 'Selesai', 'Tidak Masuk', 'Izin'];
                        html += '<table id="tabeldata" class="table table-bordered table-striped"><thead><tr><th>No</th><th>Mata Pelajaran</th><th>Kelas</th><th>Nama Guru</th><th>Materi</th><th>Tipe Guru</th><th>Status</th><th>Dimulai Pada</th></tr></thead><tbody id="show_data">';
                        for (i = 0; i < data.length; i++) {


                            html += '<tr>' +
                                '<td>' + no + '</td>' +
                                '<td>' + data[i].nama_mapel + ' <a href="#" onclick=detail("' + data[i].kode_mengajar + '")>Detail</a></td>' +
                                '<td>' + data[i].no_kelas + ' ' + data[i].nama_singkat + ' ' + data[i].rombel + '</td>' +
                                '<td>' + data[i].nama_guru + '</td>' +
                                '<td>' + data[i].materi + '</td>' +
                                '<td>' + vrtipe[data[i].tipe] + '</td>' +
                                '<td>' + vrstatus[data[i].status] + '</td>' +
                                '<td>' + tanggalku(data[i].mulai) + '</td>' +
                                '</tr>';
                            no++;
                        }
                        html += '</tbody></table>';
                        document.getElementById('tempatdata').innerHTML = html;
                        $('#tabeldata').DataTable();
                    } else {
                        html += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button><h3 class='text-danger'><i class='fa fa-check-circle'></i>Informasi</h3>Tidak Ada Data Mengajar Di Temukan</div>";
                        document.getElementById('tempatdata').innerHTML = html;
                    }
                }
            });
        }


        function tanggalku(tgl) {

            var splitwaktu = tgl.split(' ');
            var explode = splitwaktu[0].split('-');
            var thn = explode[0];
            var bln = explode[1];
            var hari = explode[2];
            var listbulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            var harinya = hari + ' ' + listbulan[parseInt(bln)] + ' ' + thn + ' ' + splitwaktu[1];
            return harinya;
        }
    </script>
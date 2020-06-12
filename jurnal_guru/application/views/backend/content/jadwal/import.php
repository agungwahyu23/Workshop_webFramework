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
                    <a class="btn btn-info" style="float: right; margin-bottom: 10px;" href="<?= base_url('assets/template_import_jadwal.csv') ?>"><i class="fas fa-download"></i> Template Excel</a>


                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<div class='alert alert-" . $_SESSION['message'][0] . "'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>
                                        <h3 class='text-" . $_SESSION['message'][0] . "'><i class='fa fa-check-circle'></i>" . $_SESSION['message'][2] . "</h3>" . $_SESSION['message'][1] . "
                                        </div>";
                    }
                    ?>

                    <form class="m-t-10" method="post" id="import_form" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Pilih File Excel <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="file_excel" id="file_excel" class="form-control" required accept=".csv, .xls">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-xs-right" style="margin-top: 40px;">
                                    <button type="submit" id="btncekdata" class="btn btn-primary"> Cek Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row" id="datacek">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>assets/new/js/core/jquery.3.2.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var twoToneButton = document.getElementById('btncekdata');
            $('#import_form').on('submit', function(event) {

                event.preventDefault();
                twoToneButton.innerHTML = "Proses . . .";
                $('#btncekdata').addClass('spinning');

                $.ajax({

                    url: "<?php echo base_url('backoffice/jadwal/import') ?>",

                    method: "POST",

                    data: new FormData(this),

                    contentType: false,

                    cache: false,

                    processData: false,

                    success: function(data) {

                        document.getElementById("datacek").innerHTML = data;
                        twoToneButton.classList.remove('spinning');
                        twoToneButton.innerHTML = "Cek Data";
                        // console.log(data);

                        // $('#file').val('');

                        // load_data();

                    }

                })

            });


        });
    </script>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/favicon.png'); ?>">
    <title><?= $title ?></title>
    <!-- Bootstrap Core CSS -->
    <script src="<?= base_url('assets/new/js/plugin/webfont/webfont.min.js') ?>"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['<?php echo base_url('assets/new/css/fonts.min.css') ?>']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <link href="<?= base_url('assets/new/css/atlantis.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/new/css/custom.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/Magnific-Popup-master/dist/magnific-popup.css'); ?>" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div class="wrapper">
        <?php
        // if(!$_SESSION['id']){
        //   redirect(base_url());
        // }
        include str_replace("system", "application/views/backend/", BASEPATH) . "/layout/navbar.php";
        include str_replace("system", "application/views/backend/", BASEPATH) . "/layout/sidebar.php";
        echo '<div class="main-panel"><div class="content">';
        include str_replace("system", "application/views/backend/", BASEPATH) . "/layout/content.php";
        echo '</div></div>';
        ?>

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <!-- <footer class="footer">
                © 2018 Primaland by primaitech.com
            </footer> -->
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
    </div>
    </div>

    <div class="modal fade" id="modal_delete">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <h4 class="modal-title" style="text-align:center;">Apakah Anda yakin ingin menghapus Data ini ?</h4>
                </div>

                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                    <a href="#" class="btn btn-danger" id="delete_link">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_konfirmasi">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <h4 class="modal-title" id="modal_pesan" style="text-align:center;"></h4>
                </div>

                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                    <a href="#" class="btn btn-danger" id="link_goto">Konfirmasi</a>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        function confirm_modal(delete_url) {
            $('#modal_delete').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('delete_link').setAttribute('href', delete_url);
        }

        function modal_konfir(url, pesan) {
            $('#modal_konfirmasi').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('link_goto').setAttribute('href', url);
            document.getElementById('modal_pesan').innerHTML = pesan;
        }
    </script>
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/new/js/core/jquery.3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url() ?>assets/new/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/new/js/core/bootstrap.min.js"></script>

    <script src="<?= base_url() ?>assets/new/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url() ?>assets/new/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="<?= base_url() ?>assets/new/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/new/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url() ?>assets/new/js/atlantis.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url() ?>assets/js/sidebarmenu.js"></script>
    <script src="<?= base_url() ?>assets/new/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});
        })
    </script>
    <script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
        // $(document).ready(function() {
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });
        // })
    </script>

    <script src="<?= base_url() ?>assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>

    <script src="<?= base_url() ?>assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function() {
            // For select 2
            $(".select2").select2();

        });
    </script>
    <script src="<?= base_url() ?>assets/js/jquery.masknumber.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.duit').maskNumber({
                integer: true
            });


        });
    </script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script> -->
    <script>
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel'
            ]
        });
    </script>
    
</body>

</html>
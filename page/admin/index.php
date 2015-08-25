<?php
session_start();

include_once '../validasi/kelas_validasi.php';
include_once '../model/petugas_model.php';

if (!isset($_SESSION['username_login_admin']) && !isset($_SESSION['password_login_admin'])) {
    Validasi::harusLogin();
} else {
    $username = $_SESSION['username_login_admin'];
    $password = $_SESSION['password_login_admin'];
    $pdao = new PetugasDaoImpl();
    $p = $pdao->login($username, $password);
    $namaPetugas = $p->getNamaPetugas();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta charset="UTF-8">
            <title>Bumiayu Cell</title>
            <link href="../../styles/bootstrap/bootstrap.css" rel="stylesheet"/>
            <link href="../../styles/bootstrap/bootstrap.min.css" rel="stylesheet"/>
            <link type="text/css" href="../../js/bootstrap/themes/base/jquery.ui.all.css" rel="stylesheet"/>
            <script type="text/javascript" src="../../js/bootstrap/bootstrap.js"></script>
            <script type="text/javascript" src="../../js/bootstrap/bootstrap.min.js"></script>
            <script type="text/javascript" src="../../js/bootstrap/bootstrap-modal.js"></script>
            <script type="text/javascript" src="../../js/bootstrap/jquery-1.8.2.js"></script>
            <script type="text/javascript" src="../../js/bootstrap/ui/jquery.ui.core.js"></script>
            <script type="text/javascript" src="../../js/bootstrap/ui/jquery.ui.widget.js"></script>
            <script type="text/javascript" src="../../js/bootstrap/ui/jquery.ui.datepicker.js"></script>
            <script src="../../js/setup.js" type="text/javascript"></script>
            <script src="../../js/datepicker/jquery.ui.core.js" type="text/javascript"></script>
            <script src="../../js/datepicker/jquery.ui.widget.js" type="text/javascript"></script>
            <script src="../../js/datepicker/jquery.ui.datepicker.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(function() {
                    $("#tanggal_awal").datepicker({
                        changeMonth: true,
                        changeYear: true
                    });
                    $("#tanggal_awal").datepicker("option", "dateFormat", "yy-mm-dd");
                });
            </script>
            <script type="text/javascript">
                $(function() {
                    $("#tanggal_akhir").datepicker({
                        changeMonth: true,
                        changeYear: true
                    });
                    $("#tanggal_akhir").datepicker("option", "dateFormat", "yy-mm-dd");
                });
            </script>
            <script src="../../js/validate/jquery.validate.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#form-produk').validate({
                        messages: {
                            nama_produk: {
                                required: "Masukan Nama Produk !"
                            },
                            harga_pokok: {
                                required: "Masukan Harga Pokok !"
                            },
                            harga_jual: {
                                required: "Masukan Harga Jual !"
                            },
                            spesifikasi: {
                                required: "Masukan Spesifikasi !"
                            }
                        }
                    });
                    setupLeftMenu();
                    setSidebarHeight();


                });

            </script>
    </head>
    <body>

        <div class="container">

            <?php
            include 'controller_page_admin.php';
            ?>
        </div><!-- Container -->
    </body>
</html>
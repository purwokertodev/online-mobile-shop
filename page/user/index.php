<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="stylesheet" href="../../styles/jq-mobile/css/themes/default/jquery.mobile-1.4.5.min.css"/>
        <link rel="stylesheet" href="../../styles/jq-mobile/_assets/css/jqm-demos.css"/>
        <script type="text/javascript" src="../../js/jq-mobile/jquery.js"></script>
        <script type="text/javascript" src="../../styles/jq-mobile/_assets/js/index.js"></script>
        <script type="text/javascript" src="../../js/jq-mobile/jquery.mobile-1.4.5.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="../../js/map/markerclusterer_packed.js"></script>
        <title>Bumiayu Cell</title>
        <script type="text/javascript" src="../../js/validate/jquery.validate.js"></script>
    </head>
    <body>
        <div data-role="page" id="home" class="jqm-demos">
            <header data-role="header" data-position="fixed">
                <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="false" data-icon-shadow="false">Back</a>
                <div style="text-align: center">
                    <h4><img src="../../images/icon/cellphone-3.png"/> Bumiayu Cell</h4>
                </div>
                <nav data-role="navbar">
                    <ul>
                        <li><a href="index.php?user=home">Home</a></li>
                        <li><a href="index.php?user=panduan">Panduan</a></li>
                        <li><a href="index.php?user=tutup">Keranjang belanja</a></li>
                        <li><a href="index.php?user=daftar_pabrikan">Produk</a></li>
                        <li><a href="index.php?user=menu_member">Pembeli</a></li>
                        <li><a href="index.php?user=konfirmasi_pembayaran">Konfirmasi</a></li>
                        <li><a href="denah.php">Denah</a></li>
                        <li><a href="index.php?user=tentang">Tentang</a></li>
                    </ul>
                </nav>
            </header>
            <?php
            include 'controller_page_user.php';
            ?>
            <footer data-role="footer" data-position="fixed">
                <h3>
                    <?php
                    $tahun = date('Y');
                    echo '&copy Bumiayu Cell ' . $tahun;
                    ?>
                </h3>
            </footer>
        </div>
    </body>
</html>
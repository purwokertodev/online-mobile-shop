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
        <script type="text/javascript">
            var peta;
            var gambarIcon;
            gambarIcon = '../../images/icon/bc2.png';
            var lokasiBaru = new google.maps.LatLng(-7.253645, 109.006375);
            function peta_awal() {
                var petaoption = {
                    zoom: 8,
                    center: lokasiBaru,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                peta = new google.maps.Map(document.getElementById("map_canvas"), petaoption);
                
                var tanda = new google.maps.Marker({
                    position: lokasiBaru,
                    map: peta,
                    icon: gambarIcon,
                    title:'Bumiayu Cell',
                    clickable: true
                });
            }
        </script>
    </head>
    <body onload="peta_awal()">
        <div data-role="page" id="home" class="jqm-demos">
            <header data-role="header" data-position="fixed">
                <div style="text-align: center">
                    <h4><img src="../../images/icon/cellphone-3.png"/> Bumiayu Cell</h4>
                </div>
                <nav data-role="navbar">
                    <ul>
                        <li><a href="index.php?user=home">Home</a></li>
                        <li><a href="index.php?user=panduan">Panduan</a></li>
                        <li><a href="index.php?user=keranjang">Keranjang belanja</a></li>
                        <li><a href="index.php?user=daftar_pabrikan">Produk</a></li>
                        <li><a href="index.php?user=menu_member">Pembeli</a></li>
                        <li><a href="index.php?user=konfirmasi_pembayaran">Konfirmasi</a></li>
                        <li><a href="denah.php">Denah</a></li>
                        <li><a href="index.php?user=tentang">Tentang</a></li>
                    </ul>
                </nav>
            </header>
            <div class="ui-content" data-role="main">
                <div style="text-align: center">
                    <h3>Lokasi kami</h3>
                    <div id="map_canvas" style="width:100%; height:350px"></div>
                </div>
            </div>
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
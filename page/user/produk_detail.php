<?php
include_once '../model/produk_model.php';

if (isset($_GET['kode_produk'])) {
    $kodeProduk = filter_input(INPUT_GET, 'kode_produk');
    $token = filter_input(INPUT_GET, 'token');

    $cek = md5(md5($kodeProduk) . md5('kata diacak'));

    if ($token == $cek) {
        $pdao = new ProdukDaoImpl();
        $p = $pdao->findOne($kodeProduk);
        $kodeProduk = $p->getKodeProduk();
        $merk = $p->getNamaProduk();
        $namaPabrikan = $p->getNamaPabrikan();
        $stok = $p->getStok();
        $hargaPokok = $p->getHargaPokok();
        $hargaJual = $p->getHargaJual();
        $namaGambar = $p->getNamaGambar();
        $spek = $p->getSpesifikasi();
        $lokasiGambar = $p->getLokasiGambar();
        ?>
        <div class="ui-content" data-role="main"  data-back-button="true">
            <div style="text-align: center">
                <h3><?php echo $merk;?></h3>
                <a href="#gambarPop" data-rel="popup" data-position-to="window" data-transition="fade"><img class="popphoto" src="../../<?php echo $lokasiGambar;?>" width="200"/></a>
                <p>Stok tersisa : <?php echo $stok;?></p>
                <p>Harga Rp. : <?php echo number_format($hargaJual, 2,',','.');?></p>
                <div data-role="collapsible" data-theme="b" data-content-theme="b">
                    <h4>Spesifikasi</h4>
                    <p><?php echo $spek?></p>
                </div>
                <div data-role="popup" id="gamparPop" data-overlay-theme="b" data-theme="b" data-corners="false">
                    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Tutup</a>
                    <img class="popphoto" src="../../<?php echo $lokasiGambar;?>" style="max-height: 512px"/>
                </div>
            </div>
        </div>

        <?php
    } else {
        echo 'SQL injection terdeteksi !!';
    }
}
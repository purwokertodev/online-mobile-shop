<?php

include_once '../model/produk_model.php';

if (isset($_GET['kode_produk'])) {
    $kodeProduk = filter_input(INPUT_GET, 'kode_produk');
    $token = filter_input(INPUT_GET, 'token');

    $cek = md5(md5($kodeProduk) . md5('kata diacak'));
    if ($token == $cek) {
        $pdao = new ProdukDaoImpl();
        $p = $pdao->findOne($kodeProduk);
        $lokasiGambar = $p->getLokasiGambar();
        unlink("../../" . $lokasiGambar);

        $pdao_delete = new ProdukDaoImpl();
        $pdao_delete->delete($kodeProduk);
        ?>
        <script>document.location.href = 'index.php?admin=produk';</script>
        <?php

    } else {
        echo 'SQL injection terdeteksi !!';
    }
}

<?php

include_once '../model/pabrikan_model.php';

if (isset($_GET['kode_pabrikan'])) {

    $kode_pabrikan = filter_input(INPUT_GET, 'kode_pabrikan');
    $token = filter_input(INPUT_GET, 'token');

    $cek = md5(md5($kode_pabrikan) . md5('kata diacak'));

    if ($cek == $token) {
        $pdao = new PabrikanDaoImpl();
        $pdao->delete($kode_pabrikan);
        ?>
        <script>document.location.href = 'index.php?admin=daftar_pabrikan';</script>
        <?php

    } else {
        echo 'sql injeksi terdeteksi..';
    }
}

<?php

include_once '../model/panduan_belanja_model.php';

if (isset($_GET['kode_panduan'])) {
    $kodePanduan = filter_input(INPUT_GET, 'kode_panduan');
    $token = filter_input(INPUT_GET, 'token');

    $cek = md5(md5($kodePanduan) . md5("kata diacak"));

    if ($cek == $token) {
        $pdao = new PanduanBelanjaDaoImpl();
        $pdao->delete($kodePanduan);
        ?>
        <script>document.location.href = 'index.php?admin=panduan_belanja';</script>
        <?php

    } else {
        echo 'sql injeksi terdeteksi..';
    }
}
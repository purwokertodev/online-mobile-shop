<?php

include_once '../model/propinsi_model.php';

if (isset($_GET['kode_propinsi'])) {
    $kodePropinsi = filter_input(INPUT_GET, 'kode_propinsi');
    $token = filter_input(INPUT_GET, 'token');

    $cek = md5(md5($kodePropinsi) . md5('kata diacak'));

    if ($cek == $token) {
        $pdao = new PropinsiDaoImpl();
        $pdao->delete($kodePropinsi);
        ?>
        <script>document.location.href = 'index.php?admin=data_propinsi';</script>
        <?php

    } else {
        echo "sql injeksi terdeteksi..";
    }
}
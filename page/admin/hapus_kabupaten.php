<?php

include_once '../model/kabupaten_model.php';

if (isset($_GET['kode_kabupaten'])) {
    $kodeKabupaten = filter_input(INPUT_GET, 'kode_kabupaten');
    $token = filter_input(INPUT_GET, 'token');

    $cek = md5(md5($kodeKabupaten) . md5("kata diacak"));

    if ($cek == $token) {
        $kabDao = new KabupatenDaoImpl();
        $kabDao->delete($kodeKabupaten);
        ?>
        <script>document.location.href = "index.php?admin=data_kabupaten";</script>
        <?php

    } else {
        echo 'sql injeksi terdeteksi..';
    }
}

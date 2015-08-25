<?php

include_once '../model/kecamatan_model.php';

if (isset($_GET['kode_kecamatan'])) {
    $kodeKecamatan = filter_input(INPUT_GET, 'kode_kecamatan');
    $token = filter_input(INPUT_GET, 'token');

    $cek = md5(md5($kodeKecamatan) . md5('kata diacak'));

    if ($cek == $token) {
        $kdao = new KecamatanDaoImpl();
        $kdao->delete($kodeKecamatan);
        ?>
        <script>document.location.href = 'index.php?admin=data_daerah';</script>
        <?php

    } else {
        echo 'sql injeksi terdeteksi..';
    }
}

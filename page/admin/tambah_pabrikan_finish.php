<?php

include_once '../model/pabrikan_model.php';

if (isset($_POST['tambah'])) {
    $kodePabrikan = time();
    $nama_pabrikan = filter_input(INPUT_POST, 'nama_pabrikan');
    $keterangan = filter_input(INPUT_POST, 'keterangan');

    $pdao = new PabrikanDaoImpl();
    $pdao->save($kodePabrikan, $nama_pabrikan, $keterangan);
    ?>
    <script>document.location.href = 'index.php?admin=daftar_pabrikan';</script>
    <?php

}
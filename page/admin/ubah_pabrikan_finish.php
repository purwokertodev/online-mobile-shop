<?php

include_once '../model/pabrikan_model.php';

if (isset($_POST['ubah'])) {

    $kode_pabrikan = filter_input(INPUT_POST, 'kode_pabrikan');
    $nama = filter_input(INPUT_POST, 'nama_pabrikan');
    $keterangan = filter_input(INPUT_POST, 'keterangan');

    $pdao = new PabrikanDaoImpl();
    $pdao->update($kode_pabrikan, $nama, $keterangan);
    ?>
    <script>document.location.href = 'index.php?admin=daftar_pabrikan';</script>
    <?php

}

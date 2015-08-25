<?php

include_once '../model/propinsi_model.php';

if (isset($_POST['Simpan'])) {
    $kode = time();
    $namaPropinsi = filter_input(INPUT_POST, 'nama_propinsi');

    $pdao = new PropinsiDaoImpl();
    $pdao->save($kode, $namaPropinsi);
    ?>
    <script>document.location.href = 'index.php?admin=data_propinsi';</script>
    <?php

}
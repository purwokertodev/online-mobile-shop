<?php

include_once '../model/propinsi_model.php';

if (isset($_POST['Simpan'])) {
    $kode = filter_input(INPUT_POST, 'kode_propinsi');
    $namaPropinsi = filter_input(INPUT_POST, 'nama_propinsi');

    $pdao = new PropinsiDaoImpl();
    $pdao->update($kode, $namaPropinsi);
    ?>
    <script>document.location.href = 'index.php?admin=data_propinsi';</script>
    <?php

}
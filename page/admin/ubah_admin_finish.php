<?php

include_once '../model/petugas_model.php';

if (isset($_POST['Simpan'])) {
    $kodePetugas = filter_input(INPUT_POST, 'kode_petugas');
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $pdao = new PetugasDaoImpl();
    $pdao->update($kodePetugas, $username, $password);
    ?>
    <script>document.location.href = 'index.php?admin=ubah_admin';</script>
    <?php

}
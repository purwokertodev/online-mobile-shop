<?php

include_once '../model/panduan_belanja_model.php';

if (isset($_POST['Ubah'])) {
    $kodePanduan = filter_input(INPUT_POST, 'kode_panduan');
    $isiPanduan = filter_input(INPUT_POST, 'isi_panduan');

    $pdao = new PanduanBelanjaDaoImpl();
    $pdao->update($kodePanduan, $isiPanduan);
    ?>
    <script>document.location.href = 'index.php?admin=panduan_belanja';</script>
    <?php

}

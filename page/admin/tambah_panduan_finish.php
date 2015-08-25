<?php

include_once '../model/panduan_belanja_model.php';

if(isset($_POST['Simpan'])){
    $isiPanduan = filter_input(INPUT_POST, 'isi_panduan');
    
    $pdao = new PanduanBelanjaDaoImpl();
    $pdao->save($isiPanduan);
    
    ?>
<script>document.location.href = 'index.php?admin=panduan_belanja';</script>
<?php
}

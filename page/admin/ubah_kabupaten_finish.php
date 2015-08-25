<?php

include_once '../model/kabupaten_model.php';

if(isset($_POST['Ubah'])){
    $kodeKabupaten = filter_input(INPUT_POST, 'kode_kabupaten');
    $namaKabupaten = filter_input(INPUT_POST, 'nama_kabupaten');
    $kodeProp = filter_input(INPUT_POST, 'kode_propinsi');
    
    $kabDao = new KabupatenDaoImpl();
    $kabDao->update($kodeKabupaten, $kodeProp, $namaKabupaten);
    
    ?>
<script>document.location.href="index.php?admin=data_kabupaten";</script>
<?php
}

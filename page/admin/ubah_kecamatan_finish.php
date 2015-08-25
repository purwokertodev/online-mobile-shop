<?php

include_once '../model/kecamatan_model.php';

if (isset($_POST['Simpan'])) {
    $kode = filter_input(INPUT_POST, 'kode_kecamatan');
    $namaKecamatan = filter_input(INPUT_POST, 'nama_kecamatan');
    $kodeKabupaten = filter_input(INPUT_POST, 'kode_kabupaten');
    $biayaPengiriman = filter_input(INPUT_POST, 'biaya_pengiriman');
    

    $kdao = new KecamatanDaoImpl();
    $kdao->update($kode, $kodeKabupaten, strtoupper($namaKecamatan), $biayaPengiriman);
    ?>
    <script>document.location.href = 'index.php?admin=data_daerah';</script>
    <?php

}
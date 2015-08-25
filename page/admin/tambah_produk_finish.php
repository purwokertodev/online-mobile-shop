<?php

include_once '../model/produk_model.php';

if (isset($_POST['Simpan'])) {
    $kodeProduk = time();
    $kodePabrikan = filter_input(INPUT_POST, 'kode_pabrikan');
    $namaProduk = filter_input(INPUT_POST, 'nama_produk');
    $stok = filter_input(INPUT_POST, 'stok');
    $hargaPokok = filter_input(INPUT_POST, 'harga_pokok');
    $hargaJual = filter_input(INPUT_POST, 'harga_jual');
    $spesifikasi = filter_input(INPUT_POST, 'spesifikasi');
    $beratBarang = filter_input(INPUT_POST, 'berat_barang');
    $namaGambar = $_FILES['gambar_produk']['name'];
    $ukuranGambar = $_FILES['gambar_produk']['size'];
    $gambarError = $_FILES['gambar_produk']['error'];
    $gambarTmpName = $_FILES['gambar_produk']['tmp_name'];

    $namaGambarBaru = time() . "-" . $kodePabrikan . "-" . $namaGambar;

    $uploadDir = "../../gambar_hp/" . $kodePabrikan . "/";
    $lokasiUntukUpload = $uploadDir . $namaGambarBaru;
    if ($ukuranGambar > 0 || $gambarError == 0) {
        $oldMask = umask(0);
        mkdir("../../gambar_hp/$kodePabrikan", 0777);
        umask($oldMask);
        $move = move_uploaded_file($gambarTmpName, $lokasiUntukUpload);
        if ($move) {
            $pdao = new ProdukDaoImpl();
            $pdao->save($kodeProduk, $kodePabrikan, $namaProduk, $stok, $hargaPokok, $hargaJual, $spesifikasi, $namaGambarBaru, "gambar_hp/$kodePabrikan/$namaGambarBaru",$beratBarang);
            ?>
            <script>document.location.href = 'index.php?admin=produk';</script>
            <?php

        } else {
            echo 'error';
        }
    } else {
        echo 'Error';
    }
}

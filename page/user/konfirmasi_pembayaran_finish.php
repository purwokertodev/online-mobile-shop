<?php
session_start();
include_once '../model/transaksi_model.php';
include_once '../model/konfirmasi_model.php';

if (isset($_POST['konfirmasi'])) {
    $kodeTransaksi = filter_input(INPUT_POST, 'kode_transaksi');
    $namaGambar = $_FILES['gambar_bukti']['name'];
    $ukuranGambar = $_FILES['gambar_bukti']['size'];
    $gambarError = $_FILES['gambar_bukti']['error'];
    $gambarTmpName = $_FILES['gambar_bukti']['tmp_name'];

    $tdao = new TransaksiDaoImpl();
    $transaksi = $tdao->findOne($kodeTransaksi);
    if ($transaksi->getKodeTransaksi() == $kodeTransaksi) {

        $namaGambarBaru = time() . "-" . $kodeTransaksi . "-" . $namaGambar;
        $uploadDir = "../../gambar_konfirmasi/";
        $lokasiUntukUpload = $uploadDir . $namaGambarBaru;
        if ($ukuranGambar > 0 || $gambarError == 0) {
            $move = move_uploaded_file($gambarTmpName, $lokasiUntukUpload);
            if ($move) {
                $kdao = new KonfirmasiDaoImpl();
                $kdao->save(time(), $kodeTransaksi, $namaGambarBaru, $lokasiUntukUpload);
                unset($_SESSION['pembeli_login']);
                ?>
                <div style="text-align: center">
                    <h3>Bukti Pembayaran berhasil dikirim</h3>
                    <p>Barang akan segera dikirim..</p>
                </div>
                <?php
            }
        } else {
            echo 'error';
        }
    } else {
        ?>
        <div style="text-align: center">
            <h3>Kode Transaksi Tidak Sesuai</h3>
            <p><a href="index.php?user=konfirmasi_pembayaran">Silahkan anda coba lagi</a></p>
        </div>
        <?php
    }
}



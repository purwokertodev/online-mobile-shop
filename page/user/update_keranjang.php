<?php

session_start();

include_once '../model/produk_model.php';

if (isset($_POST['Update'])) {
    $kodeProduk = filter_input(INPUT_POST, 'kode');
    $jumlah_beli = filter_input(INPUT_POST, 'jumlah_beli');

    $pdao = new ProdukDaoImpl();
    $p = $pdao->findOne($kodeProduk);
    $merk = $p->getNamaProduk();
    $namaPabrikan = $p->getNamaPabrikan();
    $stok = $p->getStok();
    $hargaPokok = $p->getHargaPokok();
    $hargaJual = $p->getHargaJual();
    $namaGambar = $p->getNamaGambar();
    $spek = $p->getSpesifikasi();
    $lokasiGambar = $p->getLokasiGambar();

    if ($jumlah_beli > $stok) {
        echo "<div style='text-align: center'><h3>Stok tidak cukup !!</h3></div>";
    } else {
        $new_produk = array(array('kode_produk' => $kodeProduk, 'harga_produk' => $hargaJual, 'jumlah_beli' => $jumlah_beli));

        if (isset($_SESSION["daftar_belanja"])) {
            $ada = FALSE;

            foreach ($_SESSION["daftar_belanja"] as $cart_item) {
                if ($cart_item['kode_produk'] == $kodeProduk) {
                    $produk[] = array('kode_produk' => $cart_item["kode_produk"], 'harga_produk' => $cart_item["harga_produk"], 'jumlah_beli' => $jumlah_beli);
                    $ada = TRUE;
                } else {
                    $produk[] = array('kode_produk' => $cart_item["kode_produk"], 'harga_produk' => $cart_item["harga_produk"], 'jumlah_beli' => $cart_item["jumlah_beli"]);
                }
            }

            if ($ada == FALSE) {
                $_SESSION["daftar_belanja"] = array_merge($produk, $new_produk);
            } else {
                $_SESSION["daftar_belanja"] = $produk;
            }
        } else {
            $_SESSION["daftar_belanja"] = $new_produk;
        }
        ?>
        <script>document.location.href = 'index.php?user=keranjang';</script>
        <?php

    }
}
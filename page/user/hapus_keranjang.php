<?php

session_start();

if (isset($_SESSION['daftar_belanja']) && isset($_GET['kode'])) {
    $kodeProduk = filter_input(INPUT_GET, 'kode');

    foreach ($_SESSION['daftar_belanja'] as $cart_item) {
        if ($cart_item['kode_produk'] != $kodeProduk) {
            $produk[] = array('kode_produk' => $cart_item["kode_produk"], 'harga_produk' => $cart_item["harga_produk"], 'jumlah_beli' => $cart_item['jumlah_beli']);
        }
        $_SESSION['daftar_belanja'] = $produk;
    }
    ?>
    <script>document.location.href = 'index.php?user=keranjang';</script>
    <?php

}

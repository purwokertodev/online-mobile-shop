<div class="ui-content" data-role="main">
    <div style="text-align: center">
        <h3>Keranjang Belanja</h3>
    </div>
    <?php
    session_start();
    include_once '../model/produk_model.php';

    if (isset($_SESSION['daftar_belanja'])) {
        $total = 0.0;
        echo "<ul data-role='listview' data-split-icon='delete' data-split-theme='a' data-inset='true'>";
        foreach ($_SESSION["daftar_belanja"] as $cart_item) {
            $kodeProduk = $cart_item["kode_produk"];
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

            $sub_total = $cart_item["jumlah_beli"] * $cart_item["harga_produk"];
            $total = $total + $sub_total;
            $jumlahBeli = $cart_item["jumlah_beli"];
            echo "<li>";
            echo "<a href=''#><img src='../../$lokasiGambar'/><h3>$merk</h3><p>Jumlah beli : $jumlahBeli</p><span class='ui-li-count'>Subtotal : Rp.".  number_format($sub_total, 2, ',','.')."</span></a>";
            echo "<a href='index.php?user=hapus_keranjang&kode=$kodeProduk'>Hapus keranjang</a>";
            echo "</li>";
            
        }
        echo "</ul>";
        echo "<div class='ui-field-contain'><legend>Total :</legend><strong>Rp.".  number_format($total, 2, ',','.')."</strong></div>";
        echo "<a href='index.php?user=ubah_alamat_pengiriman' name='Simpan' class='ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline'>Selesaikan Belanja</a>";
    } else {
        echo "<div style='text-align: center'>";
        echo "<img src='../../images/shopping_cart.png' width='200' />";
        echo "<h4>Keranjang belanja anda masih kosong.</h4>";
        echo "</dvi>";
    }
    ?>
</div>
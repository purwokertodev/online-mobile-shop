<?php
session_start();

include_once '../model/transaksi_model.php';
include_once '../model/produk_model.php';
include_once '../model/kecamatan_model.php';
include_once '../model/member_model.php';

if (isset($_SESSION['daftar_belanja']) && isset($_SESSION['pembeli_login'])) {
    $tdao = new TransaksiDaoImpl();
    $kodePembeli = $_SESSION['pembeli_login']['kode_pembeli'];
    $kodeKecamatan = '';

    //Mendapatkan satu pembeli berdasarkan kode pembeli, kemudian pembeli tersebut diambil kode kecamatannya.
    $pembeliDao = new MemberDaoImpl();
    $pembeli = $pembeliDao->findOne($kodePembeli);
    if ($pembeli->getKecamatanPengiriman() == "-") {
        $kodeKecamatan = $pembeli->getKecamatan();
    } else {
        $kodeKecamatan = $pembeli->getKecamatanPengiriman();
    }

    //Setelah mendapatkan kode kecamatan dari pembeli, kode kecamatan digunakan untuk mengambil satu kecamatan berdasarkan kodenya.
    //Kecamatan mempunyai field biaya pengiriman, ditambahkan ke total.
    $kecamatanDao = new KecamatanDaoImpl();
    $kecamatan = $kecamatanDao->findOne($kodeKecamatan);
    $biayaPengirimanKecamatan = $kecamatan->getBiayaPengiriman();

    $kodeTransaksi = time();
    // tiga digit terakhir;
    $kodeTranSub = substr($kodeTransaksi, 7);


    $transakiCekPembeli = $tdao->findByPembeli($kodePembeli);
    //Memeriksa apakah pembeli sudah pernah belanja atau tidak, kalau belum pernah tidak mendapat diskon, jika iya maka sebaliknya
    if (count($transakiCekPembeli) != 0) {
        $total = 0.0;
        $totalAfterDiskon = 0.0;
        $diskon = 0.0;
        $biayaPengiriman = 0.0;
        $biayaPengirimanPerProduk = 0.0;

        $tdaoSave = new TransaksiDaoImpl();
        foreach ($_SESSION['daftar_belanja'] as $cart_item) {
            $produkDaoFind = new ProdukDaoImpl();
            $produkDaoUpdate = new ProdukDaoImpl();
            $transaksiDetailDao = new TransaksiDetailDaoImpl();
            $kodeProduk = $cart_item['kode_produk'];
            $hargaJual = $cart_item['harga_produk'];
            $jumlahBeli = $cart_item['jumlah_beli'];
            $subTotal = $jumlahBeli * $hargaJual;

            //Persiapan update barang
            $produk = $produkDaoFind->findOne($kodeProduk);
            $merk = $produk->getNamaProduk();
            $kodePabrikan = $produk->getKodePabrikanProduk();
            $hargaPokok = $produk->getHargaPokok();
            $hargaJualProd = $produk->getHargaJual();
            $namaGambar = $produk->getNamaGambar();
            $spek = $produk->getSpesifikasi();
            $beratBarang = $produk->getBeratBarang();
            $lokasiGambar = $produk->getLokasiGambar();
            $jumlahBarangUpdate = $produk->getStok() - $jumlahBeli;
            //Update barang
            $produkDaoUpdate->update($kodeProduk, $kodePabrikan, $merk, $jumlahBarangUpdate, $hargaPokok, $hargaJualProd, $spek, $namaGambar, $lokasiGambar, $beratBarang);
            $transaksiDetailDao->save($kodeTransaksi, $kodeProduk, $jumlahBeli, $subTotal);
            $biayaPengirimanPerProduk = $beratBarang * $biayaPengirimanKecamatan;
            $biayaPengiriman += $biayaPengirimanPerProduk;
            $total += $subTotal;
        }

        if ($total > 500000) {
            $diskon = (5 * $total) / 100;
            $totalAfterDiskon = $total - $diskon;
        } else {
            $totalAfterDiskon = $total;
            $diskon = 0.0;
        }

        $totalAkhir = $totalAfterDiskon + $biayaPengiriman + $kodeTranSub;

        $tdaoSave->save($kodeTransaksi, $kodePembeli, $diskon, $biayaPengiriman, $totalAkhir);
        //Menghapus session
        //session_destroy();
        unset($_SESSION['daftar_belanja']);
        unset($_SESSION['pembeli_login']);
        ?>
        <div style="text-align: center">
            <h3>Transaksi Sukses...</h3>
            <h4>Pembeli yang terhormat,</h4>
            <h4>Catat Nomor Transaksi Anda di bawah ini Untuk Konfirmasi Pembayaran.</h4>
            <p><input type="text" value="<?php echo $kodeTransaksi; ?>"/></p>
            <p>Diskon : Rp. <?php echo number_format($diskon, 2, ',', '.'); ?></p>
            <p>Total yang harus dibayar : Rp. <?php echo number_format($totalAkhir, 2, ',', '.'); ?></p>
        </div>
        <?php
    } else {
        $total = 0.0;
        $diskon = 0.0;
        $biayaPengiriman = 0.0;
        $biayaPengirimanPerProduk = 0.0;
        $tdaoSave = new TransaksiDaoImpl();
        foreach ($_SESSION['daftar_belanja'] as $cart_item) {
            $produkDaoFind = new ProdukDaoImpl();
            $produkDaoUpdate = new ProdukDaoImpl();
            $transaksiDetailDao = new TransaksiDetailDaoImpl();
            //Mengambil isi session cart
            $kodeProduk = $cart_item['kode_produk'];
            $hargaJual = $cart_item['harga_produk'];
            $jumlahBeli = $cart_item['jumlah_beli'];
            $subTotal = $jumlahBeli * $hargaJual;

            //Persiapan update barang
            $produk = $produkDaoFind->findOne($kodeProduk);
            $merk = $produk->getNamaProduk();
            $kodePabrikan = $produk->getKodePabrikanProduk();
            $hargaPokok = $produk->getHargaPokok();
            $hargaJualProd = $produk->getHargaJual();
            $namaGambar = $produk->getNamaGambar();
            $spek = $produk->getSpesifikasi();
            $beratBarang = $produk->getBeratBarang();
            $lokasiGambar = $produk->getLokasiGambar();
            $jumlahBarangUpdate = $produk->getStok() - $jumlahBeli;
            //Update barang
            $produkDaoUpdate->update($kodeProduk, $kodePabrikan, $merk, $jumlahBarangUpdate, $hargaPokok, $hargaJualProd, $spek, $namaGambar, $lokasiGambar, $beratBarang);
            $transaksiDetailDao->save($kodeTransaksi, $kodeProduk, $jumlahBeli, $subTotal);
            $biayaPengirimanPerProduk = $beratBarang * $biayaPengirimanKecamatan;
            $biayaPengiriman += $biayaPengirimanPerProduk;
            $total += $subTotal;
        }
        $totalAkhir = $total + $biayaPengiriman + $kodeTranSub;
        $tdaoSave->save($kodeTransaksi, $kodePembeli, $diskon, $biayaPengiriman, $totalAkhir);
        //Menghapus session
        //session_destroy();
        unset($_SESSION['daftar_belanja']);
        unset($_SESSION['pembeli_login']);
        ?>
        <div style="text-align: center">
            <h3>Transaksi Sukses...</h3>
            <h4>Pembeli yang terhormat,</h4>
            <h4>Catat Nomor Transaksi Anda di bawah ini Untuk Konfirmasi Pembayaran.</h4>
            <p><input type="text" value="<?php echo $kodeTransaksi; ?>"/></p>
            <p>Diskon : Rp. <?php echo number_format($diskon, 2, ',', '.'); ?></p>
            <p>Total yang harus dibayar : Rp. <?php echo number_format($totalAkhir, 2, ',', '.'); ?></p>
        </div>
        <?php
    }
} else {
    ?>
    <div style="text-align: center">
        <h4>Pembeli yang terhormat,</h4>
        <h4>Anda belum login atau registrasi, silahkan lakukan <strong><a href="index.php?user=login_member">Login</a></strong> atau <strong><a href="index.php?user=registrasi_member">Registrasi</a></strong></h4>
    </div>
    <?php
}

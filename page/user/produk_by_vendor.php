
<?php
include_once '../model/produk_model.php';
include_once '../model/pabrikan_model.php';

if (isset($_GET['kode_vendor'])) {
    $kodeVendor = filter_input(INPUT_GET, 'kode_vendor');
    $token = filter_input(INPUT_GET, 'token');

    $pabdao = new PabrikanDaoImpl();
    $pab = $pabdao->findOne($kodeVendor);
    $namaVendor = $pab->getNamaPabrikan();
    ?>
    <div class="ui-content" data-role="main">
        <div style="text-align: center">
            <h3><?php echo $namaVendor;?></h3>
        </div>
        <ul data-role="listview" data-split-icon="plus" data-split-theme="a" data-inset="true">
            <?php
            $cek = md5(md5($kodeVendor) . md5('kata diacak'));
            if ($token == $cek) {
                $pdao = new ProdukDaoImpl();
                $data = $pdao->findByPabrikan($kodeVendor);
                for ($i = 0; $i < count($data); $i++) {
                    $p = $data[$i];
                    $kodeProduk = $p->getKodeProduk();
                    $merk = $p->getNamaProduk();
                    $namaPabrikan = $p->getNamaPabrikan();
                    $stok = $p->getStok();
                    $hargaPokok = $p->getHargaPokok();
                    $hargaJual = $p->getHargaJual();
                    $namaGambar = $p->getNamaGambar();
                    $spek = $p->getSpesifikasi();
                    $lokasiGambar = $p->getLokasiGambar();

                    $token = md5(md5($kodeProduk) . md5('kata diacak'));
                    ?>
                    <li><a href="index.php?user=produk_detail&kode_produk=<?php echo $kodeProduk;?>&token=<?php echo $token;?>"><img src="../../<?php echo $lokasiGambar;?>" alt="<?php echo $merk;?>"/>
                            <h3><?php echo $merk;?></h3> Harga Rp. <?php echo number_format($hargaJual, 2, ',', '.'); ?><span class="ui-li-count">Stok : <?php echo $stok;?></span></a>
                        <a href="#add-to-cart<?php echo $kodeProduk; ?>" data-rel="popup" data-position-to="window" data-transition="pop">Add to cart</a>
                    </li>
                    <div data-role="popup" id="add-to-cart<?php echo $kodeProduk; ?>" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width: 340px; padding-bottom: 2em;">
                        <h3>Tambah Ke Keranjang Belanja Anda</h3>
                        <h3><?php echo $merk;?></h3>
                        <p>Jika produk ini akan anda beli, silahkan klik Tambah, jika tidak klik batal.</p>
                        <form action="index.php?user=update_keranjang" method="post">
                            <div class="ui-field-contain">
                                <label for="jumlah_beli">Jumlah beli :</label>
                                <select name="jumlah_beli" id="jumlah_beli" data-iconpos="left">
                                    <?php
                                    for ($j = 1; $j <= 5; $j++) {
                                        echo "<option value='$j'>$j</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="kode" value="<?php echo $kodeProduk;?>"/>
                            </div>
                            <button type="submit" name="Update" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-plus ui-btn-icon-left ui-btn-inline ui-mini">Tambah</button>
                        </form>
                        <a href="" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-icon-delete ui-btn-right ui-btn-icon-notext ui-mini">Batal</a>
                    </div>
                    <?php
                }
            } else {
                echo 'SQL injeksi terdeteksi';
            }
        }
        ?>
    </ul>
</div>

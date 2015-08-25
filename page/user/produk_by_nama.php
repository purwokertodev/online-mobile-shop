
<div class="ui-content">
    <div style="text-align: center">
        <h4>Hasil Pencarian</h4>
        <form action="" method="post" id="form-cari-produk">
            <div class="ui-field-contain">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" class="required" placeholder="Masukan nama produk"/>
            </div>
            <div class="ui-field-contain">
                <button type="submit" name="cari" class="ui-shadow ui-btn ui-corner-all ui-icon-search ui-btn-icon-left ui-btn-inline ui-mini">Cari</button>
            </div>
        </form>
    </div>
    <ul data-role="listview" data-split-icon="plus" data-split-theme="a" data-inset="true">
        <?php
        include_once '../model/produk_model.php';

        if (isset($_POST['cari'])) {
            $namaProduk = filter_input(INPUT_POST, 'nama_produk');
            $pdao = new ProdukDaoImpl();
            $listProd = $pdao->findByName($namaProduk . "%");
            if (count($listProd) != 0) {
                for ($i = 0; $i < count($listProd); $i++) {
                    $p = $listProd[$i];
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
                                <input type="hidden" name="kode" value="<?echo $kodeProduk;?>"/>
                            </div>
                            <button type="submit" name="Update" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-plus ui-btn-icon-left ui-btn-inline ui-mini">Tambah</button>
                        </form>
                        <a href="" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-icon-delete ui-btn-right ui-btn-icon-notext ui-mini">Batal</a>
                    </div>
                    <?php
                }
            } else {
                echo "<div sytle='text-align: center'><h3>Pencarian tidak ditemukan.</h3></div>";
            }
        }
        ?>
    </ul>
    <script type="text/javascript">
        $('#form-cari-produk').validate({
            messages: {
                nama_produk: {
                    required: "Masukan nama produk !!"
                }
            }
        });
    </script>
</div>

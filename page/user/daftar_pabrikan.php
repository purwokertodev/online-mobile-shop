
<div data-role="content">
    <div style="text-align: center">
        <h4>Pabrikan/Vendor</h4>
        <p>Daftar Pabrikan di Bumiayu Cell</p>
        <form action="index.php?user=cari_produk_by_nama" method="post" id="form-cari">
            <div class="ui-field-contain">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" class="required" placeholder="Masukan nama produk"/>
            </div>
            <div class="ui-field-contain">
                <button type="submit" name="cari" class="ui-shadow ui-btn ui-corner-all ui-icon-search ui-btn-icon-left ui-btn-inline ui-mini">Cari</button>
            </div>
        </form>
    </div>
    <ul data-role="listview">
        <?php
        include_once '../model/pabrikan_model.php';
        include_once '../model/produk_model.php';

        $pdao = new PabrikanDaoImpl();
        $listPabrikan = $pdao->findAll();
        for ($i = 0; $i < count($listPabrikan); $i++) {
            $p = $listPabrikan[$i];
            $kodePabrikan = $p->getKodePabrikan();
            $namaPabrikan = $p->getNamaPabrikan();
            $keterangan = $p->getKeterangan();
            $produkDao = new ProdukDaoImpl();
            $jumlahProduk = $produkDao->jumlahProdukByVendor($kodePabrikan);

            $token = md5(md5($kodePabrikan) . md5("kata diacak"));
            ?>
            <li><a href="index.php?user=produk_by_vendor&kode_vendor=<?php echo $kodePabrikan;?>&token=<?php echo $token;?>"><?php echo $namaPabrikan;?></a><span class="ui-li-count"><?php echo $jumlahProduk.' Items';?></span></li>
                <?php
            }
            ?>
    </ul>
    <script type="text/javascript">
        $('#form-cari').validate({
            messages:{
                nama_produk:{
                    required : "Masukan nama produk !!" 
                }
            }
        });
    </script>
</div>

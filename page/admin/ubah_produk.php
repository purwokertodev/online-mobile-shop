<?php
include_once '../model/produk_model.php';

if (isset($_GET['kode_produk'])) {
    $kodeProduk = filter_input(INPUT_GET, 'kode_produk');
    $token = filter_input(INPUT_GET, 'token');

    $cek = md5(md5($kodeProduk) . md5('kata diacak'));

    if ($token == $cek) {
        $pdao = new ProdukDaoImpl();
        $p = $pdao->findOne($kodeProduk);
        $merk = $p->getNamaProduk();
        $kodePab = $p->getKodePabrikanProduk();
        $namaPabrikan = $p->getNamaPabrikan();
        $stok = $p->getStok();
        $hargaPokok = $p->getHargaPokok();
        $hargaJual = $p->getHargaJual();
        $namaGambar = $p->getNamaGambar();
        $spek = $p->getSpesifikasi();
        $lokasiGambar = $p->getLokasiGambar();
        $beratBarang = $p->getBeratBarang();
    } else {
        echo 'SQL Injection terdeteksi !!';
    }
}
?>

<div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <label class="navbar-brand label-primary">BA Cell</label>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li><a href="index.php?admin=home"><span>Home</span></a> </li>
            <li class="active"><a href="index.php?admin=produk"><span>Produk</span></a></li>
            <li><a href="index.php?admin=data_transaksi"><span>Data Transaksi</span></a></li>
            <li><a href="index.php?admin=data_konfirmasi">Data Konfirmasi</a></li>
            <li><a href="index.php?admin=data_member"><span>Data Pembeli</span></a></li>
            <li><a href="index.php?admin=data_daerah">Data Daerah</a></li>
            <li><a href="index.php?admin=panduan_belanja"><span>Panduan</span></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout_admin.php">Logout</a></li>
        </ul>
    </div>
</div> <!-- Navbar -->
<div class="jumbotron">
    <h1>Bumiayu Cell</h1>
    <p>Toko Handphone Online</p>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        Ubah Data Produk
    </div>
    <div class="panel-body">
        <form action="index.php?admin=ubah_produk_finish" method="post" id="form-produk" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="kode_produk" value="<?php echo $kodeProduk;?>"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Pabrikan/Vendor :</label>
                <div class="col-sm-4">
                    <select name="kode_pabrikan" class="form-control">
                        <?php
                        include_once '../model/pabrikan_model.php';

                        $pdao = new PabrikanDaoImpl();
                        $data = $pdao->findAll();
                        for ($i = 0; $i < count($data); $i++) {
                            $p = $data[$i];
                            $kodePabrikan = $p->getKodePabrikan();
                            $namaPabrikan = $p->getNamaPabrikan();
                            if($kodePab == $kodePabrikan){
                                echo "<option selected='true' value='$kodePabrikan'>$namaPabrikan</option>";
                            }  else {
                                echo "<option value='$kodePabrikan'>$namaPabrikan</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Produk :</label>
                <div class="col-sm-4">
                    <input type="text" name="nama_produk" value="<?php echo $merk;?>" class="form-control required" placeholder="Nama Produk"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Stok :</label>
                <div class="col-sm-4">
                    <select name="stok" class="form-control">
                        <?php
                        for ($i = 1; $i <= 100; $i++) {
                            if($stok == $i){
                                echo "<option selected='true' value='$i'>$i Items</option>";
                            }  else {
                                echo "<option value='$i'>$i Items</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga pokok Rp. :</label>
                <div class="col-sm-4">
                    <input type="text" name="harga_pokok" value="<?php echo $hargaPokok;?>" class="form-control required" placeholder="Harga Pokok Rp."/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga jual Rp. :</label>
                <div class="col-sm-4">
                    <input type="text" name="harga_jual" value="<?php echo $hargaJual;?>" class="form-control required" placeholder="Harga Jual Rp."/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Spesifikasi :</label>
                <div class="col-sm-4">
                    <textarea name="spesifikasi" cols="30" rows="10" class="form-control required"><?php echo $spek;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Gambar produk :</label>
                <div class="col-sm-4">
                    <input type="file" name="gambar_produk" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Gambar Sebelumnya :</label>
                <div class="col-sm-4">
                    <img src="../../<?php echo $lokasiGambar;?>" width="100" class="img-rounded"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Berat Kg. :</label>
                <div class="col-sm-4">
                    <input type="text" name="berat_barang" class="form-control required" value="<?php echo $beratBarang?>" placeholder="Berat Barang Kg."/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary"/>
                </div>
            </div>
        </form>
    </div>
</div>
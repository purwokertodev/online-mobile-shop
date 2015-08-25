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
        Data Produk Bumiayu Cell
    </div>
    <div>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td colspan="7"><a href="index.php?admin=daftar_pabrikan" class="btn btn-warning">Data Pabrikan</a></td>
            </tr>
            <tr>
                <td colspan="7"><a href="index.php?admin=tambah_produk" class="btn btn-primary">Tambah Produk</a><a href="cetak_pdf_barang_go.php" class="btn btn-primary" target="blank">Cetak Laporan</a></td>
            </tr>
            <tr>
                <td colspan="7">
                    <form action="index.php?admin=cari_produk_by_nama" method="post" class="form-inline" id="form-cari">
                        <div class="form-group">
                            <label class="sr-only" for="nama_produk">Masukan nama produk :</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="required form-control" placeholder="Nama produk"/>
                        </div>
                        <button type="submit" name="cari" class="btn btn-primary">Cari</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>Kode Produk</th>
                <th>Pabrikan/Vendor</th>
                <th>Merk</th>
                <th>Stok</th>
                <th>Harga Pokok</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
            <?php
            include_once '../model/produk_model.php';

            $pdao = new ProdukDaoImpl();
            $pdaof = new ProdukDaoImpl();
            $jml = $pdao->jumlahProduk();
            $page = filter_input(INPUT_GET, 'page');
            $batch = 5;
            $pages = ceil($jml / $batch);
            if (!$page)
                $page = 1;
            $start = ($page - 1) * $batch;
            $data = $pdaof->findAllLimit($start, $batch);
            for ($i = 0; $i < count($data); $i++) {
                $p = $data[$i];
                $kodeProduk = $p->getKodeProduk();
                $merk = $p->getNamaProduk();
                $namaPabrikan = $p->getNamaPabrikan();
                $stok = $p->getStok();
                $hargaPokok = $p->getHargaPokok();
                $hargaJual = $p->getHargaJual();
                $namaGambar = $p->getNamaGambar();
                $lokasiGambar = $p->getLokasiGambar();

                $token = md5(md5($kodeProduk) . md5('kata diacak'));
                ?>
                <tr>
                    <td><?php echo $kodeProduk; ?></td>
                    <td><?php echo $namaPabrikan; ?></td>
                    <td><?php echo $merk; ?></td>
                    <td><?php echo $stok; ?></td>
                    <td><?php echo number_format($hargaPokok, 2, ',', '.'); ?></td>
                    <td><?php echo number_format($hargaJual, 2, ',', '.'); ?></td>
                    <td><a href="index.php?admin=ubah_produk&kode_produk=<?php echo $kodeProduk; ?>&token=<?php echo $token; ?>" class="btn btn-primary">Ubah</a>|
                        <a href="index.php?admin=hapus_produk&kode_produk=<?php echo $kodeProduk; ?>&token=<?php echo $token; ?>" class="btn btn-danger" onclick="return confirm('Peringatan !!\n nAnda yakin ?');">Hapus</a>
                    </td>
                </tr>
                <?php
            }
            if ($pages > 1) {
                echo "<tr>";
                echo "<td colspan='7'>Halaman : ";
                for ($i = 1; $i <= $pages; $i++) {
                    if ($i != ceil($start / $batch)) {
                        echo "<a href='index.php?admin=produk&page=$i' class='btn btn-success'>$i</a> ";
                    } else {
                        echo " <a href='index.php?admin=produk&page=$i' class='btn btn-success'>$i</a> ";
                    }
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <script type="text/javascript">
        $('#form-cari').validate({
            messages: {
                nama_produk: {
                    required: "Masukan nama produk !!"
                }
            }
        });
    </script>
</div>

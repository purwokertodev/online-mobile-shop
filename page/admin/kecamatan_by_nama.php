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
            <li><a href="index.php?admin=produk"><span>Produk</span></a></li>
            <li><a href="index.php?admin=data_transaksi"><span>Data Transaksi</span></a></li>
            <li><a href="index.php?admin=data_konfirmasi">Data Konfirmasi</a></li>
            <li><a href="index.php?admin=data_member"><span>Data Pembeli</span></a></li>
            <li class="active"><a href="index.php?admin=data_daerah">Data Daerah</a></li>
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
        Data Kecamatan (Daerah Pengiriman)
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td colspan="5"><a href="index.php?admin=data_propinsi" class="btn btn-primary">Data Propinsi</a> | <a href="index.php?admin=data_kabupaten" class="btn btn-primary">Data Kabupaten</a></td>
            </tr>
            <tr>
                <td colspan="5"><a href="index.php?admin=tambah_kecamatan" class="btn btn-primary">Tambah Data Kecamatan</a></td>
            </tr>
            <tr>
                <td>
                    <form action="" method="post" class="form-inline" id="form-cari">
                        <div class="form-group">
                            <label class="sr-only" for="nama_kecamatan">Masukan nama Kecamatan :</label>
                            <input type="text" name="nama_kecamatan" id="nama_kecamatan" class="required form-control" placeholder="Nama Kecamatan" required="true"/>
                        </div>
                        <button type="submit" name="cari" class="btn btn-primary">Cari</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>NAMA KECAMATAN</th>
                <th>KABUPATEN</th>
                <th>PROPINSI</th>
                <th>BIAYA PENGIRIMAN Rp.</th>
                <th>OPERASI</th>
            </tr>
            <?php
            include_once '../model/kecamatan_model.php';
            if (isset($_POST['cari'])) {
                $nama = filter_input(INPUT_POST, 'nama_kecamatan');
                $kecDao = new KecamatanDaoImpl();
                $listKec = $kecDao->findByName($nama . "%");
                for ($i = 0; $i < count($listKec); $i++) {
                    $k = $listKec[$i];
                    $kodeKecamatan = $k->getKodeKecamatan();
                    $namaKecamatan = $k->getNamaKecamatan();
                    $namaPropinsi = $k->getNamaProvinsi();
                    $namaKabupaten = $k->getNamaKabupaten();
                    $biayaPengiriman = $k->getBiayaPengiriman();

                    $token = md5(md5($kodeKecamatan) . md5("kata diacak"));
                    ?>
                    <tr>
                        <td><?php echo $namaKecamatan; ?></td>
                        <td><?php echo $namaKabupaten; ?></td>
                        <td><?php echo $namaPropinsi; ?></td>
                        <td><?php echo number_format($biayaPengiriman, 2, ',', '.'); ?></td>
                        <td><a href="index.php?admin=ubah_kecamatan&kode_kecamatan=<?php echo $kodeKecamatan; ?>&token=<?php echo $token; ?>" class="btn btn-primary">Ubah</a> | 
                            <a href="index.php?admin=hapus_kecamatan&kode_kecamatan=<?php echo $kodeKecamatan; ?>&token=<?php echo $token; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ?');">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
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
        Data Propinsi
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td colspan="3"><a href="index.php?admin=data_kabupaten" class="btn btn-primary">Data Kabupaten</a> | <a href="index.php?admin=data_daerah" class="btn btn-primary">Data Kecamatan</a></td>
            </tr>
            <tr>
                <td colspan="3"><a href="index.php?admin=tambah_propinsi" class="btn btn-primary">Tambah Data Propinsi</a></td>
            </tr>
            <tr>
                <td colspan="3">
                    <form action="" method="post" class="form-inline" id="form-cari">
                        <div class="form-group">
                            <label class="sr-only" for="nama_propinsi">Masukan nama Propinsi :</label>
                            <input type="text" name="nama_propinsi" id="nama_propinsi" class="required form-control" placeholder="Nama Propinsi" required="true"/>
                        </div>
                        <button type="submit" name="cari" class="btn btn-primary">Cari</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>Kode Propinsi</th>
                <th>Nama Propinsi</th>
                <th>Operasi</th>
            </tr>
            <?php
            include_once '../model/propinsi_model.php';

            if (isset($_POST['cari'])) {
                $namaPropinsi = filter_input(INPUT_POST, 'nama_propinsi');
                $pdao = new PropinsiDaoImpl();
                $data = $pdao->findByName($namaPropinsi . "%");

                for ($i = 0; $i < count($data); $i++) {
                    $p = $data[$i];
                    $kode = $p->getKodePropinsi();
                    $nama = $p->getNamaPropinsi();

                    $token = md5(md5($kode) . md5('kata diacak'));
                    ?>
                    <tr>
                        <td><?php echo $kode; ?></td>
                        <td><?php echo $nama; ?></td>
                        <td>
                            <a href="index.php?admin=ubah_propinsi&kode_propinsi=<?php echo $kode; ?>&token=<?php echo $token; ?>" class="btn btn-primary">Ubah</a> |
                            <a href="index.php?admin=hapus_propinsi&kode_propinsi=<?php echo $kode; ?>&token=<?php echo $token; ?>" class="btn btn-danger" onclick="return confirm('Peringatan !!\nAnda yakin ?');">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
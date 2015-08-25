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
        Data Pabrikan Ponsel Bumiayu Cell
    </div>
    <div>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td colspan="7"><a href="index.php?admin=tambah_pabrikan" class="btn btn-primary">Tambah Data Pabrikan</a></td>
            </tr>
            <tr>
                <th>Kode Pabrikan</th>
                <th>Nama Pabrikan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            <?php
            include_once '../model/pabrikan_model.php';

            $pdao = new PabrikanDaoImpl();
            $data = $pdao->findAll();
            for ($i = 0; $i < count($data); $i++) {
                $p = $data[$i];
                $kode = $p->getKodePabrikan();
                $nama = $p->getNamaPabrikan();
                $keterangan = $p->getKeterangan();

                $token = md5(md5($kode) . md5("kata diacak"));
                ?>
                <tr>
                    <td><?php echo $kode; ?></td>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $keterangan; ?></td>
                    <td>
                        <a href="index.php?admin=ubah_pabrikan&kode_pabrikan=<?php echo $kode; ?>&token=<?php echo $token; ?>" class="btn btn-primary">Ubah</a> | 
                        <a href="index.php?admin=hapus_pabrikan&kode_pabrikan=<?php echo $kode; ?>&token=<?php echo $token; ?>" class="btn btn-danger" onclick="return confirm('Peringatan !!\n Anda yakin ?');">Hapus</a>
                    </td>
                </tr>
                <?php
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

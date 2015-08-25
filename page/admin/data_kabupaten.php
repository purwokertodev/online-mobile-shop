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
        Data Kabupaten
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td colspan="4"><a href="index.php?admin=data_propinsi" class="btn btn-primary">Data Propinsi</a> | <a href="index.php?admin=data_daerah" class="btn btn-primary">Data Kecamatan</a></td>
            </tr>
            <tr>
                <td colspan="4"><a href="index.php?admin=tambah_kabupaten" class="btn btn-primary">Tambah Data Kabupaten</a></td>
            </tr>
            <tr>
                <td colspan="4">
                    <form action="index.php?admin=cari_kabupaten_by_nama" method="post" class="form-inline" id="form-cari">
                        <div class="form-group">
                            <label class="sr-only" for="nama_kabupaten">Masukan nama Kabupaten :</label>
                            <input type="text" name="nama_kabupaten" id="nama_kabupaten" class="required form-control" placeholder="Nama Kabupaten" required="true"/>
                        </div>
                        <button type="submit" name="cari" class="btn btn-primary">Cari</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>Kode Kabupaten</th>
                <td>Nama Kabupaten</td>
                <th>Nama Propinsi</th>
                <th>Operasi</th>
            </tr>
            <?php
            include_once '../model/kabupaten_model.php';

            $kdao = new KabupatenDaoImpl();
            $kdaoF = new KabupatenDaoImpl();
            $jumlah = $kdaoF->jumlah();
            $page = filter_input(INPUT_GET, 'page');
            $batch = 5;
            $pages = ceil($jumlah / $batch);
            if (!$page)
                $page = 1;
            $start = ($page - 1) * $batch;
            $data = $kdao->findAllLimit($start, $batch);
            for ($i = 0; $i < count($data); $i++) {
                $p = $data[$i];
                $kode = $p->getKodeKabupaten();
                $nama = $p->getNamaKabupaten();
                $namaPropinsi = $p->getNamaPropinsi();

                $token = md5(md5($kode) . md5('kata diacak'));
                ?>
                <tr>
                    <td><?php echo $kode; ?></td>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $namaPropinsi; ?></td>
                    <td>
                        <a href="index.php?admin=ubah_kabupaten&kode_kabupaten=<?php echo $kode; ?>&token=<?php echo $token; ?>" class="btn btn-primary">Ubah</a> |
                        <a href="index.php?admin=hapus_kabupaten&kode_kabupaten=<?php echo $kode; ?>&token=<?php echo $token; ?>" class="btn btn-primary" onclick="return confirm('Peringatan !!\nAnda yakin ?');">Hapus</a>
                    </td>
                </tr>
                <?php
            }
            if ($pages > 1) {
                echo "<tr>";
                echo "<td colspan='7'>Halaman : ";
                for ($i = 1; $i <= $pages; $i++) {
                    if ($i != ceil($start / $batch)) {
                        echo "<a href='index.php?admin=data_kabupaten&page=$i' class='btn btn-success'>$i</a> ";
                    } else {
                        echo " <a href='index.php?admin=data_kabupaten&page=$i' class='btn btn-success'>$i</a> ";
                    }
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
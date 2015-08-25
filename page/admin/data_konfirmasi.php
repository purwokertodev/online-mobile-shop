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
            <li class="active"><a href="index.php?admin=data_konfirmasi">Data Konfirmasi</a></li>
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
        Data Transaksi yang sudah dikonfirmasi
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>KODE KONFIRMASI</th>
                <th>KODE TRANSAKSI</th>
                <th>NAMA MEMBER</th>
                <th>WAKTU KONFIRMASI</th>
                <th>OPERASI</th>
            </tr>
            <?php
            include_once '../model/konfirmasi_model.php';
            include_once '../model/transaksi_model.php';

            $kdao = new KonfirmasiDaoImpl();
            $kdaof = new KonfirmasiDaoImpl();
            $jml = $kdao->jumlah();
            $page = filter_input(INPUT_GET, 'page');
            $batch = 5;
            $pages = ceil($jml / $batch);
            if (!$page)
                $page = 1;
            $start = ($page - 1) * $batch;
            $data = $kdaof->findAllLimit($start, $batch);
            for ($i = 0; $i < count($data); $i++) {
                $k = $data[$i];
                $kodeKonfirmasi = $k->getKodeKonfirmasi();
                $kodeTransaksi = $k->getKodeTransaksi();
                $waktu = $k->getTanggalKonfirmasi();

                $tdao = new TransaksiDaoImpl();
                $trans = $tdao->findOne($kodeTransaksi);
                $namaMember = $trans->getNamaPembeli();
                ?>
                <tr>
                    <td><?php echo $kodeKonfirmasi; ?></td>
                    <td><?php echo $kodeTransaksi; ?></td>
                    <td><?php echo $namaMember; ?></td>
                    <td><?php echo $waktu; ?></td>
                    <td><a href="index.php?admin=lihat_bukti_konfirmasi&kode_transaksi=<?php echo $kodeTransaksi; ?>" class="btn btn-info" target="blank">Lihat Bukti</a>
                        <a href="cetak_bukti_transaksi.php?kode_transaksi=<?php echo $kodeTransaksi; ?>" class="btn btn-success" target="blank">Cetak</a>
                    </td>
                </tr>
                <?php
            }
            if ($pages > 1) {
                echo "<tr>";
                echo "<td colspan='4'>Halaman : ";
                for ($i = 1; $i <= $pages; $i++) {
                    if ($i != ceil($start / $batch)) {
                        echo "<a href='index.php?admin=data_konfirmasi&page=$i' class='btn btn-success'>$i</a> ";
                    } else {
                        echo " <a href='index.php?admin=data_konfirmasi&page=$i' class='btn btn-success'>$i</a> ";
                    }
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>


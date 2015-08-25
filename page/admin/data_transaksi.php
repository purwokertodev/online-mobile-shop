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
            <li class="active"><a href="index.php?admin=data_transaksi"><span>Data Transaksi</span></a></li>
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
        Data Transaksi Bumiayu Cell
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td colspan="7"><a href="cetak_pdf_transaksi_per_hari.php" class="btn btn-info" target="blank">Cetak laporan transaksi hari ini</a></td>
            </tr>
            <tr>
                <td colspan="7">
                    <form action="cetak_pdf_transaksi_per_periode.php" method="post" class="form-inline">
                        <div class="form-group">
                            <label class="sr-only" for="tanggal_awal">Tanggal awal:</label>
                            <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control" placeholder="tanggal awal" required/>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="tanggal_akhir">Tanggal akhir:</label>
                            <input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control" placeholder="tanggal akhir" required/>
                        </div>
                        <button type="submit" name="cetak" class="btn btn-primary">Cetak Laporan per Periode</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>KODE TRANSAKSI</th>
                <th>KODE MEMBER</th>
                <th>NAMA MEMBER</th>
                <th>WAKTU</th>
                <th>DISKON Rp.</th>
                <th>TOTAL Rp.</th>
                <th>OPERASI</th>
            </tr>
            <?php
            include_once '../model/transaksi_model.php';

            $tdao = new TransaksiDaoImpl();
            $tdaof = new TransaksiDaoImpl();
            $jml = $tdao->jumlahTransaksi();
            $page = filter_input(INPUT_GET, 'page');
            $batch = 5;
            $pages = ceil($jml / $batch);
            if (!$page)
                $page = 1;
            $start = ($page - 1) * $batch;
            $data = $tdaof->findByLimit($start, $batch);
            for ($i = 0; $i < count($data); $i++) {
                $t = $data[$i];
                $kodeTransaksi = $t->getKodeTransaksi();
                $kodeMember = $t->getKodePembeli();
                $namaMember = $t->getNamaPembeli();
                $waktu = $t->getWaktuTransaksi();
                $diskon = $t->getDiskon();
                $total = $t->getTotalAkhir();
                ?>
                <tr>
                    <td><?php echo $kodeTransaksi; ?></td>
                    <td><a href="index.php?admin=member_detail&kode_member=<?php echo $kodeMember; ?>" class="btn btn-info" target="blank"><?php echo $kodeMember; ?></a></td>
                    <td><?php echo $namaMember; ?></td>
                    <td><?php echo $waktu; ?></td>
                    <td><?php echo number_format($diskon, 2, ',', '.'); ?></td>
                    <td><?php echo number_format($total, 2, ',', '.') ?></td>
                    <td><a href="index.php?admin=data_transaksi_detail&kode_transaksi=<?php echo $kodeTransaksi; ?>" class="btn btn-primary" target="blank">Detail</a></td>
                </tr>
                <?php
            }
            if ($pages > 1) {
                echo "<tr>";
                echo "<td colspan='7'>Halaman : ";
                for ($i = 1; $i <= $pages; $i++) {
                    if ($i != ceil($start / $batch)) {
                        echo "<a href='index.php?admin=data_transaksi&page=$i' class='btn btn-success'>$i</a> ";
                    } else {
                        echo " <a href='index.php?admin=data_transaksi&page=$i' class='btn btn-success'>$i</a> ";
                    }
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>

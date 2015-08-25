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
        Detail Transaksi
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>NO</th>
                <th>NAMA PRODUK</th>
                <th>JUMLAH BELI</th>
                <th>SUB TOTAL Rp.</th>
            </tr>
            <?php
            include_once '../model/transaksi_model.php';
            $kodeTransaksi = filter_input(INPUT_GET, 'kode_transaksi');
            $tdao = new TransaksiDetailDaoImpl();
            $data = $tdao->findByTransaksi($kodeTransaksi);
            $no = 1;
            for ($i = 0; $i < count($data); $i++) {
                $t = $data[$i];
                $namaProduk = $t->getNamaProduk();
                $jumlahBeli = $t->getJumlahBeli();
                $subTotal = $t->getSubTotal();
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $namaProduk; ?></td>
                    <td><?php echo $jumlahBeli; ?></td>
                    <td><?php echo number_format($subTotal, 2, ',', '.'); ?></td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </table>
    </div>
</div>
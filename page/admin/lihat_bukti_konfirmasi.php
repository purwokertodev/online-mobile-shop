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
        Bukti Transaksi Telah DiKonfirmasi
    </div>
    <div class="panel-body">
        <?php
        include_once '../model/konfirmasi_model.php';
        include_once '../model/member_model.php';
        include_once '../model/transaksi_model.php';

        $kodeTransaksi = filter_input(INPUT_GET, 'kode_transaksi');
        $kdao = new KonfirmasiDaoImpl();
        $mdao = new MemberDaoImpl();
        $tdao = new TransaksiDaoImpl();
        $tdetailDao = new TransaksiDetailDaoImpl();

        $k = $kdao->findOne($kodeTransaksi);
        $lokasiGambar = $k->getLokasiGambar();

        $transaksi = $tdao->findOne($kodeTransaksi);
        $kodeMember = $transaksi->getKodePembeli();
        $waktu = $transaksi->getWaktuTransaksi();
        $diskon = $transaksi->getDiskon();
        $total = $transaksi->getTotalAkhir();

        $m = $mdao->findOne($kodeMember);
        $namaMember = $m->getNamaMember();
        $jenisKelamin = $m->getJenisKelamin();
        $noTelpon = $m->getNoTelpon();
        $alamat = $m->getAlamat();
        $alamatPengiriman = $m->getAlamatPengiriman();
        ?>
        <h3>Kode Transaksi :<?php echo $kodeTransaksi ?></h3>
        <div class="form-group">
            <label class="col-sm-2 control-label">Waktu Transaksi:</label>
            <div class="col-sm-4">
                <label class="control-label"><?php echo $waktu; ?></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Total Rp. :</label>
            <div class="col-sm-4">
                <label class="control-label"><?php echo number_format($total, 2, ',', '.'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Foto Bukti :</label>
            <div class="col-sm-12">
                <img src="<?php echo $lokasiGambar; ?>" width="400" class="img-rounded"/>
            </div>
        </div>
        <h3>Pembeli :</h3>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nama Pembeli :</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" value="<?php echo $namaMember; ?>" readonly="true"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Jenis Kelamin :</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" value="<?php echo $jenisKelamin; ?>" readonly="true"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">No Telpon :</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" value="<?php echo $noTelpon; ?>" readonly="true"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Alamat :</label>
            <div class="col-sm-12">
                <textarea cols="10" rows="5" class="form-control" readonly="true"><?php echo $alamat; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tujuan Pengiriman :</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" value="<?php echo $alamatPengiriman; ?>" readonly="true"/>
            </div>
        </div>
        <h3>Item Yang DiBeli</h3>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Jumlah Beli</th>
                <th>Sub Total Rp.</th>
            </tr>
            <?php
            $tdetail = $tdetailDao->findByTransaksi($kodeTransaksi);
            $no = 1;
            for ($i = 0; $i < count($tdetail); $i++) {
                $td = $tdetail[$i];
                $namaProduk = $td->getNamaProduk();
                $jumlahBeli = $td->getJumlahBeli();
                $subTotal = $td->getSubTotal();
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
        <?php
        ?>
    </div>
</div>
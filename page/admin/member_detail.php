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
            <li class="active"><a href="index.php?admin=data_member"><span>Data Pembeli</span></a></li>
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
        Member Detail
    </div>
    <div class="panel-body">
        <?php
        include_once '../model/member_model.php';
        include_once '../model/kecamatan_model.php';

        $kodeMember = filter_input(INPUT_GET, 'kode_member');
        $mdao = new MemberDaoImpl();
        $m = $mdao->findOne($kodeMember);
        $namaMember = $m->getNamaMember();
        $jenisKelamin = $m->getJenisKelamin();
        $noTelpon = $m->getNoTelpon();
        $alamat = $m->getAlamat();
        $kecamatan = $m->getKecamatan();
        $tanggalBergabung = $m->getTanggalBergabung();

        $kecDao = new KecamatanDaoImpl();
        $kec = $kecDao->findOne($kecamatan);
        $namaPropinsi = $kec->getNamaProvinsi();
        $namaKabupaten = $kec->getNamaKabupaten();
        $namaKecamatan = $kec->getNamaKecamatan();
        ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Kode Member :</label>
            <div class="col-sm-4">
                <label class="control-label"><?php echo $kodeMember; ?></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nama Member :</label>
            <div class="col-sm-4">
                <label class="control-label"><?php echo $namaMember; ?></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Jenis Kelamin :</label>
            <div class="col-sm-4">
                <label class="control-label"><?php echo $jenisKelamin; ?></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">No Telpon/Hp :</label>
            <div class="col-sm-4">
                <label class="control-label"><?php echo $noTelpon; ?></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Alamat :</label>
            <div class="col-sm-4">
                <label class="control-label"><?php echo $alamat; ?></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Kecamatan :</label>
            <div class="col-sm-4">
                <label class="control-label"><?php echo $namaKecamatan . ', ' . $namaKabupaten . ', ' . $namaPropinsi; ?></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tanggal Bergabung :</label>
            <div class="col-sm-4">
                <label class="control-label"><?php echo $tanggalBergabung; ?></label>
            </div>
        </div>
        <?php
        ?>
    </div>
</div>
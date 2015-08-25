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
        Tambah Data Propinsi
    </div>
    <div class="panel-body">
        <form action="index.php?admin=tambah_kecamatan_finish" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Kecamatan :</label>
                <div class="col-sm-4">
                    <input type="text" name="nama_kecamatan" class="form-control" required="true" placeholder="Nama Propinsi"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kabupaten :</label>
                <div class="col-sm-4">
                    <select name="kode_kabupaten" class="form-control">
                        <?php
                        include_once '../model/kabupaten_model.php';

                        $kdao = new KabupatenDaoImpl();
                        $data = $kdao->findAll();
                        for ($i = 0; $i < count($data); $i++) {
                            $k = $data[$i];
                            $kodeKabupaten = $k->getKodeKabupaten();
                            $namaKabupaten = $k->getNamaKabupaten();
                            $namaPropinsi = $k->getNamaPropinsi();
                            ?>
                        <option value="<?php echo $kodeKabupaten;?>"><?php echo $namaKabupaten.', '.$namaPropinsi;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Biaya Pengiriman Rp.:</label>
                <div class="col-sm-4">
                    <input type="text" name="biaya_pengiriman" class="form-control" required="true" placeholder="Biaya Pengiriman Rp."/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary"/>
                </div>
            </div>
        </form>
    </div>
</div>

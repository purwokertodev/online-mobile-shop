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
        Tambah Data Kabupaten
    </div>
    <div class="panel-body">
        <form action="index.php?admin=tambah_kabupaten_finish" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Kabupaten :</label>
                <div class="col-sm-4">
                    <input type="text" name="nama_kabupaten" class="form-control" required="true"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Propinsi :</label>
                <div class="col-sm-4">
                    <select name="kode_propinsi" class="form-control">
                        <?php
                        include_once '../model/propinsi_model.php';

                        $pdao = new PropinsiDaoImpl();
                        $listProp = $pdao->findAll();
                        for ($i = 0; $i < count($listProp); $i++) {
                            $p = $listProp[$i];
                            $kodeProp = $p->getKodePropinsi();
                            $namaProp = $p->getNamaPropinsi();
                            ?>
                            <option value="<?php echo $kodeProp; ?>"><?php echo $namaProp; ?></option>
                            <?php
                        }
                        ?>
                    </select>
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

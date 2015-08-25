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
            <li><a href="index.php?admin=data_daerah">Data Daerah</a></li>
            <li class="active"><a href="index.php?admin=panduan_belanja"><span>Panduan</span></a></li>
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
        Panduan Belanja
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td colspan="3"><a href="index.php?admin=tambah_panduan" class="btn btn-primary">Tambah Panduan</a></td>
            </tr>
            <tr>
                <th>NO</th>
                <th>PANDUAN</th>
                <th>OPERASI</th>
            </tr>
            <?php
            include_once '../model/panduan_belanja_model.php';

            $no = 1;
            $pdao = new PanduanBelanjaDaoImpl();
            $listPanduan = $pdao->findAll();
            for ($i = 0; $i < count($listPanduan); $i++) {
                $p = $listPanduan[$i];
                $kodePanduan = $p->getId();
                $isiPanduan = $p->getPanduan();

                $token = md5(md5($kodePanduan) . md5("kata diacak"));
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $isiPanduan; ?></td>
                    <td><a href="index.php?admin=ubah_panduan&kode_panduan=<?php echo $kodePanduan; ?>&token=<?php echo $token; ?>" class="btn btn-success">Ubah</a> | 
                        <a href="index.php?admin=hapus_panduan&kode_panduan=<?php echo $kodePanduan; ?>&token=<?php echo $token; ?>" onclick="return confirm('Anda yakin ?');" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </table>
    </div>
</div>
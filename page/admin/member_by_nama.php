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
        Data Member
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td colspan="5">
                    <form action="" method="post" class="form-inline">
                        <div class="form-group">
                            <label class="sr-only" for="nama_member">Masukan nama member :</label>
                            <input type="text" name="nama_member" id="nama_member" class="form-control" placeholder="nama, alamat, gender, dll" required/>
                        </div>
                        <button type="submit" name="cari" class="btn btn-primary">Cari</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>KODE MEMBER</th>
                <th>NAMA MEMBER</th>
                <th>JENIS KELAMIN</th>
                <th>ALAMAT</th>
                <th>OPERASI</th>
            </tr>
            <?php
            include_once '../model/member_model.php';

            $nama = filter_input(INPUT_POST, 'nama_member');
            $mdao = new MemberDaoImpl();
            $data = $mdao->findByName($nama . "%");
            if (count($data) > 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $m = $data[$i];
                    $kodeMember = $m->getKodeMember();
                    $namaMember = $m->getNamaMember();
                    $jenisKelamin = $m->getJenisKelamin();
                    $alamat = $m->getAlamat();
                    ?>
                    <tr>
                        <td><?php echo $kodeMember; ?></td>
                        <td><?php echo $namaMember; ?></td>
                        <td><?php echo $jenisKelamin; ?></td>
                        <td><?php echo $alamat ?></td>
                        <td><a href="index.php?admin=member_detail&kode_member=<?php echo $kodeMember; ?>" class="btn btn-success" target="blank">Detail</a></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr><td colspan="5"><h3>Data tidak ditemukan..</h3></td></tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

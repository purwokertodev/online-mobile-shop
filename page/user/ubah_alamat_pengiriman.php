<div class="ui-content" data-role="main">


    <?php
    session_start();
    include_once '../model/member_model.php';
    include_once '../model/kecamatan_model.php';

    if (isset($_SESSION['pembeli_login'])) {
        $kodePembeli = $_SESSION['pembeli_login']['kode_pembeli'];
        $pdao = new MemberDaoImpl();
        $p = $pdao->findOne($kodePembeli);
        $namaPembeli = $p->getNamaMember();
        $namaTujuanPengiriman = $p->getNamaTujuanPengiriman();
        $alamatPengiriman = $p->getAlamatPengiriman();
        $kodeKecamatanPengiriman = $p->getKecamatanPengiriman();
        $alamat = $p->getAlamat();
        $kodeKecamatan = $p->getKecamatan();

        $kecDaoA = new KecamatanDaoImpl();
        $kec = $kecDaoA->findOne($kodeKecamatan);
        $namaPropinsiA = $kec->getNamaProvinsi();
        $namaKabupatenA = $kec->getNamaKabupaten();
        $namaKecamatanA = $kec->getNamaKecamatan();//1,
        ?>
        <div style="text-align: center">
            <h3>Apakah alamat kecamatan pengiriman anda <br> <?php echo $alamat; ?>, <br> <b><?php echo $namaKecamatanA . ', ' . $namaKabupatenA . ', ' . $namaPropinsiA; ?></b> ?
                <br> Dan atas nama <b><?php echo $namaPembeli;?> ?</b>
            </h3>
            
            <a href='index.php?user=belanja_finish' name='Simpan' class='ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline'>Iya</a>
            <div data-role="collapsible" data-theme="b" data-content-theme="b">
                <h4>Berbeda</h4>
                <form action="index.php?user=ubah_alamat_pengiriman_finish" method="post" id="form-ubah">
                    <input type="hidden" name="kode_member" value="<?php echo $kodePembeli; ?>"/>
                    <div class="ui-field-contain">
                        <label for="atas_nama">Nama Tujuan :</label>
                        <input type="text" id="atas_nama" name="atas_nama" class="required" value="<?php echo $namaTujuanPengiriman;?>"/>
                    </div>
                    <div class="ui-field-contain">
                        <label for="alamat_pengiriman">Alamat</label>
                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="required"><?php echo $alamatPengiriman; ?></textarea>
                    </div>
                    <div class="ui-field-contain">
                        <label for="kecamatan">Kecamatan :</label>
                        <select name="kecamatan">
                            <?php
                            include_once '../model/kecamatan_model.php';

                            $kecDao = new KecamatanDaoImpl();
                            $listKec = $kecDao->findAll();
                            for ($i = 0; $i < count($listKec); $i++) {
                                $k = $listKec[$i];
                                $kodeKecamatan = $k->getKodeKecamatan();
                                $namaPropinsi = $k->getNamaProvinsi();
                                $namaKabupaten = $k->getNamaKabupaten();
                                $namaKecamatan = $k->getNamaKecamatan();
                                ?>
                                <option value="<?php echo $kodeKecamatan; ?>"><?php echo $namaKecamatan . ', ' . $namaKabupaten . ', ' . $namaPropinsi; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="ui-shadow ui-btn-b ui-corner-all ui-icon-check ui-btn-icon-left" name="simpan">Ubah</button>
                </form>
            </div>
        </div>
    <script type="text/javascript">
        $('#form-ubah').validate({
            messages: {
                alamat_pengiriman: {
                    required: "Alamat harus diisi !!"
                },
                atas_nama:{
                    required: "Nama harus diisi !!"
                }
            }
        });

    </script>
        <?php
    } else {
        ?>
        <div style="text-align: center">
            <h4>Pembeli yang terhormat,</h4>
            <h4>Anda belum login atau registrasi, silahkan lakukan <strong><a href="index.php?user=login_member">Login</a></strong> atau <strong><a href="index.php?user=registrasi_member">Registrasi</a></strong></h4>
        </div>
        <?php
    }
    ?>
</div>

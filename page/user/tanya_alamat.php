<div class="ui-content" data-role="main">


    <?php
    session_start();
    include_once '../model/member_model.php';
    include_once '../model/kecamatan_model.php';

    if (isset($_SESSION['pembeli_login'])) {
        $kodePembeli = $_SESSION['pembeli_login']['kode_pembeli'];
        $pdao = new MemberDaoImpl();
        $p = $pdao->findOne($kodePembeli);
        $alamatPengiriman = $p->getAlamatPengiriman();
        $kodeKecamatanPengiriman = $p->getKecamatanPengiriman();

        $kecDao = new KecamatanDaoImpl();
        $k = $kecDao->findOne($kodeKecamatanPengiriman);

        $kodeKecamatan = $k->getKodeKecamatan();
        $namaPropinsi = $k->getNamaProvinsi();
        $namaKabupaten = $k->getNamaKabupaten();
        $namaKecamatan = $k->getNamaKecamatan();
        ?>
        <div style="text-align: center">
            <h3>Apakah alamat pengiriman anda, <br></h3>
            <a href='index.php?user=belanja_finish' name='Simpan' class='ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline'>Sama</a>
            <div data-role="collapsible" data-theme="b" data-content-theme="b">
                <h4>Berbeda</h4>
                <form action="index.php?user=ubah_alamat_pengiriman_finish" method="post" id="form-ubah">
                    <input type="hidden" name="kode_member" value="<?php echo $kodePembeli; ?>"/>
                    <div class="ui-field-contain">
                        <label for="alamat_pengiriman">Alamat</label>
                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" required="true"><?php echo $alamatPengiriman; ?></textarea>
                    </div>
                    <div class="ui-field-contain">
                        <label for="kecamatan">Kecamatan :</label>
                        <select name="kecamatan">

                        </select>
                    </div>
                    <button type="submit" class="ui-shadow ui-btn-b ui-corner-all ui-icon-check ui-btn-icon-left" name="simpan">Ubah</button>
                </form>
            </div>
        </div>
        <?php
    }
    ?>
</div>

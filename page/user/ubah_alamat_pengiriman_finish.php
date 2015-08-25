<?php
include_once '../model/member_model.php';
include_once '../model/kecamatan_model.php';

if (isset($_POST['simpan'])) {
    $kodeMember = filter_input(INPUT_POST, 'kode_member');
    $alamatPengiriman = filter_input(INPUT_POST, 'alamat_pengiriman');
    $kodeKecamatan = filter_input(INPUT_POST, 'kecamatan');
    $namaPembeli = filter_input(INPUT_POST, 'atas_nama');

    $mdao = new MemberDaoImpl();
    $mdao->ubahAlamatPengiriman($kodeMember, $kodeKecamatan, $alamatPengiriman, $namaPembeli);

    $kecDaoA = new KecamatanDaoImpl();
    $kec = $kecDaoA->findOne($kodeKecamatan);
    $namaPropinsiA = $kec->getNamaProvinsi();
    $namaKabupatenA = $kec->getNamaKabupaten();
    $namaKecamatanA = $kec->getNamaKecamatan();
    ?>
    <div class="ui-content">
        <div style="text-align: center">
            <h3>Barang akan kami kirim ke alamat: <br> <?php echo $alamatPengiriman; ?>, <br> <b><?php echo $namaKecamatanA . ', ' . $namaKabupatenA . ', ' . $namaPropinsiA; ?></b> ?</h3>
            <a href='index.php?user=belanja_finish' name='Simpan' class='ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline'>Lanjutkan</a>
        </div>
    </div>
    <?php
}


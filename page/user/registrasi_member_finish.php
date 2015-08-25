<?php

include_once '../model/member_model.php';

if (isset($_POST['reg'])) {
    $kodeMember = time();
    $namaMember = filter_input(INPUT_POST, 'nama');
    $jenisKelamin = filter_input(INPUT_POST, 'jenis_kelamin');
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $noTelpon = filter_input(INPUT_POST, 'no_telpon');
    $alamat = filter_input(INPUT_POST, 'alamat');
    $kecamatan = filter_input(INPUT_POST, 'kecamatan');
    $alamatPengiriman = "-";
    $kecamatanPengiriman = "-";
    $namaTujuanPengiriman = "-";
    
    $mdao = new MemberDaoImpl();
    $mdao->save($kodeMember, $namaMember, $namaTujuanPengiriman, $jenisKelamin, $username, $password, $noTelpon, $alamat, $alamatPengiriman, $kecamatan, $kecamatanPengiriman);
    ?>
    <script>document.location.href = 'index.php?user=login_member';</script>
    <?php

}

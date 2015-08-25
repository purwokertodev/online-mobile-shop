<?php
session_start();

include_once '../model/member_model.php';

if (isset($_POST['Login'])) {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $mdao = new MemberDaoImpl();
    $m = $mdao->login($username, $password);
    $kodePembeliLogin = $m->getKodeMember();
    $username_login = $m->getUsername();
    $password_login = $m->getPassword();
    if ($username == $username_login && $password == $password_login) {
        $pembeli_login = array("kode_pembeli" => $kodePembeliLogin, "username" => $username_login, "password" => $password_login);
        $_SESSION['pembeli_login'] = $pembeli_login;
        ?>
        <script>document.location.href = 'index.php?user=keranjang';</script>
        <?php
    } else {
        ?>
        <div style="text-align: center">
            <h4>Username dan Password tidak valid !!</h4>
            <h4><a href="index.php?user=login_member">Coba lagi</a></h4>
        </div>
        <?php
    }
}
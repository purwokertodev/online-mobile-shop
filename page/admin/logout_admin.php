<?php

session_start();
include_once '../model/petugas_model.php';
include_once '../validasi/kelas_validasi.php';

if (isset($_SESSION['username_login_admin']) && isset($_SESSION['password_login_admin'])) {
    $username = $_SESSION['username_login_admin'];
    $password = $_SESSION['password_login_admin'];
    $pdao = new PetugasDaoImpl();
    $p = $pdao->login($username, $password);
    
    $id = time();
    $kodePetugas = $p->getKodePetugas();
    $status = "LOGOUT";
    $lpdao = new LogPetugasDaoImpl();
    $lpdao->save($id, $kodePetugas, $status);
    
    unset($_SESSION['username_login_admin']);
    unset($_SESSION['password_login_admin']);
    header("location:login_admin.php");
} else {
    Validasi::harusLogin();
}
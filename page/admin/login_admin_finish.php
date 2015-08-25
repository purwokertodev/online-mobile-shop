<?php

session_start();
include_once '../model/petugas_model.php';
include_once '../validasi/kelas_validasi.php';


if(isset($_POST['Login'])){
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    
    
    $pdao = new PetugasDaoImpl();
    $lpdao = new LogPetugasDaoImpl();
    $p = $pdao->login($username, $password);
    if($p->getUsername()==$username && $p->getPassword()==$password){
        $id = time();
        $kodePetugas = $p->getKodePetugas();
        $status = "LOGIN";
        $lpdao->save($id, $kodePetugas, $status);
        
        $_SESSION['username_login_admin'] = $p->getUsername();
        $_SESSION['password_login_admin'] = $p->getPassword();
        header("location:index.php");
    }  else {
        Validasi::loginGagal();
    }
}

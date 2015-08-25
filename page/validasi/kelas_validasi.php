<?php

class Validasi {

    public static function harusLogin() {
        ?>
        <script language="javascript">alert('Anda harus login terlebih dahulu !!');</script>
        <script>document.location.href = './login_admin.php';</script>
        <?php

    }

    public static function loginGagal() {
        ?>
        <script language="javascript">alert('Username atau Password tidak valid !!');</script>
        <script>document.location.href = './login_admin.php';</script>
        <?php

    }
    
    public static function produkLimit(){
        ?>
        <script language="javascript">alert('Produk tidak cukup !!');</script>
        <script>document.location.href='';</script>
        <?php
    }

}

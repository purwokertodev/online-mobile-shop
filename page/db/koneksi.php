<?php

define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE_NAME", "toko_ponsel_wahyu");
define("PORT", "3306");

class Koneksi {

    public static function connect() {
        $con = new mysqli(HOST, USERNAME, PASSWORD, DATABASE_NAME, PORT);
        if ($con->connect_error) {
            echo "Koneksi database gagal";
        }
        return $con;
    }

}

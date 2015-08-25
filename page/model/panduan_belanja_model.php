<?php

include_once '../db/koneksi.php';

class PanduanBelanja {

    private $id;
    private $panduan;

    public function getId() {
        return $this->id;
    }

    public function getPanduan() {
        return $this->panduan;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPanduan($panduan) {
        $this->panduan = $panduan;
    }

}

interface PanduanBelanjaDao {

    public function save($panduan);

    public function update($id, $panduan);

    public function delete($id);

    public function findOne($id);

    public function findAll();
}

class PanduanBelanjaDaoImpl implements PanduanBelanjaDao {

    private $con;

    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function delete($id) {
        $query = "DELETE FROM panduan_belanja WHERE id = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("i", $id);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT id, panduan FROM panduan_belanja";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()) {
            $p = new PanduanBelanja();
            $p->setId($res[0]);
            $p->setPanduan($res[1]);
            $hasil[] = $p;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findOne($id) {
        $p = new PanduanBelanja();
        $query = "SELECT id, panduan FROM panduan_belanja WHERE id = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("i", $id);
        $prep->execute();
        $prep->bind_result($a, $b);
        if ($prep->fetch()) {
            $p->setId($a);
            $p->setPanduan($b);
        }
        $prep->close();
        $this->con->close();
        return $p;
    }

    public function save($panduan) {
        $query = "INSERT INTO panduan_belanja(panduan) VALUES (?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $panduan);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function update($id, $panduan) {
        $query = "UPDATE panduan_belanja SET panduan = ? WHERE id = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("si", $panduan, $id);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

}



<div class="ui-content" data-role="main">
    <h3>Registrasi Pembeli</h3>
    <form action="index.php?user=registrasi_member_finish" method="post" id="form-member" name="formMember" onsubmit="return(validNoHp());">
        <div class="ui-field-contain">
            <label for="nama">Nama :</label>
            <input type="text" name="nama" data-clear-btn="true" id="nama" placeholder="Nama anda" class="required"/>
        </div>
        <div class="ui-field-contain">
            <fieldset data-role="controlgroup" data-type="vertical">
                <legend>Jenis kelamin :</legend>
                <input type="radio" name="jenis_kelamin" value="PRIA"  checked="checked" id="pria"/>
                <label for="pria">Pria</label>
                <input type="radio" name="jenis_kelamin" value="WANITA" id="wanita"/>
                <label for="wanita">Wanita</label>
            </fieldset>
        </div>
        <div class="ui-field-contain">
            <label for="username">Username :</label>
            <input type="text" name="username" data-clear-btn="true" id="username" placeholder="Username" class="required"/>
        </div>
        <div class="ui-field-contain">
            <label for="password">Password :</label>
            <input type="text" name="password" data-clear-btn="true" id="password" placeholder="Password" class="required"/>
        </div>
        <div class="ui-field-contain">
            <label for="no_telpon">No Telpon/Hp :</label>
            <input type="tel" name="no_telpon" data-clear-btn="true" id="no_telpon" placeholder="No Telpon/Hp" class="required"/>
        </div>
        <div class="ui-field-contain">
            <label for="alamat">Alamat :</label>
            <textarea name="alamat" id="alamat" data-clear-btn="true" cols="10" rows="8" class="required"></textarea>
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
                    <option value="<?php echo $kodeKecamatan;?>"><?php echo $namaKecamatan.', '.$namaKabupaten.', '.$namaPropinsi;?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <button type="submit" class="ui-shadow ui-btn ui-corner-all ui-icon-check ui-btn-icon-left ui-btn-inline ui-mini" name="reg">Registrasi</button>
    </form>
    <script type="text/javascript">
        $('#form-member').validate({
            messages: {
                nama: {
                    required: "Nama harus diisi !!"
                },
                username: {
                    required: "Username harus diisi !!"
                },
                password: {
                    required: "Password harus diisi !!"
                },
                no_telpon: {
                    required: "No Telpon/Hp harus diisi !!"
                },
                alamat: {
                    required: "Alamat harus diisi !!"
                }
            }
        });

    </script>
    <script type="text/javascript" language="javascript">

        function validNoHp() {
            if (isNaN(formMember.no_telpon.value)) {
                formMember.no_telpon.value = "No Hp tidak valid !!";
                return false;
            } else {
                return true;
            }
        }
    </script>
</div>

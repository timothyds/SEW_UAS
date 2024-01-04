<?php
require_once("EduconceptClass.php");
$id = $_GET['idss'];
$nama = $_GET['nama'];
$waktu_muls=$_GET['waktu_mula'];
$waktu_sels=$_GET['waktu_selesai'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="daftarsesi.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <title>Edit Sesi</title>
</head>
<body>
    <div id='nav-samping-kiri'>
        <img src="img/Dolomites.jpg" alt="Foto Profil" id='FotoProfilNav'>
        <?php
        $akun = new akun();
        $res_akun = $akun->getProfil("%");
        while($row = $res_akun->fetch_assoc()){
            $user_db = $row['username'];
            echo "<div id='namaprofil'><p>$user_db</p></div>";
        }
        ?>
        <div class='btnnav'><p>Home</p></div>
        <div class='btnnav '><p>Tugas</p></div>
        <div class='btnnav'><p>Jadwal</p></div>
        <div class='btnnav click'><p>Daftar</p></div>
        <div class='btnnav'><p>Tambah</p></div>
    </div>
    <div id='header'>
        <div>
            <p id='home-admin'>Edit Sesi</p>
        </div>
    </div>
    <div id='container'>
        <div id='content-edit'>
            <table cellspacing=5 id='table-edit'>
                <tr>
                    <td><label class='lbl'>Waktu Mulai</label></td>
                    <td><label class='lbl'>Waktu Selesai</label></td>
                </tr>
                <tr>
                    <td><input type="time" class='input' value='<?php echo date("H:i:s", strtotime($waktu_muls)); ?>' id='txtmulai'></td>
                    <td><input type="time" class='input' value='<?php echo date("H:i:s", strtotime($waktu_sels)); ?>' id='txtselesai'></td>
                </tr>
                <tr>
                    <td><label class='lbl'>Nama sesi</label></td>
                </tr>
                <tr>
                    <td><input type="text" value='<?php echo $nama ;?>' class='input' placeholder='Masukan Nama Sesi' id='txtnama'></td>
                </tr>
                <tr>
                    <td><label class='lbl'>ID</label></td>
                </tr>
                <tr>
                <td><input type="text" value='<?php echo $id ;?>' class='input' placeholder='ID' id='txtid'></td>
                    <td>
                        <button id='btnSimpan'>Simpan</button>&nbsp
                        <button id='btnBatal'>Batal</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        $(".btnnav").click(function(){
            $(".btnnav").removeClass("click");
            $(this).addClass("click");
            var nama = $(this).find("p").text();
            var optElement = $(this).find(".opt");
            optElement.remove();
            if(nama == "Daftar" && optElement.length === 0){
                $(this).append("<span class='opt'><p>Daftar Siswa</p></span>");
                $(this).append("<span class='opt'><p>Daftar Tentor</p></span>");
                $(this).append("<span class='opt'><p>Daftar Mata Pelajaran</p></span>");
                $(this).append("<span class='opt'><p>Daftar Kelas</p></span>");
                $(this).append("<span class='opt'><p>Daftar Sesi</p></span>");
            }else{
                optElement.remove();
            }
            if(nama == "Jadwal" && optElement.length === 0){
                $(this).append("<span class='opt'><p>Jadwal Bimbel</p></span>");
                $(this).append("<span class='opt'><p>Jadwal Tentor</p></span>");
            }else{
                optElement.remove();
            }
            if(nama == "Tambah" && optElement.length === 0){
                $(this).append("<span class='opt'><p>Tambah Siswa</p></span>");
                $(this).append("<span class='opt'><p>Tambah Tentor</p></span>");
            }else{
                optElement.remove();
            }
            if(nama == "Tugas"){
                window.location.href = "tugas.php";
            }
            if(nama == "Home"){
                window.location.href = "home.php";
            }
            $(".opt").click(function(){
            window.location.href="jadwalbimbel.php";
            });
        });
        $("#btnSimpan").click(function(){
            var ids = $("#txtid").val();
            var namas = $("#txtnama").val();
            var wkt_muls = $("#txtmulai").val();
            var wkt_sls = $("#txtselesai").val();
            $.post("update-sesi-ajax.php", {id:ids,
            nama:namas, waktu_muls:wkt_muls, waktu_sels:wkt_sls}).done(function(data){
                if(data == "Update Gagal"){
                    alert(data);
                }else{
                    alert(data);
                    window.location.href="daftarsesi.php";
                }
            })
        });
        $("#btnBatal").click(function(){
            window.location.href="daftarsesi.php";
        });
    </script>
</body>
</html>
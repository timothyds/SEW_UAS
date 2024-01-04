<?php
require_once("EduconceptClass.php");
$id = $_GET['id'];
$nama = $_GET['nama'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="daftarkelas.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <title>Edit Kelas</title>
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
            <p id='home-admin'>Edit Mata Pelajaran</p>
        </div>
    </div>
    <div id='container'>
        <div id='content-edit'>
            <table cellspacing=5 id='table-edit'>
                <tr>
                    <td><label class='lbl'>Nama Mata Pelajaran</label></td>
                </tr>
                <tr>
                    <td><input type="text" value='<?php echo $nama ;?>' placeholder='Masukkan Mata Pelajaran' id='txtmatpel' class='input'></td>
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
            var id = $("#txtid").val();
            var nama = $("#txtmatpel").val();
            $.post("update-matapelajaran-ajax.php", {id:id,
            nama:nama, }).done(function(data){
                if(data == "Update Gagal"){
                    alert(data);
                }else{
                    alert(data);
                    window.location.href="daftarmatapelajaran.php";
                }
            })
        });
        $("#btnBatal").click(function(){
            window.location.href="daftarsesi.php";
        });
    </script>
</body>
</html>
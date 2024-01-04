<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="home.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <title>Home</title>
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
        <div class='btnnav click'><p>Home</p></div>
        <div class='btnnav'><p>Tugas</p></div>
        <div class='btnnav'><p>Jadwal</p></div>
        <div class='btnnav'><p>Daftar</p></div>
        <div class='btnnav'><p>Tambah</p></div>
    </div>
    <div id='header'>
        <div>
            <p id='home-admin'>EDUCONCEPT-ADMIN</p>
        </div>
    </div>
    
    <div id='container'>
        <div id='jadwal'>
            <!-- <p>Tidak ada jadwal</p> -->
            <?php
            
            $jadwal = new jadwal();
            $result = $jadwal->getJadwal("%");
            while($row=$result->fetch_assoc()){
                $hari = $row['hari'];
                $tanggal = $row['tanggal_waktu'];
                $waktu_mulai = $row['waktu_mula'];
                $waktu_selesai = $row['waktu_selesai'];
                $mata_pelajaran = $row['mata_pelajaran'];
                $kelas = $row['kelas'];
                echo "<p id='hari_tanggal'>$hari , $tanggal</p>";
                echo "<p id='sesi_jadwal'>$waktu_mulai - $waktu_selesai      $mata_pelajaran($kelas)</p>";
            }

            ?>
        </div>
    </div>
    <script type="text/javascript">
        $(".btnnav").click(function(){
            $(".btnnav").removeClass("click");
            $(this).addClass("click");
            var nama = $(this).find("p").text();
            var optElement = $(this).find(".opt");
            optElement.remove();
            if(nama == "Daftar" && optElement.length === 0){
                $(this).append("<span class='opt' value='dafsiswa'><p>Daftar Siswa</p></span>");
                $(this).append("<span class='opt' value='daftentor'><p>Daftar Tentor</p></span>");
                $(this).append("<span class='opt'><p>Daftar Mata Pelajaran</p></span>");
                $(this).append("<span class='opt'><p>Daftar Kelas</p></span>");
                $(this).append("<span class='opt'><p>Daftar Sesi</p></span>");
            }else{
                optElement.remove();
            }
            if(nama == "Jadwal" && optElement.length === 0){
                $(this).append("<span class='opt' value='jadwalbimbel'><p>Jadwal Bimbel</p></span>");
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
            $(".opt").click(function(){
                var vale = $(this).text();
                if(vale == "Daftar Siswa"){
                    window.location.href="daftarsiswa.php";
                }
                if(vale=="jadwalbimbel"){
                    window.location.href="jadwalbimbel.php";
                }
                if(vale == "Daftar Sesi"){
                    window.location.href="daftarsesi.php";
                }
                if(vale== "Daftar Kelas"){
                    window.location.href="daftarkelas.php";
                }
            });
        });
        
    </script>
</body>
</html>
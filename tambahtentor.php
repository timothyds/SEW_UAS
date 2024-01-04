<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="daftarsiswa.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <title>Tambah Tentor</title>
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
        <div class='btnnav'><p>Daftar</p></div>
        <div class='btnnav click'><p>Tambah</p></div>
    </div>
    <div id='header'>
        <div>
            <p id='home-admin'>Tambah Tentor</p>
        </div>
    </div>
    <div id='container'>
        <div id='content-edit'>
            <table cellspacing=5 id='table-edit'>
                <tr>
                    <td><label class='lbl'>Nama Tentor</label></td>
                    <td><label class='lbl'>Email</label></td>
                </tr>
                <tr>
                    <td><input type="text" value='<?php echo $nama ;?>' placeholder='Masukan Nama' name='txtNamaTentor' id='txtnama' class='input'></td>
                    <td><input type="text" value=<?php echo $email ;?> class='input' placeholder='Masukan Email' id='txtemail'></td>
                </tr>
                <tr>
                    <td><label class='lbl'>Asal Universitas</label></td>
                    <td><label class='lbl'>Username</label></td>
                </tr>
                <tr>
                    <td><input type="text" value='<?php echo $username ;?>' placeholder='Masukan Universitas' class='input' id='txtuniversitas'></td>
                    <td><input type="text" value='<?php echo $username ;?>' placeholder='Masukan Username' class='input' id='txtusername'></td>
                </tr>
                <tr>
                    <td>
                        <label class='lbl'>Tanggal Lahir</label>
                    </td>
                    <td><label class='lbl'>Password</label></td>
                </tr>
                <tr>
                    <td><input type="date" class='input' value='<?php echo date("Y-m-d", strtotime($tgl_lahir)); ?>' id='txttgl_lahir'></td>
                    <td><input type="text" value='<?php echo $password ;?>' placeholder='Masukan Password' class='input' id='txtpassword'></td>
                </tr>
                <tr>
                    <td><label class='lbl'>No Handphone</label></td>
                </tr>
                <tr>
                    <td><input type="text" value='<?php echo $nohp ;?>' class='input' placeholder='Masukan Nomor HP' id='txtnohp'></td>
                </tr>
                <tr><td><input type="text" value='<?php echo $sekolah ;?>' class='input' placeholder='Nama Sekolah' id='txtnamasekolah'></td>
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
            var username = $("#txtusername").val();
            var nama = $("#txtnama").val();
            var asaluniv = $("#txtuniversitas").val();
            var email = $("#txtemail").val();
            var nohp = $("#txtnohp").val();
            var password = $("#txtpassword").val();
            var tanggal_lahir = $("#txttgl_lahir").val();
            $.post("insert-tentor-ajax.php", {username: username,
            nama: nama, tanggal_lahir: tanggal_lahir, asaluniv: asaluniv, 
            email: email, nohp: nohp, password: password}).done(function(data){
                if(data == "Input Gagal"){
                    alert(data);
                }else{
                    alert(data);
                    window.location.href="home.php";//sementara
                }
            })
        });
    </script>
</body>
</html>
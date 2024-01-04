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
    </style>
    <title>Tugas</title>
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
            <p id='home-admin'>Daftar Siswa</p>
        </div>
    </div>
    <div id='container'>
        <div id='filter-siswa'>

            <table>
                <tr>
                    <td>
                    <label>Kelas : </label>
                    </td>
                    <td>
                        <select id='cbkelas'>
                        <option value="%">Semua Kelas</option>
                        <?php 
                            $siswa = new daftarsiswa();
                            $kelas = "%";
                            $matpel = "%";
                            $sesi = "%";
                            if(isset($_GET['kelas'])){
                                $kelas = $_GET['kelas'];
                                $matpel = $_GET['matpel'];
                                $sesi = $_GET['sesi'];
                            }
                            $res_kelas = $siswa->getKelas("%");
                            while($row=$res_kelas->fetch_assoc()){
                                echo "<option value='".$row['nama']."'>".$row['nama']."</option>";
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    <label>Mata Pelajaran : </label>
                    </td>
                    <td>
                        <select id='cbmatpel'>
                    <option value="%">Semua Mata Pelajaran</option>
                    <?php 
                        $res_matpel = $siswa->getMatpel("%");
                        while($row=$res_matpel->fetch_assoc()){
                            echo "<option value='".$row['nama']."'>".$row['nama']."</option>";
                        }
                    ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    <label>Sesi : </label>
                    </td>
                    <td>
                        <select id='cbsesi'>
                    <option value="%">Semua Sesi</option>
                    <?php 
                        $res_sesi = $siswa->getSesi("%");
                        while($row=$res_sesi->fetch_assoc()){
                            echo "<option value='".$row['nama']."'>".$row['nama']."</option>";
                        }
                    ?>
                    </select>
                    </td>
                </tr>
            </table>
            <button id='btnSortir'>Sortir</button>
        </div>
        <div id='jumlah-siswa'>
            <p>Total Siswa : 
                <?php 
                    $data_siswa = $siswa->getJumlahSiswa();
                    while($row=$data_siswa->fetch_assoc()){
                        echo $row['jumlah'];
                    }
                ?>  
            </p>
        </div>
        <div id='content-siswa'>
            <table id='table_siswa'>
                <tr>
                    <td>Username</td>
                    <td>Nama</td>
                    <td>Kelas</td>
                    <td>Tanggal Lahir</td>
                    <td>Sekolah</td>
                    <td>Email</td>
                    <td>No HP</td>
                    <td>Password</td>
                    <td>Aksi</td>
                </tr>
                
                    <?php 
                        $res_siswa = $siswa->getSiswa();
                        if(isset($_GET['kelas'])){
                            $res_siswa = $siswa->getSiswaFilter($kelas, $matpel, $sesi);
                        }
                        $unik = 1;
                        while($row=$res_siswa->fetch_assoc()){
                            echo "<tr>";
                            echo "<td class='p_username'>".$row['username']."</td>";
                            echo "<td class='p_nama'>".$row['nama']."</td>";
                            echo "<td class='p_kelas' value='".$row['kelas_id']."'>".$row['kelas']."</td>";
                            echo "<td class='p_tanggallahir'>".date('D-M-Y',strtotime($row['tanggal_lahir']))."</td>";
                            echo "<td class='p_namasekolah'>".$row['nama_sekolah']."</td>";
                            echo "<td class='p_email'>".$row['email']."</td>";
                            echo "<td class='p_nohp'>".$row['no_hp']."</td>";
                            echo "<td class='p_password'>".$row['password']."</td>";
                            echo "<td><button class='btnEdit' value='$unik'>Edit</button>&nbsp &nbsp &nbsp<button class='btnHapus' value='$unik'>Hapus</button></td>";
                            echo "</tr>";
                            $unik +=1;
                        }
                    ?>
                
            </table>
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
                var vale = $(this).text();
                if(vale == "Daftar Siswa"){
                    window.location.href="daftarsiswa.php";
                }
                if(vale == "Daftar Kelas"){
                    window.location.href="daftarkelas.php";
                }
                if(vale=="jadwalbimbel"){
                    window.location.href="jadwalbimbel.php";
                }
            });
        });
        $("#btnEditTugas").click(function(){
            window.location.href="edit_tugas.php";
        });
        $("#btnCari").click(function(){
            var key_mapel = $("#cb_matpel_siswa").val();
            var key_kelas = $("#cb_kelas_siswa").val();
            // alert("tugas.php?key_kelas="+key_kelas+"&key_matpel="+key_mapel);
            window.location.href="tugas.php?key_kelas="+key_kelas+"&key_matpel="+key_mapel;
            
        });
        $("#btnSortir").click(function(){
            var kelas = $("#cbkelas").val();
            var matpel = $("#cbmatpel").val();
            var sesi = $("#cbsesi").val();
            window.location.href="daftarsiswa.php?kelas="+kelas+"&matpel="+matpel+"&sesi="+sesi;
        });
        if (performance.navigation.type === 1) {
        history.replaceState({}, document.title, "daftarsiswa.php");
        }
        $(".btnEdit").click(function(){
            var id = $(this).val();
            $("#table_siswa tr").each(function(){
                var idulang = $(this).find(".btnEdit").val();
                if(id === idulang){
                    alert(idulang)
                    var username = $(this).find(".p_username").html();
                    var nama = $(this).find(".p_nama").html();
                    var kelas = $(this).find(".p_kelas").html();
                    var tanggal_lahir = $(this).find(".p_tanggallahir").html();
                    var sekolah = $(this).find(".p_namasekolah").html();
                    var email = $(this).find(".p_email").html();
                    var nohp = $(this).find(".p_nohp").html();
                    var password = $(this).find(".p_password").html();
                    var kelasid = $(this).find(".p_kelas").attr('value');
                    alert(kelasid);
                    window.location.href="editsiswa.php?username=" +
                    username + "&nama=" + nama + "&kelas=" + kelas +
                    "&tanggal_lahir=" + tanggal_lahir +
                    "&sekolah=" + sekolah + "&email=" + email +
                    "&nohp=" + nohp + "&p=" + password+"&kid="+kelasid;

                }
            });
        });
        $(".btnHapus").click(function(){
            var id = $(this).val();
            $("#table_siswa tr").each(function(){
                var idulang = $(this).find(".btnHapus").val();
                if(id === idulang){
                    var username = $(this).find(".p_username").html();
                    alert(username);
                    var confirmres = confirm("Apakah anda yakin menghapus data ini ?");
                    if(confirmres)
                    {
                        $.post("hapus-siswa-ajax.php", {username:username
                        }).done(function(data){
                        alert(data);
                        
                        })
                        window.location.href="daftarsiswa.php";
                    }
                }
            });
        });
    </script>
</body>
</html>
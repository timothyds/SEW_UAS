<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="daftarmatapelajaran.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </style>
    <title>Mata Pelajaran</title>
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
            <p id='home-admin'>Daftar Mata Pelajaran</p>
        </div>
    </div>
    <div id='container'>
        <div id='filter-kelas'>

            <table>
                <tr>
                    <td>
                    <label>Nama Mata Pelajaran : </label>
                    </td>
                    <td>
                        <input type="text" name="nama_mata_pelajaran" id="nama_mata_pelajaran" required>
                        <button type="submit" name="search" id="btnCari">Cari</button>
                        
                        <?php 

                            $matpel = new mataPelajaran();
                            $nama ="%";
                            if (isset($_POST['search'])) {
                                $namaMataPelajaran = $_POST['nama_mata_pelajaran'];
                                $hasilPencarian = $mataPelajaranObj->getMataPelajaran($namaMataPelajaran);
                            } else {
                                $hasilPencarian = []; // Set default value untuk hasil pencarian
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div id='content-kelas'>
            <table id='table_kelas'>
                <tr>
                    <td>ID</td>
                    <td>Nama</td>
                    <td>Aksi</td>
                </tr>
                
                    <?php 
                        $res_matpel= $matpel->getMataPelajaran();
                        if(isset($_GET['nama'])){
                            $res_matpel = $matpel->getMataPelajaran($nama);
                        }
                        $unik = 1;
                        while($row=$res_matpel->fetch_assoc()){
                            echo "<tr>";
                            echo "<td class='p_id'>".$row['idmata_pelajaran']."</td>";
                            echo "<td class='p_matpel'>".$row['nama']."</td>";
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
                $(this).append("<span class='opt'><p>Daftar matpel</p></span>");
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
                $(this).append("<span class='opt'><p>Tambah matpel</p></span>");
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
                if(vale == "Daftar matpel"){
                    window.location.href="daftarmatpel.php";
                }
                if(vale == "Daftar Kelas"){
                    window.location.href="daftarkelas.php";
                }
                if(vale == "Daftar Sesi"){
                    window.location.href="daftarsesi.php";
                }
                if(vale=="jadwalbimbel"){
                    window.location.href="jadwalbimbel.php";
                }
            });
        });
        $("#btnEditTugas").click(function(){
            window.location.href="edit_tugas.php";
        });
        $("#btnSortir").click(function(){
            var kelas = $("#cbkelas").val();
            var ruangan = $("#cbruang").val();
            window.location.href="daftarkelas.php?ruang="+ruangan;//ini kok gabisaaaaa
        });
        if (performance.navigation.type === 1) {
        history.replaceState({}, document.title, "daftarmatapelajaran.php");
        }
        $(".btnEdit").click(function(){
            var id = $(this).val();
            $("#table_kelas tr").each(function(){
                var idulang = $(this).find(".btnEdit").val();
                if(id === idulang){
                    alert(idulang)
                    var idmatpel = $(this).find(".p_id").html();
                    var matpel = $(this).find(".p_matpel").html();
                    alert(matpel);
                    window.location.href="editmatapelajaran.php?id=" + idmatpel + "&nama=" +
                    matpel;

                }
            });
        });
        $(".btnHapus").click(function(){
            var id = $(this).val();
            $("#table_kelas tr").each(function(){
                var idulang = $(this).find(".btnHapus").val();
                if(id === idulang){
                    var idkelas = $(this).find(".p_id").html();
                    alert(idkelas);
                    var confirmres = confirm("Apakah anda yakin menghapus data ini ?");
                    if(confirmres)
                    {
                        $.post("hapus-kelas-ajax.php", {idkelas:idkelas
                        }).done(function(data){
                        alert(data);
                        
                        })
                        window.location.href="daftarmatapelajaran.php";
                    }
                }
            });
        });
    </script>
</body>
</html>
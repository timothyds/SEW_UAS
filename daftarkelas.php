<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="daftarkelas.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </style>
    <title>Kelas</title>
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
            <p id='home-admin'>Daftar Kelas</p>
        </div>
    </div>
    <div id='container'>
        <div id='filter-kelas'>

            <table>
                <tr>
                    <td>
                    <label>Ruangan : </label>
                    </td>
                    <td>
                        <select id='cbruang'>
                        <option value="%">Semua Ruang</option>
                        <?php 
                            $siswa = new daftarsiswa();//ini buat getkelas
                            $ruang = new kelas();
                            $kelas = "%";
                            $ruangan = "%";
                            if(isset($_GET['kelas'])){
                                $kelas = $_GET['kelas'];
                                $ruangan = $_GET['ruangan'];
                            }
                            $res_kelas = $siswa->getKelas("%");
                            while($row=$res_kelas->fetch_assoc()){
                                echo "<option value='".$row['ruang']."'>".$row['ruang']."</option>";
                            }
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
            <button id='btnSortir'>Sortir</button>
        </div>
        <div id='content-kelas'>
            <table id='table_kelas'>
                <tr>
                    <td>ID</td>
                    <td>Kelas</td>
                    <td>Ruang</td>
                    <td>Aksi</td>
                </tr>
                
                    <?php 
                        $res_kelas = $siswa->getKelas();
                        if(isset($_GET['kelas'])){
                            $res_kelas = $ruang->getKelasFilter($ruangan);
                        }
                        $unik = 1;
                        while($row=$res_kelas->fetch_assoc()){
                            echo "<tr>";
                            echo "<td class='p_id'>".$row['id']."</td>";
                            echo "<td class='p_kelas'>".$row['kelas']."</td>";
                            echo "<td class='p_ruangan'>".$row['ruang']."</td>";
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
        history.replaceState({}, document.title, "daftarkelas.php");
        }
        $(".btnEdit").click(function(){
            var id = $(this).val();
            $("#table_kelas tr").each(function(){
                var idulang = $(this).find(".btnEdit").val();
                if(id === idulang){
                    alert(idulang)
                    var idkelas = $(this).find(".p_id").html();
                    var kelass = $(this).find(".p_kelas").html();
                    var ruangans = $(this).find(".p_ruangan").html();
                    alert(idkelas);
                    window.location.href="editkelas.php?id=" + idkelas + "&kelas=" +
                    kelass + "&ruang=" + ruangans;

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
                        window.location.href="daftarkelas.php";
                    }
                }
            });
        });
    </script>
</body>
</html>
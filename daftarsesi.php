<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="daftarsesi.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </style>
    <title>Sesi</title>
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
            <p id='home-admin'>Daftar Sesi</p>
        </div>
    </div>
    <div id='container'>
        <div id='filter-sesi'>

            <table>
                <tr>
                    <td>
                    <label>Waktu Mulai : </label>
                    </td>
                    <td>
                        <select id='cbmulai'>
                        <option value="%">Waktu Mulai</option>
                        <?php 
                            $sesi = new sesi();
                            $sesis = "%";
                            $waktu_mul = "%";
                            $waktu_sel = "%";
                            if(isset($_GET['sesi'])){
                                $sesis = $_GET['sesi'];
                                $waktu_mul = $_GET['waktu_mula'];
                                $waktu_sel = $_GET['waktu_selesai'];
                            }
                            $res_sesi = $sesi->getSesi("%");
                            while($row=$res_sesi->fetch_assoc()){
                                echo "<option value='".$row['waktu_mula']."'>".$row['waktu_mula']."</option>";
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    <label>Waktu Selesai : </label>
                    </td>
                    <td>
                        <select id='cbselesai'>
                    <option value="%">Waktu Selesai</option>
                    <?php 
                        $res_sesi = $sesi->getSelesai("%");
                        while($row=$res_sesi->fetch_assoc()){
                            echo "<option value='".$row['waktu_selesai']."'>".$row['waktu_selesai']."</option>";
                        }
                    ?>
                    </select>
                    </td>
                </tr>
            </table>
            <button id='btnSortir'>Sortir</button>
        </div>
        <div id='content-sesi'>
            <table id='table_sesi'>
                <tr>
                    <td>ID</td>
                    <td>Sesi</td>
                    <td>Waktu Mulai</td>
                    <td>Waktu Selesai</td>
                    <td>Aksi</td>
                </tr>
                
                    <?php 
                        $res_sesi = $sesi->getSesi();
                        if(isset($_GET['nama'])){
                            $res_sesi = $sesi->getSesiFilter($waktu_mul, $waktu_sel);
                        }
                        $unik = 1;
                        while($row=$res_sesi->fetch_assoc()){
                            echo "<tr>";
                            echo "<td class='p_id'>".$row['idsesi']."</td>";
                            echo "<td class='p_sesi'>".$row['nama']."</td>";
                            echo "<td class='p_mulai'>".$row['waktu_mula']."</td>";
                            echo "<td class='p_selesai'>".$row['waktu_selesai']."</td>";
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
            var mul = $("#cbmulai").val();
            var sel = $("#cbselesai").val();
            window.location.href="daftarsesi.php?waktu_mula="+mul+"&waktu_selesai="+sel;//ini kok gabisaaaaa
        });
        if (performance.navigation.type === 1) {
        history.replaceState({}, document.title, "daftarsesi.php");
        }
        $(".btnEdit").click(function(){
            var id = $(this).val();
            $("#table_sesi tr").each(function(){
                var idulang = $(this).find(".btnEdit").val();
                if(id === idulang){
                    alert(idulang)
                    var idsesi = $(this).find(".p_id").html();
                    var namass = $(this).find(".p_sesi").html();
                    var mulss = $(this).find(".p_mulai").html();
                    var selss = $(this).find(".p_selesai").html();
                    alert(idsesi);
                    window.location.href="editsesi.php?idss=" + idsesi + "&nama=" +
                    namass + "&waktu_mula=" + mulss + "&waktu_selesai=" + selss;

                }
            });
        });
        $(".btnHapus").click(function(){
            var id = $(this).val();
            $("#table_sesi tr").each(function(){
                var idulang = $(this).find(".btnHapus").val();
                if(id === idulang){
                    var idsesi = $(this).find(".p_id").html();
                    alert(idsesi);
                    var confirmres = confirm("Apakah anda yakin menghapus data ini ?");
                    if(confirmres)
                    {
                        $.post("hapus-sesi-ajax.php", {idsesi:idsesi
                        }).done(function(data){
                        alert(data);
                        
                        })
                        window.location.href="daftarsesi.php";
                    }
                }
            });
        });
    </script>
</body>
</html>
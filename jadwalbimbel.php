<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="jadwalbimbel.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link href="scheduling/admin/assets/fullcalendar/main.css" rel="stylesheet" />
    <script type="text/javascript" src="scheduling/admin/assets/fullcalendar/main.js"></script>
    <title>Jadwal</title>
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
        <div class='btnnav'><p>Tugas</p></div>
        <div class='btnnav click'><p>Jadwal</p></div>
        <div class='btnnav'><p>Daftar</p></div>
        <div class='btnnav'><p>Tambah</p></div>
    </div>
    <div id='header'>
        <div>
            <p id='home-admin'>JADWAL BIMBEL</p>
        </div>
    </div>
    <div id='container'>
        <div id='filter_tugas'>
            <p id='txtKelas'>Kelas</p>
            <select name="kelas_siswa" id="cb_kelas_siswa">
                <option value="">--Pilih Kelas--</option>
                <?php
                    $tugas = new tugas();
                    $res_kelas = $tugas->getKelas("%");
                    while($row=$res_kelas->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['nama']."</option>";
                    }
                ?>
            </select>
            <br><br>
            <p id='txtMataPelajaran'>Mata Pelajaran</p>
            <select name="matpel_siswa" id="cb_matpel_siswa">
                <option value="">--Pilih Kelas--</option>
                <?php
                    $tugas = new tugas();
                    $res_kelas = $tugas->getMatpel("%");
                    while($row=$res_kelas->fetch_assoc()){
                        echo "<option value='".$row['idmata_pelajaran']."'>".$row['nama']."</option>";
                    }
                ?>
            </select>
            <button id='btnTambahJadwal'>Tambah Jadwal</button>
        </div>
        <div id='content_border'>
            <div id='calendar'>
                
            </div>
        </div>
    </div>
    <script type="text/javascript">
         var calendarEl = document.getElementById('calendar');
    var calendar;
    document.addEventListener('DOMContentLoaded', function() {
   

        calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
          },
          initialDate: '<?php echo date('Y-m-d') ?>',
          weekNumbers: true,
          navLinks: true, // can click day/week names to navigate views
          editable: false,
          selectable: true,
          nowIndicator: true,
          dayMaxEvents: true, // allow "more" link when too many events
          // showNonCurrentDates: false,
          events: []
        });
        calendar.render();
     

        });
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
                if(vale=="jadwalbimbel"){
                    window.location.href="jadwalbimbel.php";
                }
            });
        });
        $("#btnEditTugas").click(function(){
            uni_modal('New Schedule','tambahjadwalbimbel.php','mid-large')
        });
    </script>
</body>
</html>
<?php
class Koneksi {
    protected $con;

    public function __construct(){
        $this->con = new mysqli("localhost", "root", "", "educoncept_db");
    }
    public function __destruct(){
        $this->con->close();
    }
}
class jadwal extends Koneksi{
    public function __construct(){
        parent::__construct();
    } 
    public function getJadwal($search='%'){
        $stmt = $this->con->prepare("select j.hari, j.tanggal_waktu, s.waktu_mula, s.waktu_selesai, mp.nama as mata_pelajaran, k.kelas as kelas
        from jadwal_bimbel j inner join sesi s on j.sesi_idsesi = s.idsesi 
        inner join mata_pelajaran mp on j.mata_pelajaran_idmata_pelajaran = mp.idmata_pelajaran
        inner join kelas k on j.kelas_id = k.id where j.hari like ?");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
}
class akun extends Koneksi{
    public function getProfil($username = "ivano"){
        $stmt = $this->con->prepare("select * from tentor where username like ?;");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result == null){
            $stmt2 = $this->con->prepare("select * from siswa where username like ?;");
            $stmt2->bind_param("s", $username);
            $stmt2->execute();
            $result = $stmt2->get_result();
        }
        return $result;
    }
}
class tugas extends Koneksi{
    public function getKelas($search = "%"){
        $stmt = $this->con->prepare("select * from kelas where kelas like ?;");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getMatpel($search = "%"){
        $stmt = $this->con->prepare("select * from mata_pelajaran where nama like ?;");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getTugas($kelas='%', $matpel='%'){
        $stmt = $this->con->prepare("select t.idtugas, t.tugas_1, t.tugas_2, t.tugas_3, t.quiz, t.siswa_username as nama_siswa, t.periode, k.kelas as kelas, mp.nama as mata_pelajaran
from tugas t inner join siswa s on t.siswa_username=s.username
inner join kelas k on s.kelas_id = k.id
inner join mata_pelajaran mp on t.mata_pelajaran_idmata_pelajaran=mp.idmata_pelajaran
where k.kelas like ? and mp.nama like ?;");
        $stmt->bind_param("ss", $kelas, $matpel);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
class kelas extends Koneksi{
    public function getRuang($search = "%"){
        $stmt = $this->con->prepare("select * from kelas where ruang like ?;");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getKelasFilter($ruang="%"){
        $stmt = $this->con->prepare("select distinct ruang from kelas where ruang = ?;");
        $stmt->bind_param("s", $ruang);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function CreateKelas($nkelas){
        $sql = "INSERT INTO kelas (kelas) VALUES (?)";
        $stmt = $this->con->prepare($sql);

        $stmt->bind_param("s", $nkelas);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function UpdateKelas($idkelas, $nkelas){
        $sql = "UPDATE kelas SET kelas = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("is", $idkelas, $nkelas);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function DeleteKelas($idkelas=0){
        $sql = "DELETE FROM kelas WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $idkelas);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}

class sesi extends Koneksi{
    public function getSesi($search = "%"){
        $stmt = $this->con->prepare("select * from sesi where nama like ?;");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getMulai($search = "%"){
        $stmt = $this->con->prepare("select * from sesi where waktu_mula like ?;");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getSelesai($search = "%"){
        $stmt = $this->con->prepare("select * from sesi where waktu_selesai like ?;");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getSesiFilter($waktu_mul="%", $waktu_sel="%"){
        $stmt = $this->con->prepare("select distinct waktu_mula, waktu_selesai from sesi where waktu_mula = ? and waktu_selesai = ?;");
        $stmt->bind_param("ss", $waktu_mul, $waktu_sel);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function CreateSesi($nsesi, $wktmulai, $wktselesai){
        $sql = "INSERT INTO sesi (nama, waktu_mula, waktu_selesai) VALUES (?, ?, ?)";
        $stmt = $this->con->prepare($sql);

        $stmt->bind_param("sss", $nsesi, $wktmulai, $wktselesai);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function UpdateSesi($idsesi, $nsesi, $wktmulai, $wktselesai){
        $sql = "UPDATE sesi SET nama = ?, waktu_mula = ?, waktu_selesai = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("isss", $idsesi, $nsesi, $wktmulai, $wktselesai);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function DeleteSesi($idsesi=0){
        $sql = "DELETE FROM sesi WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $idsesi);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}
class mataPelajaran extends Koneksi{
    public function getMataPelajaran($search = "%"){
        $stmt = $this->con->prepare("select * from mata_pelajaran where nama like ?;");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getSesiFilter($waktu_mul="%", $waktu_sel="%"){
        $stmt = $this->con->prepare("select distinct waktu_mula, waktu_selesai from sesi where waktu_mula = ? and waktu_selesai = ?;");
        $stmt->bind_param("ss", $waktu_mul, $waktu_sel);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function CreateSesi($nsesi, $wktmulai, $wktselesai){
        $sql = "INSERT INTO sesi (nama, waktu_mula, waktu_selesai) VALUES (?, ?, ?)";
        $stmt = $this->con->prepare($sql);

        $stmt->bind_param("sss", $nsesi, $wktmulai, $wktselesai);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function UpdateSesi($idsesi, $nsesi, $wktmulai, $wktselesai){
        $sql = "UPDATE sesi SET nama = ?, waktu_mula = ?, waktu_selesai = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("isss", $idsesi, $nsesi, $wktmulai, $wktselesai);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function DeleteSesi($idsesi=0){
        $sql = "DELETE FROM sesi WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $idsesi);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}
class daftarsiswa extends Koneksi{
    public function getKelas($search = "%"){
        $stmt = $this->con->prepare("select * from kelas where kelas like ?;");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getMatpel($search = "%"){
        $stmt = $this->con->prepare("select * from mata_pelajaran where nama like ?;");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getSesi($search = "%"){
        $stmt = $this->con->prepare("select * from sesi where nama like ?");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getJumlahSiswa(){
        $result = $this->con->query("select count(*) as jumlah from siswa");
        return $result; 
    }
    public function getSiswa(){
        $result = $this->con->query("select s.username, s.nama as nama, k.kelas as kelas, s.kelas_id, s.tanggal_lahir, 
        s.nama_sekolah, s.email, s.no_hp, s.password from siswa s 
        inner join kelas k on s.kelas_id=k.id; ");
        return $result;
    }
    public function getSiswaFilter($kelas="%", $matpel="%", $sesi="%"){
        $stmt = $this->con->prepare("select distinct s.username, s.nama as nama, k.kelas as kelas, s.kelas_id, s.tanggal_lahir, 
        s.nama_sekolah, s.email, s.no_hp, s.password, mp.nama, ss.nama
        from siswa s 
        inner join kelas k on s.kelas_id=k.id 
        inner join jadwal_bimbel_has_siswa jbs on s.username = jbs.siswa_username
        inner join jadwal_bimbel jb on jbs.jadwal_bimbel_idjadwal_bimbel = jb.idjadwal_bimbel
        inner join mata_pelajaran mp on jb.mata_pelajaran_idmata_pelajaran=mp.idmata_pelajaran
        inner join sesi ss on jb.sesi_idsesi=ss.idsesi where k.kelas=? and mp.nama=? and ss.nama=?;");
        $stmt->bind_param("sss", $kelas, $matpel, $sesi);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function updateSiswa($username, $kelas_id, $nama, $nama_sekolah, $email, $nohp, $password, $tanggal_lahir){
        $stmt=$this->con->prepare("update siswa set username = ?, kelas_id = ?, nama=?, nama_sekolah=?, email=?, no_hp=?, password=?, tanggal_lahir=?");
        $stmt->bind_param("sissssss", $username, $kelas_id, $nama, $nama_sekolah, $email, $nohp, $password, $tanggal_lahir);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
}

?>
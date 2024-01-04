<?php 
$username = $_POST['username'];
$nama = $_POST['nama'];
$kelas_id = $_POST['kelasid'];
$tgl_lahir = $_POST['tgl_lahir'];
$namasekolah = $_POST['namasekolah'];
$email = $_POST['email'];
$nohp = $_POST['nohp'];
$password = $_POST['password'];

$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt=$con->prepare("update siswa set username = ?, kelas_id = ?, nama=?, nama_sekolah=?, email=?, no_hp=?, password=?, tanggal_lahir=? where username like ?;");
$stmt->bind_param("sisssssss", $username, $kelas_id, $nama, $namasekolah, $email, $nohp, $password, $tgl_lahir, $username);
$stmt->execute();
if($stmt->affected_rows > 0){
    $response = array('status' => 'success', 'message' => 'Update berhasil');
}else{
    $response = array('status' => 'error', 'message' => $stmt->error);
}
echo json_encode($response);

?>
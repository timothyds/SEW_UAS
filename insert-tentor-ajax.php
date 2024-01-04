<?php 
$username = $_POST['username'];
$nama = $_POST['nama'];
$tgl_lahir = $_POST['tgl_lahir'];
$asaluniv = $_POST['asaluniv'];
$email = $_POST['email'];
$nohp = $_POST['nohp'];
$password = $_POST['password'];

$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt=$con->prepare("insert into tentor (username, nama, lulusan, email, no_hp, password, tanggal_lahir) values (?,?,?,?,?,?,?);");
$stmt->bind_param("sssssss", $username, $nama, $asaluniv, $email, $nohp, $password, $tgl_lahir);
$stmt->execute();
if($stmt->affected_rows > 0){
    $response = array('status' => 'success', 'message' => 'Update berhasil');
}else{
    $response = array('status' => 'error', 'message' => $stmt->error);
}
echo json_encode($response);

?>
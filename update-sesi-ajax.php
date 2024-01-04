<?php 
$id = $_POST['id'];
$sesi = $_POST['nama'];
$waktu_mul = $_POST['waktu_muls'];
$waktu_sel = $_POST['waktu_sels'];

$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt=$con->prepare("update sesi set nama = ?, waktu_mula = ?, waktu_selesai = ? where idsesi like ?;");
$stmt->bind_param("isss", $id, $sesi, $waktu_mul, $waktu_sel);
$stmt->execute();
if($stmt->affected_rows > 0){
    $response = array('status' => 'success', 'message' => 'Update berhasil');
}else{
    $response = array('status' => 'error', 'message' => $stmt->error);
}
echo json_encode($response);

?>
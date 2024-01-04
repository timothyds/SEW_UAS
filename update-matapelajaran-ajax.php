<?php 
$id = $_POST['id'];
$nama = $_POST['nama'];

$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt=$con->prepare("update mata_pelajaran set nama = ? where idmata_pelajaran like ?;");
$stmt->bind_param("si", $nama, $id);
$stmt->execute();
if($stmt->affected_rows > 0){
    $response = array('status' => 'success', 'message' => 'Update berhasil');
}else{
    $response = array('status' => 'error', 'message' => $stmt->error);
}
echo json_encode($response);

?>
<?php 
$id = $_POST['id'];
$kelas = $_POST['kelas'];
$ruang = $_POST['ruang'];

$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt=$con->prepare("update kelas set kelas = ?, ruang = ? where id like ?;");
$stmt->bind_param("iss", $id, $kelas, $ruang);
$stmt->execute();
if($stmt->affected_rows > 0){
    $response = array('status' => 'success', 'message' => 'Update berhasil');
}else{
    $response = array('status' => 'error', 'message' => $stmt->error);
}
echo json_encode($response);

?>
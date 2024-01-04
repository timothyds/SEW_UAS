<?php 
$username = $_POST['username'];
$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt = $con->prepare("delete from siswa where username like ?");
$stmt->bind_param("s", $username);
$stmt->execute();
if($stmt->affected_rows > 0){
    $response = array('status' => 'success', 'message' => 'Update berhasil');
}else{
    $response = array('status' => 'error', 'message' => $stmt->error);
}
return json_encode($response);

?>
<?php
$t1 = $_POST['p_t1'];
$t2 = $_POST['p_t2'];
$t3 = $_POST['p_t3'];

$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt = $con->prepare("update siswa set username");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$res = $stmt->get_result();
if($row=$res->fetch_assoc()){
    echo json_encode($row);
}else{
    echo "Not Found";
}



?>
<?php
$username = $_POST['p_user'];
$password = $_POST['p_pass'];
$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt = $con->prepare("select username, password from tentor where username = ? and password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$res = $stmt->get_result();
if($row=$res->fetch_assoc()){
    echo json_encode($row);
}else{
    echo "Not Found";
}



?>
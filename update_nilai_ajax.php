<?php
require_once("EduconceptClass.php");
$id = $_POST['id'];
$t1 = $_POST['t1'];
$t2 = $_POST['t2'];
$t3 = $_POST['t3'];
$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt = $con->prepare("update tugas set tugas_1 = ?, tugas_2=?, tugas_3=? where idtugas=?;");
$stmt->bind_param("iiii", $t1, $t2, $t3, $id);
$stmt->execute();
if($stmt->error){
    echo "Update Gagal";
}else{
    echo "Sukses Update";
}

?>
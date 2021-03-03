<?php
require_once 'inc/functions.php'; 
require_once 'inc/headers.php'; 

$input = json_decode(file_get_contents('php://input'));
$id = filter_var($input->id,FILTER_SANITIZE_NUMBER_INT);
$kuvaus = filter_var($input->kuvaus,FILTER_SANITIZE_STRING); 
$maara = filter_var($input->maara,FILTER_SANITIZE_NUMBER_INT); 
try {
    $db = opendb(); 
    $query = $db->prepare('update lista set kuvaus=:kuvaus, maara=:maara  where id=:id');
    $query->bindValue(':kuvaus',$kuvaus,PDO::PARAM_STR);
    $query->bindValue(':maara',$maara,PDO::PARAM_INT);
    $query->bindValue(':id',$id,PDO::PARAM_INT); 
    $query->execute();

    echo header('http/1.1 200 ok');
    $data = array('id' => $id, 'kuvaus' => $kuvaus, 'maara' => $maara);
    echo json_encode($data);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}
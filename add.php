<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$kuvaus = filter_var($input->kuvaus,FILTER_SANITIZE_STRING);
$maara = filter_var($input->maara,FILTER_SANITIZE_NUMBER_INT);

try{
    $db=opendb(); 

    $query = $db->prepare('insert into lista(kuvaus, maara) values (:kuvaus, :maara)');
    $query->bindValue(':kuvaus',$kuvaus,PDO::PARAM_STR);
    $query->bindValue(':maara',$maara,PDO::PARAM_INT); 
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $db->lastInsertId(),'kuvaus' => $kuvaus, 'maara' => $maara);
    echo json_encode($data);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}


<?php
require_once 'inc/functions.php'; 
require_once 'inc/headers.php'; 

$input = json_decode(file_get_contents('php://input'));
$id = filter_var($input->id,FILTER_SANITIZE_NUMBER_INT);
$description = filter_var($input->description,FILTER_SANITIZE_STRING); 
$amount = filter_var($input->amount,FILTER_SANITIZE_NUMBER_INT); 
try {
    $db = opendb(); 
    $query = $db->prepare('update item set description=:description, amount=:amount  where id=:id');
    $query->bindValue(':description',$description,PDO::PARAM_STR);
    $query->bindValue(':amount',$amount,PDO::PARAM_INT);
    $query->bindValue(':id',$id,PDO::PARAM_INT); 
    $query->execute();

    echo header('http/1.1 200 ok');
    $data = array('id' => $id, 'description' => $description, 'amount' => $amount);
    echo json_encode($data);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}
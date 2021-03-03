<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';

try{
    $db=openDb(); 

    $sql="select * from lista"; 
    $query = $db->query($sql); 
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    header('http/1.1 200 OK'); 
    echo json_encode($result);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}
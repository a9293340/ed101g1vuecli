<?php
try{
    $setp = [];
    $otherp = [];
    $total = [];

    session_start();
    require_once("connect.php");
    $sql = "SELECT * FROM SET_PRODUCT;";
    $orderSql = $pdo->prepare($sql); 
    $orderSql->execute();

    $setp = $orderSql->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($order);

    $sql = "SELECT * FROM `OTHER_PRODUCT`;";
    $orderSql = $pdo->prepare($sql); 
    $orderSql->execute();
    $otherp = $orderSql->fetchAll(PDO::FETCH_ASSOC);


    $total = [$setp,$otherp];

    echo json_encode($total);
    
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
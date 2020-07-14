<?php
try{
    $order=[];
    $health = [];
    $total = [];

    session_start();
    require_once("connect.php");
    $sql = "SELECT * FROM `ORDER` WHERE ORDERER = :memId;";
    $orderSql = $pdo->prepare($sql); 
    $orderSql->bindValue(":memId", $_SESSION["memId"]);
    $orderSql->execute();


    $order = $orderSql->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($order);

    $sql = "SELECT * FROM `HEALTH_ANALYSES` WHERE healMember = :memId;";
    $orderSql = $pdo->prepare($sql); 
    $orderSql->bindValue(":memId", $_SESSION["memId"]);
    $orderSql->execute();
    $health = $orderSql->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM `MEMBER` WHERE memId = :memId;";
    $orderSql = $pdo->prepare($sql); 
    $orderSql->bindValue(":memId", $_SESSION["memId"]);
    $orderSql->execute();
    $mem = $orderSql->fetchAll(PDO::FETCH_ASSOC);

    $total = [$mem,$order,$health];

    echo json_encode($total);
    
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
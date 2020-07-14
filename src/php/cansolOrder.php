<?php 

    require_once("connect.php");
    $sql = "update `ORDER` set orderStatus = 5 where orderId=:orderId";
    $orderSql = $pdo->prepare($sql);
    $orderSql->bindValue(":orderId",$_GET["orderId"] );
    $orderSql->execute();

    echo 'good';
?>
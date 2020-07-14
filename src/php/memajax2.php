<?php
try{
    $order=[];
    $single = [];
    $set = [];
    $other = [];
    $total = [];

    session_start();
    require_once("connect.php");
    $sql = "SELECT * FROM `ORDER` WHERE ORDERER = :memId;";
    $orderSql = $pdo->prepare($sql); 
    $orderSql->bindValue(":memId", $_SESSION["memId"]);
    $orderSql->execute();

    $order = $orderSql->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($order);
    foreach ($order as $i => $value) {
        $sql = "select sp1.spName as 'soRice', sp2.spName as 'mainfood', sp3.spName as 'sideDishes1', sp4.spName as 'sideDishes2', sp5.spName as 'sideDishes3',so.soPrice,so.soImg,so.soAmount,so.soBelongOrder,so.soRice as 'soRiceId',so.mainFood as 'mainfoodId',so.sideDishes1 as 'sideDishes1Id',so.sideDishes2 as 'sideDishes2Id',so.sideDishes3 as 'sideDishes3Id' from SINGLE_ORDER as so join SINGLE_PRODUCT as sp1 on so.soRice = sp1.spId join SINGLE_PRODUCT as sp2 on so.mainFood = sp2.spId join SINGLE_PRODUCT as sp3 on so.sideDishes1 = sp3.spId join SINGLE_PRODUCT as sp4 on so.sideDishes2 = sp4.spId join SINGLE_PRODUCT as sp5 on so.sideDishes3 = sp5.spId where so.soBelongOrder =:orderId";
        $orderSql = $pdo->prepare($sql); 
        $orderSql->bindValue(":orderId",$value['orderId']);
        $orderSql->execute();
        $single = array_merge($single,$orderSql->fetchAll(PDO::FETCH_ASSOC));
    }
    foreach ($order as $i => $value) {
        $sql = "select se.setName, seto.setoAmount,seto.setoBelongOrder,seto.setoPrice,se.setImage,se.setId,se.setClass from SET_ORDER as seto join SET_PRODUCT as se on seto.setoName = se.setId where seto.setoBelongOrder =:orderId;";
        $orderSql = $pdo->prepare($sql); 
        $orderSql->bindValue(":orderId",$value['orderId']);
        $orderSql->execute();
        $set = array_merge($set,$orderSql->fetchAll(PDO::FETCH_ASSOC));
    }
    foreach ($order as $i => $value) {
        $sql = "select op.opName, op.opImage,op.opId,oo.ooBelongOrder,oo.ooAmount,oo.ooPrice from OTHER_ORDER as oo join OTHER_PRODUCT as op on oo.ooName = op.opId where oo.ooBelongOrder = :orderId;";
        $orderSql = $pdo->prepare($sql); 
        $orderSql->bindValue(":orderId",$value['orderId']);
        $orderSql->execute();
        $other = array_merge($other,$orderSql->fetchAll(PDO::FETCH_ASSOC));
    }

    $total = [$single,$set,$other];
    echo json_encode($total);
    
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
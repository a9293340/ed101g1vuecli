<?php 

    try {
        $dsn = "mysql:host=localhost;port=8889;dbname=ED101G1;charset=utf8";
        $user = "root";
        $password = "root";
        $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO( $dsn, $user, $password, $options); 
        $sql = "select * from `SET_PRODUCT`";
        $orderSql = $pdo->prepare($sql);
        $orderSql->execute();
    
        $order = $orderSql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($order);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>
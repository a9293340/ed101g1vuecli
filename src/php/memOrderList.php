<?php 
    $orderId = $_GET['orderId'];
    try {
        require_once("connect.php");
        $sql = "SELECT * FROM `ORDER` as `o` JOIN `MEMBER` as `m` ON `o`.orderer = `m`.memId WHERE orderId=:orderId";
        $orderSql = $pdo->prepare($sql);
        $orderSql->bindValue(":orderId", $orderId);
        $orderSql->execute();
    
        $order = $orderSql->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>寶島食堂-訂單</title>
</head>
<style>
    .img{
        position: absolute;
        left: 50%;
        top:5%;
        transform: translate(-50%);
        width:200px;
    }
    .table {
        font-family: 'Roboto';
        border-collapse: collapse;
        margin: 0 auto;
        margin-top: 120px;
        border: solid 1px #b3b3b3;
        overflow: auto; }
    .table th {
        color: #37AB64;
        font-size: 1.5rem;
        border-top: solid 1px #b3b3b3;
        border-left: solid 1px #b3b3b3;
        text-align: left;
        padding: 5px;
        padding-left: 12px; }
    .table tr td {
        color: #141212;
        font-size: 1rem;
        border-top: solid 1px #b3b3b3;
        border-left: solid 1px #b3b3b3;
        padding: 10px;
        text-align: left;
        padding-left: 12px;
        vertical-align: middle; }
</style>
<body>
    <img src="../images/header/寶島食堂LOGO_v3-02.png" class='img'>
    <table class="table">
        <tr>
            <th>
                訂單編號
            </th>
            <td>
                <?php 
                    echo $order['orderId'];
                ?>
            </td>
        </tr>
        <tr>
            <th>
                訂單所有人
            </th>
            <td>
                <?php 
                    echo $order['memName'];
                ?>
            </td>
        </tr>
        <tr>
            <th>
                取餐方式
            </th>
            <td>
                <?php 
                    if($order["orderClass"] == 0){
                        echo '外送';
                    }else{
                        echo '自取';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th>
                目前狀態
            </th>
            <td>
                <?php 
                    if($order['orderStatus'] == 0){
                        echo '確認中';
                    }else if($order['orderStatus'] == 1){
                        echo '已確認';
                    }else if($order['orderStatus'] == 2){
                        echo '已出餐';
                    }else if($order['orderStatus'] == 3){
                        echo '已送達';
                    }else if($order['orderStatus'] == 4){
                        echo '完成訂單';
                    }else if($order['orderStatus'] == 5){
                        echo '已取消';
                    }else if($order['orderStatus'] == 6){
                        echo '已歸檔';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th>
                訂單價格
            </th>
            <td>
                <?php 
                    echo $order["orderTotalPrice"].'元';
                ?>
            </td>
        </tr>
        <tr>
            <th>
                訂單備註
            </th>
            <td>
                <?php 
                    echo $order["orderRemark"];
                ?>
            </td>
        </tr>
    </table>  
</body>
</html>
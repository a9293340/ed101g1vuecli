<?php
$orderSin=[];
$orderSet=[];
$orderOth=[];
$totalOrder = json_decode($_POST["totalOrder"]);
$orderSin = $totalOrder[0];
$orderSet = $totalOrder[1];
$orderOth = $totalOrder[2];
$memId = (int)$totalOrder[3];
$orderAdr = $totalOrder[4];
$orderLorderListTextPost = $totalOrder[5];
$orderCla = (int)$totalOrder[6];
$OrTotalPrice = (int)$totalOrder[7];
$orderTime = $totalOrder[8];
$orderStatus = (int)0;
$mealTime = $totalOrder[8];
$MemScore = $totalOrder[9];

// echo json_encode($MemScore);

try{
    require_once("connect.php");
    $sqlorder = "INSERT INTO `ORDER` (`orderer`, `orderTotalPrice`, `orderTime`, `orderClass`, `deliveryAddr`, `mealTime`,`orderStatus`,`orderRemark`) VALUES ('$memId','$OrTotalPrice','$orderTime','$orderCla','$orderAdr','$mealTime','$orderStatus','$orderLorderListTextPost');";
    $order=$pdo->prepare($sqlorder);
    $order->execute();

    $lastId = $pdo->lastInsertId();
    if(is_array($orderSin)){
    for($i=0;$i<count($orderSin); $i++){
foreach($orderSin[$i] as $key => $value){
    if($key == "soPrice"){
        $soPrice = $value;
    }
    if( $key == "riceId"){
        $riceId = $value;
    }
    if($key == 'meatId'){
        $meatId =  $value;
    }
    if($key == 'singleId1'){
        $singleId1 = $value;
    }
    if($key == 'singleId2'){
        $singleId2 = $value;
    }
    if($key == 'singleId3'){
        $singleId3 = $value;
    }
    if($key == 'soImg'){
        $soImg = $value;
        
    }
}


$upload_dir = "../images/singlePiC/";  //檢查資料夾存不存在
if( ! file_exists($upload_dir )){
  mkdir($upload_dir);
}

echo json_encode($soImg);
$soImg = str_replace('data:image/png;base64,', '', $soImg);
$soImg = str_replace(' ', '+', $soImg);

$data = base64_decode($soImg);

$fileName = date("YmdHis"); 

$file = $upload_dir . $fileName . $i . ".png";
$imgRoad ="./images/singlePiC/" . $fileName .  $i . ".png";
$success = file_put_contents($file, $data);



// echo $success ? $file : 'error';



    $Sinorder = "INSERT INTO `single_order` (`soPrice`,`soAmount`,`soBelongOrder`,`soRice`,`mainFood`,`sideDishes1`,`sideDishes2`,`sideDishes3`,`soImg`)  VALUES ('$soPrice','1','$lastId','$riceId','$meatId','$singleId1','$singleId2','$singleId3','$imgRoad')";
    $order1=$pdo->prepare($Sinorder);
    $order1->execute();

}
}

if(is_array($orderSet)){
for($j=0;$j<count($orderSet); $j++){
foreach($orderSet[$j] as $key => $value){
    if($key == "setdoId"){
        $setdoId = $value;
    }
    if($key == "setdoPrice"){
        $setdoPrice = $value;
    }
    if($key == "setdoMany"){
        $setdoMany = $value;
    }
 }
 $Setorder = "INSERT INTO `set_order` (`setoName`,`setoPrice`,`setoAmount`,`setoBelongOrder`) VALUES ('$setdoId','$setdoPrice','$setdoMany','$lastId')";
 $order2=$pdo->prepare($Setorder);
 $order2->execute();
}
}

if(is_array($orderOth)){
for($z=0;$z<count($orderOth); $z++){
    foreach($orderOth[$z] as $key => $value){
        if($key == "otherId"){
            $otherId = $value;
        }
        if($key == "otherPrice"){
            $otherPrice = $value;
        }
        if($key == "otherMany"){
            $otherMany = $value;
        }
    }

    $Otherorder = "INSERT INTO `other_order` (`ooName`,`ooPrice`,`ooAmount`,`ooBelongOrder`) VALUES ('$otherId','$otherPrice','$otherMany','$lastId')";
    $order3=$pdo->prepare($Otherorder);
    $order3->execute();

}
}

    $memScoreSql = "UPDATE `member` SET `memScore` = '$MemScore' WHERE `member`.`memId` = $memId";
    $Score=$pdo->prepare($memScoreSql);
    $Score->execute();

}catch(PDOException $e){
    echo $e->getMessage();
  }

?>
<?php

try{
  require_once("connect.php");
  $sql = "select * from `member` where memEmail=:memEmail";
  $member = $pdo->prepare($sql);

  $member->bindValue(":memEmail",$_GET["memEmail"]);
  $member->execute();

  if( $member->rowCount() !=0){ //此帳號已存在, 不可用
    echo "此帳號已存在, 不可用";
  }else{ //此帳號可使用
    echo "此帳號可使用";
  } 
}catch(PDOException $e){
  echo "error";
}
?>
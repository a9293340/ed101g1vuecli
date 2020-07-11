<?php 
    try{
        require_once("connect.php");
        $sql = "INSERT INTO `MEMBER` (memEmail,memPsw,memName,memStatus,memScore,memAddr,memPhone,memHealth,memReportCount) VALUES (:memEmail,:memPsw,:memName,'1','0',:memAddr,:memPhone,'0','0'); ";
        $member = $pdo->prepare($sql); 
        $member->bindValue(":memEmail", $_POST["memEmail"]);
        $member->bindValue(":memPsw", $_POST["memPsw"]);
        $member->bindValue(":memName", $_POST["memName"]);
        $member->bindValue(":memAddr", $_POST["memAddr"]);
        $member->bindValue(":memPhone", $_POST["memPhone"]);
        $member->execute();
    
        echo "<script>alert('新增成功');location.href='../order.html';</script>";
    }catch(PDOException $e){
      echo $e->getMessage();
    }
?>
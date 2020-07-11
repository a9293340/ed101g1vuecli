<?php 
    session_start();
    try{
        require_once("connect.php");
        $sql = "select * from `MEMBER` where memEmail=:memEmail and memPsw=:memPsw";
        $member = $pdo->prepare($sql); 
        $member->bindValue(":memEmail", $_REQUEST["memEmail"]);
        $member->bindValue(":memPsw", $_REQUEST["memPsw"]);
        $member->execute();

    
        if( $member->rowCount()==0){ //查無此人
            echo "sad";
        }else{ //登入成功
            $memRow = $member->fetch(PDO::FETCH_ASSOC);
            if($memRow["memStatus"] == 1){
                //將登入者的資訊寫入SESSION
                $_SESSION["memId"] = $memRow["memId"];
    
    
                $memberInfo = array("memId"=>$memRow["memId"],"memEmail"=>$memRow["memEmail"], "memImage"=>$memRow["memImage"],"memScore"=>$memRow["memScore"]);
    
    
                echo json_encode($memberInfo);
            }else{
                echo 'bad';
            }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>
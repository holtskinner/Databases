<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }

    if(!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS'])
    {
        $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header('Location: ' . $url);
    }

    $item = $_POST['Item'];
    if($item != NULL){
        $link = mysqli_connect("localhost", "guest_user", "Phcn43", "group_database") or die ("Connect Error".mysqli_error($link));
        
        //checks if item is in inventory
        $q1 = "SELECT * FROM item AS i INNER JOIN item_category AS c ON i.category=c.name WHERE id = ?";    
        if($stmt1 = mysqli_prepare($link, $q1)){
            mysqli_stmt_bind_param($stmt1, "i", $item) or die ("bind param 1");
            mysqli_stmt_execute($stmt1);
        }else{
            die("Prepared 1 failed");
        }
	$result1 = mysqli_stmt_get_result($stmt1);
	$info1 = mysqli_fetch_assoc($result1);
        if($info1==NULL){
            header("Location: ItemInOut.php?result=0");
        }else{
	     if($info1['ischeckedout'] != 1){
		 mysqli_close($link);
                 header("Location: ItemInOut.php?result=3");
             }else{
                 $q2 = "SELECT * FROM student_item_transaction WHERE (item_id = ? and checkin = NULL)";
                 if($stmt2 = mysqli_prepare($link, $q1)){
                     mysqli_stmt_bind_param($stmt2, "s", $item) or die ("bind param 2");
                     mysqli_stmt_execute($stmt2);
                 }else{
                     die("Prepared 2 failed");
                 }
                 $result2 = mysqli_stmt_get_result($stmt2);
                 $info2 = mysqli_fetch_assoc($result2);
                 //adds time to due_at
                 $u2 = "UPDATE student_item_transaction SET due_at = date_add(?, INTERVAL ? MINUTE) WHERE item_id = ?";
                 if($stmt4 = mysqli_prepare($link, $u2)){
                     mysqli_stmt_bind_param($stmt4, "sii", $info2['due_at'], $info1['time_limit'] ,$item) or die ("bind param update 1");
                     mysqli_stmt_execute($stmt4);
                 }else{
                         die("Prepared update 1 failed");
                 }
             }
         }
	mysqli_close($link);
	header("Location: ItemInOut.php?result=9");
    }else{
        header("Location: ItemInOut.php?result=5");
    }
?>

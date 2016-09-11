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
    $link = mysqli_connect("localhost", "guest_user", "Phcn43", "group_database") or die ("Connect Error".mysqli_error($link));
    $Sid = $_POST['Id'];
        
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
         //checks if student id swiped
	if($Sid == NULL){
       	    mysqli_close($link);
            header("Location: ItemInOut.php?result=6");
            //checks if item is already checked out
        }else if($info1['ischeckedout'] == 1){
                mysqli_close($link);
                header("Location: ItemInOut.php?result=1");
            }else{
                //checks if student has filled out waiver
                $q3 = "SELECT waiver FROM student where student_id = ?";
                if($stmt3 = mysqli_prepare($link, $q3)){
                    mysqli_stmt_bind_param($stmt3, "i", $Sid) or die ("bind param 3");
                    mysqli_stmt_execute($stmt3);                
                }else{
                    die("Prepared 3 failed");
                }
                $result3 = mysqli_stmt_get_result($stmt3);
                $waiver = mysqli_fetch_assoc($result3);
                if($waiver['waiver'] != 1){
                    mysqli_close($link);
                    header("Location: ItemInOut.php?result=7");                  
                }else{
                    //checks item out.
                    $i1 = "INSERT INTO student_item_transaction (student_id, item_id, employee_username, condition_of_item_out, location_out, check_out, due_at) values (?,?,?,?,?, NOW(), date_add(NOW(), INTERVAL ? MINUTE))";
                    if($stmt4 = mysqli_prepare($link, $i1)){
                        mysqli_stmt_bind_param($stmt4, "iisssi", $Sid, $item, $_SESSION['username'], $info1['item_condition'], $info1['location'],  $info1['time_limit']) or die ("bind param insert 1");
                        mysqli_stmt_execute($stmt4);
                    
                    }else{
                        die("Prepared insert 1 failed");
                    }
                    $u1 = "UPDATE item SET ischeckedout = 1 WHERE id = ?";
                    if($stmt5 = mysqli_prepare($link, $u1)){
                        mysqli_stmt_bind_param($stmt5, "i", $item) or die ("bind param update 1");
                        mysqli_stmt_execute($stmt5);
                    }else{
                        die("Prepared update 1 failed");
                    }
                    mysqli_close($link);
                    header("Location: ItemInOut.php?result=2");
                }
            }
        }
?>

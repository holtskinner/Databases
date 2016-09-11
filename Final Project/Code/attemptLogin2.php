<?php
session_start();
/*
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS'])
{ // if request is not secure, redirect to secure url
     $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     header('Location: ' . $url);
}
*/
if (isset($_POST['submit']))
  {
    $mysqli = new mysqli("localhost", "guest_user", "Phcn43", "group_database");
    if ($mysqli->connect_errno)
    {
      //echo "Failed to connect to MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
      $_SESSION["fail"] = -1;
    }
//pull password
    $q = "SELECT hashed_password, username, permission_id FROM employee WHERE username = ?";
    $username = $_POST['username'];
    if (!($check = $mysqli->prepare($q)))
    {
      //echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
      $_SESSION["fail"] = -1;
    }
    if (!$check->bind_param('s', $username))
    {
      //echo "Binding Failed: (" . $mysqli->errno . ") " . $mysqli->error;
      $_SESSION["fail"] = -1;
    }

    $password = $_POST['password'];

    if ($username == "")
      {
        //echo "You must enter a username";
        $_SESSION["fail"] = "nousername";
      }
    elseif ($username != htmlspecialchars($username))
      {
        //echo "You have entered an invaid username";
        $_SESSION["fail"] = "invalidusername";
      }
    elseif ($password == "")
      {
        //echo "You must enter a password";
        $_SESSION["fail"] = "nopassword";
      }
    elseif ($password != htmlspecialchars($password))
      {
        //echo "You have entered an invalid password";
        $_SESSION["fail"] = "invalidpassword";
      }
    else
      {
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);
        if (!$check->execute())
          {
            //echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $_SESSION["fail"] = -1;
            break;
          }
        $check->bind_result($hashed_password, $username, $permission_id); //get info from select statements
        $check->fetch(); //fetch results
        if ($hashed_password == "") //user does not exist case
          {
            //echo "User not Found";
            $_SESSION["fail"] = "usernotfound";
          }
        elseif (password_verify($password, $hashed_password)) //set session variables if password is correct
          {
            $_SESSION["username"]      = $username;
            $_SESSION["permission_id"] = $permission_id;
            $check->close(); //close prepared statement
            $mysqli->close(); //close link to database
            header("Location: index.php"); //send user to index page
          }
        else
          {
            $_SESSION["fail"] = 'invalid';//Something else
            $check->close();
            $mysqli->close();
            header("Location: login2.php");
          }
      }
  }
header("Location: login2.php");
?>

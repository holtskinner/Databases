<?php
	session_start();

	if(!isset($_SESSION['username'])){
		header("Location: login2.php");
	}
	if ($_SESSION["permission_id"] != 'admin')
	{
		header("Location: nopermission.php");
	}
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS'])
	{ // if request is not secure, redirect to secure url
	     $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	     header('Location: ' . $url);
	}
?>

    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <title>Student</title>
    </head>

    <body>
        <?php
  include_once("navbar.php");
 ?>
            <div class="container">
                <br>
                <br>
                <div class="row">
                    <h1 align="center">Add New Student</h1>
                    <form action="student.php" method="POST" class="col-md-4 col-md-offset-4">
                        <div class="row">
                            <div class="input-group">
                                <div class='form-group'>
                                    <label class='inputdefault'>Student Id</label>
                                    <input class='form-control' type='text' name='ID' value=''>
                                </div>
                                <div class='form-group'>
                                    <label class='inputdefault'>Username</label>
                                    <input class='form-control' type='text' name='Username' value=''>
                                </div>
                                <div class='form-group'>
                                    <label class='inputdefault'>Email</label>
                                    <input class='form-control' type='text' name='Email' value=''>
                                </div>
                                <div class='form-group'>
                                    <label class='inputdefault'>First Name</label>
                                    <input class='form-control' type='text' name='FirstName' value=''>
                                </div>
                                <div class='form-group'>
                                    <label class='inputdefault'>Last Name</label>
                                    <input class='form-control' type='text' name='LastName' value=''>
                                </div>
                            </div>
                            <input class=" btn btn-primary" style="margin-top:10px" type="submit" name="submit" value="Add Student">
                        </div>
                    </form>
                </div>
                <?php

        if(isset($_POST['submit']))
        {
            $link = mysqli_connect("localhost","guest_user","Phcn43","group_database") or die("Connect Error " . mysqli_error($link));

            $id = $_POST['ID'];
            $username = $_POST['Username'];
            $email = $_POST['Email'];
            $firstname = $_POST['FirstName'];
            $lastname = $_POST['LastName'];

            $q = "INSERT INTO student(student_id, username, email, name_first, name_last) VALUES(?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($link, $q);
            mysqli_stmt_bind_param($stmt, "issss", $id, $username, $email, $firstname, $lastname) or die("bind param");
            if(mysqli_stmt_execute($stmt))
			{
				echo '<div class="alert alert-success" role="alert">Successfully Added Student!</div>';
            }
			else
			{
				echo '<div class="alert alert-danger" role="alert">Could not Add Student</div>';
			}
            mysqli_close($stmt);
            mysqli_close($link);
        }
?>
          </div>
    </body>
</html>

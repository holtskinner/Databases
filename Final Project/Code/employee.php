<!DOCTYPE html>
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <title>Add New Employee Account</title>
    </head>

    <body>

<?php
  include_once("navbar.php");
 ?>
            <div class="container">
                <br>
                <br>
                <div class="row">
                    <h1 align="center">Add New Employee</h1>
                    <form action="employee.php" method="POST" class="col-md-4 col-md-offset-4">
                        <div class="row">
                            <div class="input-group">
                                <div class='form-group'>
                                    <label class='inputdefault'>Employee Id</label>
                                    <input class='form-control' type='text' name='ID' value=''>
                                </div>
                                <div class='form-group'>
                                    <label class='inputdefault'>Username</label>
                                    <input class='form-control' type='text' name='Username' value=''>
                                </div>
                                <div class='form-group'>
                                    <label class='inputdefault'>Password</label>
                                    <input class='form-control' type='password' name='Password' value=''>
                                </div>
                                <div class='form-group'>
                                    <label class='inputdefault'>First Name</label>
                                    <input class='form-control' type='text' name='FirstName' value=''>
                                </div>
                                <div class='form-group'>
                                    <label class='inputdefault'>Last Name</label>
                                    <input class='form-control' type='text' name='LastName' value=''>
                                </div>
																<div class='form-group'>
																		<label class='inputdefault'>Permissions</label>
																		<select class="form-control" name='permission' value='student'>
																			<option value="student">Student Employee</option>
																		<option value="admin">Admin</option>
																	</select>
																</div>
                            </div>
                            <input class=" btn btn-info" style="margin-top:10px" type="submit" name="submit" value="Add Employee">
                        </div>
                    </form>
                </div>

                <?php
						        if(isset($_POST['submit']))
						        {
						            $link = mysqli_connect("localhost","guest_user","Phcn43","group_database") or die("Connect Error " . mysqli_error($link));

						            $id = $_POST['ID'];
						            $username = $_POST['Username'];
						            $firstname = $_POST['FirstName'];
						            $lastname = $_POST['LastName'];
												$pass = password_hash($_POST['Password'], PASSWORD_BCRYPT);
												$permission = $_POST['permission'];

						             $r =  "INSERT INTO employee(username, name_first, name_last, employee_id, hashed_password, permission_id) VALUES(?, ?, ?, ?, ?, ?)";

						             $stmt = mysqli_prepare($link, $r);

						                mysqli_stmt_bind_param($stmt, "sssiss", $username, $firstname, $lastname, $id, $pass, $permission) or die("bind param");
						                if(mysqli_stmt_execute($stmt))
														{
															echo '<div class="alert alert-success" role="alert">Successfully Added Employee!</div>';
														}
														else
														{
															echo '<div class="alert alert-danger" role="alert">Could not Add Employee</div>';
														}
						                mysqli_close($stmt);
						                mysqli_close($link);
						        }
						?>
            </div>
    </body>
</html>

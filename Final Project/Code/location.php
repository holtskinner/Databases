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
<title>Add Location</title>
</head>

<body>

	<?php
		include_once("navbar.php");
	 ?>

    <div class="container">
        <br>
        <br>
        <div class="row">
					<?php
					        if(isset($_POST['submit']))
					        {
					            $link = mysqli_connect("localhost","guest_user","Phcn43","group_database") or die("Connect Error " . mysqli_error($link));
					            $name = $_POST['name'];
					            $q = "INSERT INTO location(name) VALUES(?)";

					            if($stmt = mysqli_prepare($link, $q))
					            {
					              mysqli_stmt_bind_param($stmt, "s", $name);
					              if(mysqli_stmt_execute($stmt))
												{
													?>
												<div class="alert alert-success">Location Added</div>
												<?php
												}
					            }
					            else
											{
												?>
											<div class="alert alert-danger">Could not add Location</div>
											<?php
					            }
											mysqli_close($stmt);
											mysqli_close($link);
					        }
					?>
           <h1 align="center">Add New Location</h1>
            <form action="location.php" method="POST" class="col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="input-group">
                        <div class='form-group'>
                            <label class='inputdefault'>Location Name</label>
                            <input class='form-control' type='text' name='name' placeholder="Name" value=''>
                        </div>
                    </div>
                    <input class=" btn btn-info" style="margin-top: 10px" type="submit" name="submit" value="Add Location">
                </div>
							</form>
          </div>
      </div>
</body>
</html>

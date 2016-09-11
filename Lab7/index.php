<!DOCTYPE html>
<?php
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}
?>
    <html>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-3"></div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <h2>Create a user</h2>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <div class="row form-group">
                            <input class='form-control' type="text" name="username" placeholder="username">
                        </div>
                        <div class="row form-group">
                            <input class='form-control' type="password" name="password" placeholder="password">
                        </div>
                        <div class="row form-group">
                            <input class=" btn btn-info" type="submit" name="submit" value="Register" />
                            <button class="btn btn-warning" type="button" name="login" value="Login" onclick="location.href='login.php'">Go to Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
				if(isset($_POST['submit'])) { // Was the form submitted?
					
					$link = mysqli_connect("localhost", "root", "", "lab7") or die ("Connection Error " . mysqli_error($link));
					$sql = "INSERT INTO user(username,salt,hashed_password) VALUES (?,?,?)";
					if ($stmt = mysqli_prepare($link, $sql)) 
                    {
						$user = $_POST['username'];
						$salt = mt_rand();
						$hpass = password_hash($_POST['password'], PASSWORD_BCRYPT)  or die("bind param");
                        
						mysqli_stmt_bind_param($stmt, "sss", $user, $salt, $hpass) or die("bind param");
                        
						if(mysqli_stmt_execute($stmt)) 
                        {
							echo "<h4>Success</h4>";
						}
                        
                        else 
                        {
							echo "<h4>Failed</h4>";
						}
                        
						$result = mysqli_stmt_get_result($stmt);
					}
                    
                    else 
                    {
						die("prepare failed");
					}
				}
			?>
        </div>
    </body>

    </html>
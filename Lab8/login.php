<!DOCTYPE html>

<?php
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
		 $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		 header('Location: ' . $url);
			//exit;
	}
session_start();
?>
		<html>
		<head>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://bootflat.github.io/bootflat/css/bootflat.css">
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		</head>
		<body>
				<div class="container">
						<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-3"></div>
								<div class="col-md-4 col-sm-4 col-xs-6">
				<?php
				if(isset($_POST['submit']))
				{ // Was the form submitted?

										$link = mysqli_connect("localhost", "root", "", "lab8") or die ("Connection Error " . mysqli_error($link));
					$sql = "SELECT * from user WHERE username = ?";
					if ($stmt = mysqli_prepare($link, $sql))
										{
												$user = $_POST['username'];
												$pass = $_POST['password'];

												mysqli_stmt_bind_param($stmt, "s", htmlspecialchars($user)) or die("Bind Param Error");
												mysqli_stmt_execute($stmt) or die("Execute Error");
												$result = mysqli_stmt_get_result($stmt);
												$input = mysqli_fetch_assoc($result);
												mysqli_close($link);

												$salt = $input['salt'];
												$hpass= $input['hashed_password'];
												$isadmin = $input['isadmin'];

												if(password_verify($salt.$pass, $hpass))//If username and hashed passwords match
												{
														$_SESSION['username'] = $user;
														$_SESSION['isadmin'] = $isadmin;
														if($isadmin == 0)
														echo "<h4> Welcome $user!</h4>";
														else
														echo "<h4> Welcome Admin! You have super privileges.</h4>";
														?>
												<button class="btn btn-primary" type="button" name="logout" value="logout" onclick="location.href='logout.php'">Logout</button>
												<?php
														exit;
												}
												else
												{
							echo "<h4>Failed! Incorrect Username or Password.</h4>";
						}
					}
										else
										{
											die("Prepare failed");
										}
				}

			?>
														<h2>Login</h2>
														<form action="login.php" method="POST">
																<div class="row form-group">
																		<input class='form-control' type="text" name="username" placeholder="username">
																</div>
																<div class="row form-group">
																		<input class='form-control' type="password" name="password" placeholder="password">
																</div>
																<div class="row form-group">
																		<input class=" btn btn-info" type="submit" name="submit" value="Login" />
																</div>
														</form>
								</div>
						</div>
				</div>
		</body>
		</html>

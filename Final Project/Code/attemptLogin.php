<?php
        session_start();
	$mysqli = new mysqli("localhost", "guest_user", "Phcn43", "group_database");
	$username = "";
        $hashed_password = "";
        if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        //pull password
        if (!($check = $mysqli->prepare("SELECT hashed_password, username, permission_id, name_first, name_last, employee_id, email FROM employee WHERE username = ?"))) {
                echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!$check->bind_param('s', $username)) {
                echo "Binding Failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (isset($_POST['submit'])){

                $username = $_POST['username'];
                $password = $_POST['password'];
                if ($username == ""){
                        echo "You must enter a username";
                }
                elseif ($username != htmlspecialchars($username)) {
                        echo "You have entered an invaid username";
                }
                elseif ($password == "") {
                        echo "You must enter a password";
                }
                elseif ($password != htmlspecialchars($password)) {
                        echo "You have entered an invalid password";
                }
                else {
                        $username = htmlspecialchars($username);
                        $password = htmlspecialchars($password);
                        if (!$check->execute()) {
                                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                        }

                        $check->bind_result($hashed_password, $permission_id, $name_first, $name_last, $employee_id, $email); //get info from select statements
                        $check->fetch(); //fetch results
                        if($hashed_password == "") { //user does not exist case
                                echo "User not Found";
                        }
                        elseif(password_verify($password, $hashed_password)) { //set session variables if password is correct
                                $_SESSION["username"] = $username;
                                $_SESSION["permission_id"] = $permission_id;
				$_SESSION["name_first"] = $name_first;
				$_SESSION["name_last"] = $name_last;
				$_SESSION["employee_id"] = $employee_id;
				$_SESSION["email"] = $email; //honestly have no idea what we need their email for... but it is there anyways
				$check->close(); //close prepared statement
				$mysqli->close(); //close link to database
                                header("Location: https://cs3380-jdhcp3.centralus.cloudapp.azure.com/project/index.php"); //send user back to index page
                        }
                        else{
                                echo "Incorrect Password";
                        }
                }
		$check->close();
        }
	$mysqli->close();
?>
<html>
	<head>
        	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/css/bootstrap-theme.min.css"></script>
        	<title>Login</title>
    	</head>
        <body>
                <div class="container">
			<br><br>
                        <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-3"></div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                        <h2 class="col-md-4 col-md-offset-4">Log In</h2>
					<!-- If login is succsessful, page will redirect to index, otherwise it will be a copy of this page with an error message--!>
                                        <form action="/project/attemptLogin.php" method="POST" class="col-md-4 col-md-offset-4">
                                        	<div class="row">
                        				<div class="input-group">
                  				        	<div class="form-group">
    				                            		<label class="inputdefault">Username</label>
                        				    		<input class="form-control" type="text"  name="username" placeholder="username">
                       				     		</div>
                   				        	<div class="form-group">
                                					<label class="inputdefault">Password</label>
                                					<input class="form-control" type="password" name="password" placeholder="password">
                            					</div>
                            					<div class="form-group">
                                					<input class="btn btn-primary" type="submit" name="submit" value="Log In">
                            					</div>
                        				</div>
                    				</div>
                			</form>
            			</div>
        		</div>
    		</div>
	</body>
</html

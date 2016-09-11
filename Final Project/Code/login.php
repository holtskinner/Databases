<?php
        session_start();
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
					<!-- Will send user to a attemptLogin page. 
					If login is succsessful, page will redirect to index, otherwise it will be a copy of this page with an error message--!>
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

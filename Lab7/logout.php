<!DOCTYPE html>

<?php
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}


    $_POST = array();//Empties POST array
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
                    <h2>You have logged out</h2>
                    <button class="btn btn-primary" type="button" name="index" value="index" onclick="location.href='index.php'">Go to Index</button>
                </div>
            </div>
        </div>
    </body>

    </html>
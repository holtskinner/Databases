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

    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <title>Mizzou Student Union</title>
    </head>
    <body>
	<?php
		include_once("navbar.php");
	?>
	<div class="container">
                        <br><br>
                        <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-3"></div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                        <form action="/project/barcode.php" method="POST" class="col-md-4 col-md-offset-4">
                                                <div class="row">
                                                        <div class="input-group">
                                                                <div class="form-group">
                                                                        <label class="inputdefault">Barcode</label>
                                                                        <input class="form-control" type="text"  name="barcode" placeholder="enter barcode">
                                                                </div>
                                                                <div class="form-group">
                                                                        <input class="btn btn-primary" type="submit" name="submit" value="Generate Barcode">
                                                                </div>
                                                        </div>
                                                </div>
                                        </form>
                                </div>
                        </div>
                </div>

    </body>
</html>

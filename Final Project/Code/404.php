<?php
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
		 $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		 header('Location: ' . $url);
	}
session_start();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
			<meta charset="utf-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <title>404 Error</title>
<style>
  .glyphicon-alert {
    font-size: 300pt;
    margin: 30px;
  }
</style>

    </head>
    <body>
<?php
	include_once("navbar.php");
 ?>
    <div class="container">
      <div class="row text-center">

          <h1>Whoops! That page doesn't exist.</h1>
            <h1><span class="glyphicon glyphicon-alert"></span></h1>
        </div>

    </div>
    </body>
		<?php include("mitlicense.php"); ?>
    </html>

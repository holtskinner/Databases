<!DOCTYPE html>
<?php
	session_start();

	if(!isset($_SESSION['username'])){
		header("Location: login2.php");
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
							<?php
							if ($_SESSION["permission_id"] == 'admin')
							{
								?>
							<div class="alert alert-info fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Welcome!</strong> You are an admin.
							</div>
							<?php
							}
							 ?>
                <div class="jumbotron">
                    <h1>Welcome to the Mizzou Student Union Desk Service!</h1>
                    <h3>Proof of Concept</h3>
                    <p>Made by Team Awesome, Inc.</p>
                </div>
            </div>
    </body>
<?php include("mitlicense.php"); ?>
    </html>

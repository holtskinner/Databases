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
<html>

<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<title>Edit Inventory</title>
</head>
<?php

function printInput($key)
{
	echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input class='form-control' type='text' name='".$key."' value='".$_POST[$key]."'>";
	echo "</div>";
}
?>


    <body>
			<?php
				include_once("navbar.php");
			 ?>
      <div class="container">
<?php
          if(isset($_POST['delete']))
          {
            $link = mysqli_connect("localhost","guest_user","Phcn43","group_database") or die("Connect Error " . mysqli_error($link));

            $q = "DELETE FROM item WHERE id = ?";

            $stmt = mysqli_prepare($link, $q);
            mysqli_stmt_bind_param($stmt, "s", $_POST['id']);
						if(mysqli_stmt_execute($stmt))
						{
								?>
								<div class="alert alert-info" role="alert">Item <?php echo $_POST['id']; ?> Successfully Deleted</div>
								<?php
						}
						else {
							?>
							<div class="alert alert-danger" role="alert">Item <?php  echo $_POST['id']; ?> Could not be Deleted</div>
							<?php
						}
            mysqli_close($stmt);
            mysqli_close($link);

            exit;

          }
          if(isset($_POST['edit']))
          {
              $link = mysqli_connect("localhost","guest_user","Phcn43","group_database") or die("Connect Error " . mysqli_error($link));

              $s = "UPDATE item
								SET name = ?, category = ?, location = ?, item_condition = ?, notes = ?
								WHERE id = ? ";

              $stmt = mysqli_prepare($link, $s) or die("Prepare");

              mysqli_stmt_bind_param($stmt, "ssssss",  $_POST['name'], $_POST['category'], $_POST['location'], $_POST['condition'], $_POST['notes'], $_POST['id']) or die ("Bind Param");

							if(mysqli_stmt_execute($stmt))
							{
									?>
									<div class="alert alert-info" role="alert">Item <?php echo $_POST['id']; ?> Successfully Updated</div>
									<?php
							}
							else {
								?>
								<div class="alert alert-danger" role="alert">Item <?php  echo $_POST['id']; ?> Could not be Updated</div>
								<?php
							}
              mysqli_close($stmt);
              mysqli_close($link);

          }
              ?>
            <h1>Edit Inventory Item</h1>
            <form action="editinventory.php" method="post">
                <input type="hidden" name="table" value="edit">
                <?php
                printInput('id');
                printInput('name');
                printInput('category');
                printInput('location');
                printInput('item_condition');
                printInput('notes');
            ?>
                    <input type="submit" class="btn btn-info" name="edit" value="Edit">
            </form>

        </div>
    </body>

</html>

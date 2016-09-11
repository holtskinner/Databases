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
    <title>Add Inventory</title>
</head>
    <body>
			<?php
				include_once("navbar.php");
			 ?>
        <div class="container-fluid">
            <br>
            <br>
						<div class="row text-center">
						<?php

										if(isset($_POST['submit']))
										{
												if(!isset($_POST['name'])|| !isset($_POST['id']))
												{
													?>
													<div class="alert alert-danger">Could not add item.</div>
													<?php
												}
												$link = mysqli_connect("localhost","guest_user","Phcn43","group_database") or die("Connect Error " . mysqli_error($link));

												$id = $_POST['id'];
												$name = $_POST['name'];
												$category = $_POST['category'];
												$condition = $_POST['condition'];
												$location = $_POST['location'];
												$notes = $_POST['notes'];

												$q1 = "INSERT INTO item(id, name, category, location, notes, item_condition) VALUES(?, ?, ?, ?, ?, ?)";

												if(!($stmt = mysqli_prepare($link, $q1)))
												{
													?>
													<div class="alert alert-danger">Could not add item.</div>
													<?php
												}
												elseif(!(mysqli_stmt_bind_param($stmt, "ssssss", $id, $name, $category, $location, $notes, $condition)))
												{
													?>
													<div class="alert alert-danger">Could not add item.</div>
													<?php
												}
												elseif(mysqli_stmt_execute($stmt))
												{
													?>
													<div class="alert alert-success">Successfully added item.</div>
													<?php
												}
												else
												{
													?>
													<div class="alert alert-danger">Could not add item.</div>
													<?php
												}
										}
								?>
                <h1>Add New Item</h1>
                <form action="addinventory.php" method="POST" class="col-md-4 col-md-offset-5">

                        <div class="input-group">
                            <div class='form-group'>
                                <label class='inputdefault'>Barcode</label>
                                <input class='form-control' type='text' name='id' value=''>
                            </div>
                            <div class='form-group'>
                                <label class='inputdefault'>Item Name</label>
                                <input class='form-control' type='text' name='name' value=''>
                            </div>
                            <br>

                            <div class='form-group'>
                                <label class='inputdefault'>Category</label>
                                <select class="form-control" name='category'>
                                    <?php

                                $link = mysqli_connect("localhost","guest_user","Phcn43","group_database") or die("Connect Error " . mysqli_error($link));
                                $q6 = "SELECT name from item_category";
                                $result = mysqli_query($link, $q6) or die;
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                }

                                ?>

                                </select>
                            </div>

                            <div class='form-group'>
                                <label class='inputdefault'>Location</label>
                                <select class="form-control" name='location'>
                                <?php
                                $q7 = "SELECT name from location";
                                $result = mysqli_query($link, $q7) or die;
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                }

                                ?>

                                </select>
                            </div>
                            <div class='form-group'>
                                <label class='inputdefault'>Condition</label>
                                <select class="form-control" name='condition'>
                                <?php
                                $q8 = "SELECT name from item_condition";
                                $result = mysqli_query($link, $q8) or die;
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                }

                                ?>

                                </select>
                            </div>
                            <div class='form-group'>
                                <label class='inputdefault'>Notes</label>
                                <textarea class='form-control' rows="3" name='notes' value=''></textarea>
                            </div>
                        </div>
                        <input class="btn btn-info" type="submit" name="submit" style="margin-top:10px" value="Add Item">
                    </div>
                </form>
            </div>
        </div>
    </body>

</html>

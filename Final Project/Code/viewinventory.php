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
        <title>View Inventory</title>
    </head>

    <body>
        <?php
				include_once("navbar.php");
			 ?>
            <div class="container">
                <br>
                <div class="row align-center">
                    <h1>Inventory</h1>
                    <form action='viewinventory.php' method='POST'>
                        <label class="radio-inline">
                            <input type="radio" name="bike" value=""> Bikes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="pc" value=""> PCs
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="mac" value=""> Macs
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="charger" value=""> Chargers
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="all" value=""> All
                        </label>
                        <input class="btn btn-info" type="submit" name="search" value="Search">
                    </form>
                    <?php

                if (isset($_POST["search"]))
                {
                  $link = mysqli_connect("localhost","guest_user","Phcn43","group_database") or die("Connect Error " . mysqli_error($link));
                  if (isset($_POST["bike"]))
                  {
                      $q = "SELECT * FROM item WHERE category = 'bike'";
											$r = "SELECT * FROM item WHERE category = 'bike' AND ischeckedout = 0";
                  }
                  if (isset($_POST["pc"]))
                  {
                      $q = "SELECT * FROM item WHERE category = 'PC'";
											$r = "SELECT * FROM item WHERE category = 'PC' AND ischeckedout = 0";
                  }
                  if (isset($_POST["mac"]))
                  {
                      $q = "SELECT * FROM item WHERE category = 'Mac'";
											$r = "SELECT * FROM item WHERE category = 'Mac' AND ischeckedout = 0";
                  }
									if (isset($_POST["charger"]))
									{
											$q = "SELECT * FROM item WHERE category = 'Phone Charger'";
											$r = "SELECT * FROM item WHERE category = 'Phone Charger' AND ischeckedout = 0";
									}
									if (isset($_POST["all"]))
									{
											$q = "SELECT * FROM item";
											$r = "SELECT * FROM item WHERE ischeckedout = 0";
									}

                  $result = mysqli_query($link, $q);
                  echo '<h4>Total Number of Items: '. mysqli_num_rows($result) . '</h4>';
									$result2 = mysqli_query($link, $r);
									echo '<h4>Items in Stock: '. mysqli_num_rows($result2) . '</h4>';
                }

                ?>
                       <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <?php

	while ($fieldinfo=mysqli_fetch_field($result))
	{
		echo "<th>" .$fieldinfo->name."</th>";
	}
    ?>

                                </tr>
                            </thead>
                            <br>
                            <tbody>
                                <?php
	while($row = mysqli_fetch_assoc($result))
	{
		?>
                                    <form action='editinventory.php' method='POST'>
                                        <tr>
                                            <td>
                                                <input class="btn btn-info" type="submit" name="update" value="Update">
                                            </td>
                                            <td>
                                                <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                                            </td>
                                            <?php

              foreach($row as $k=>$field)
              {
                  echo '<td><input type="hidden" name="'.$k.'" value="'.$field.'">'. $field .'</td>';
              }
		echo '</tr>
      </form>';
	}
	echo '</tbody>';
	mysqli_close($link);
?>

                        </table>
                </div>
            </div>
    </body>
    <?php include("mitlicense.php"); ?>

    </html>
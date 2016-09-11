<!DOCTYPE html>
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
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <title>View Employees</title>
</head>
    <body>
      <?php
        include_once("navbar.php");
       ?>
          <div class="container">
            <br>
            <div class="row align-center">
                <h1>Employee</h1>
                <?php
                  $link = mysqli_connect("localhost","guest_user","Phcn43","group_database") or die("Connect Error " . mysqli_error($link));
                  $q = "SELECT employee_id, username, name_first, name_last, permission_id FROM employee";
                  $result = mysqli_query($link, $q);
                  echo '<h4>Total Number of Employees: '. mysqli_num_rows($result) . '</h4>';

                ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
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

</html>

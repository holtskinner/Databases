<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="container">
        <br>
        <br>
        <div class="row">
            <form action="/lab6/index.php" method="POST" class="col-md-4 col-md-offset-4">
                <div class="row">
                    <input class='col-md-10' type="text" name="userinput">
                    <input class=" btn btn-info col-md-2" type="submit" name="submit" value="Go" />
                </div>
                <div class="row">
                    <input checked="check" type="radio" name="radios" value=0>City
                    <input type="radio" name="radios" value=1>Country
                    <input type="radio" name="radios" value=2>Language
                </div>
            </form>
            <a href="insert.php" class="btn btn-primary">Insert into city</a>
        </div>
        <?php
       
  if(isset($_POST['userinput']))
  {
        $link = mysqli_connect("localhost","root","","lab6") or die("Connect Error " . mysqli_error($link));
        $name = $_POST['userinput'];
        $radio = $_POST['radios'];
        $name = "$name%";
        //echo $name;
       // echo $radio;
        
      switch($radio)
        {
            case 0:
                $stmt = mysqli_prepare($link, "SELECT * FROM City WHERE LOWER(Name) LIKE LOWER(?)  ORDER BY Name ASC");
              //$stmt = mysqli_prepare($link, "SELECT * FROM City WHERE Name LIKE 'C%'");
                break;
            case 1:
                $stmt = mysqli_prepare($link, "SELECT * FROM Country WHERE LOWER(Name) LIKE LOWER(?) ORDER BY Name ASC");
              //$stmt = mysqli_prepare($link, "SELECT * FROM Country");
                break;
            case 2:
                $stmt = mysqli_prepare($link, "SELECT * FROM CountryLanguage WHERE LOWER(Language) LIKE LOWER(?) ORDER BY Language ASC");             
                break;
        }
                
        
        
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", htmlspecialchars($name)) or die("bind param");
            mysqli_stmt_execute($stmt) or die("execute");
            $result = mysqli_stmt_get_result($stmt) or die("Query Error: " . mysqli_error($link));
            echo '<h4>Number of rows: '. mysqli_num_rows($result) . '</h4>';
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
		  echo '<th>' . $fieldinfo->name . '</th>';
	   }
        
        echo"</tr>
            </thead>";

      
      while($row = mysqli_fetch_assoc($result))
      {
         echo "<form action='edit.php' method='POST'>";
 
          
          switch($radio)
          {
              case 0:
                echo "<input type='hidden' name='table' value='City'>";
                break;
              case 1:
                echo "<input type='hidden' name='table' value='Country'>";
                break;
              case 2:
                echo "<input type='hidden' name='table' value='CountryLanguage'>";
                break;
          }
          ?>

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
		  echo "</tr>
            </form>";
          mysqli_close($link);
      }
      
  }//End if
      ?>


            </table>
    </div>
</body>

</html>
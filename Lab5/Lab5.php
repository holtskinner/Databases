<!DOCTYPE html>
<html>

<head>
    <!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Optional theme -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
</head>

<body>
    <div class="container">
        <br>
        <br>
        <div class="row">
            <form action="/lab5/index.php" method="POST" class="col-md-4 col-md-offset-5">
                <select name="dropDown">
                    <option value='1'>Query 1</option>
                    <option value='2'>Query 2</option>
                    <option value='3'>Query 3</option>
                    <option value='4'>Query 4</option>
                    <option value='5'>Query 5</option>
                    <option value='6'>Query 6</option>
                    <option value='7'>Query 7</option>
                    <option value='8'>Query 8</option>
                </select>
                <input type="submit" name="submit" value="Go" />
            </form>
        </div>
        <table>

            <?php
                
  if(isset($_POST['dropDown']))
  {
      $link = mysqli_connect("localhost","root","","lab5") or die("Connect Error " . mysqli_error($link));
      
       
/*    CREATE VIEW weight AS
      SELECT person.pid, person.fname, person.lname, body_composition.weight
      FROM person
      INNER JOIN body_composition
      ON body_composition.pid = person.pid
      WHERE body_composition.weight >140; */
      
      $q1 = "SELECT * FROM weight;";
          
      
/*      CREATE VIEW BMI AS
      SELECT weight.fname, weight.lname, 703*(weight.weight/ POWER(body_composition.height, 2)) AS BMI
      FROM weight
      INNER JOIN body_composition
      ON body_composition.pid = weight.pid
      WHERE weight.weight >150; */
      
      $q2 = "SELECT * FROM BMI;";
      
      $q3 = "SELECT university_name, city FROM university AS u
      WHERE NOT EXISTS(
      SELECT person.uid
      FROM person
      WHERE person.uid = u.uid);";

      $q4 = "SELECT fname, lname FROM person
      WHERE uid IN(
        SELECT university.uid
        FROM university
        WHERE university.city = 'Columbia');";
      
      $q5 = "SELECT * FROM activity
      WHERE activity_name NOT IN(
      SELECT activity_name FROM participated_in
      );";
      
      $q6 = "SELECT pid FROM participated_in
      WHERE activity_name = 'running'
      UNION SELECT pid FROM participated_in
      WHERE activity_name = 'racquetball';";
      
      $q7 = "SELECT fname, lname FROM person
      WHERE pid IN(
      SELECT pid from body_composition
      WHERE body_composition.age >30 and
      body_composition.height > 65
      );";
      
      $q8 = "SELECT fname, lname, weight, height, age FROM person
      LEFT JOIN body_composition
      ON body_composition.pid = person.pid
      ORDER BY body_composition.height DESC,
      body_composition.weight ASC,
      person.lname ASC;";
      
      $queries = array($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8);
      $selection = $_POST['dropDown'];
      $result = mysqli_query($link, $queries[$selection-1]) or die("Query Error: " . mysqli_error($link));
	
	   echo '<thead>';
	   echo '<tr>';
      
	   while ($fieldinfo=mysqli_fetch_field($result))
	   {
		  echo "<th>" .$fieldinfo->name."</th>";
	   }
	   
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';    
      
      while($row = mysqli_fetch_assoc($result))
      {
          echo '<tr>';
		
		  foreach($row as $column)
		  {
                echo '<td>'. $column . '</td>';
		  }
		  echo '</tr>';
      }
      echo '</tbody>';
      
	mysqli_close($link);
  }//End if
?>
        </table>
    </div>
</body>

</html>
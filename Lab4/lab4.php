<!DOCTYPE>
<html>
	<head>
		<!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
		<div class="container">
			<br>
			<br>
			<div class="row">
				<!-- 
					This form will submit a 'method' request
					the request is sent to 'action'
					In this case 'method' = POST and 'action' = this_php_script
				 -->
				<form action="/lab4/index.php" method="POST" class="col-md-4 col-md-offset-5">
					<select name="dropDown">
					<option value='1'>Query 1</option><option value='2'>Query 2</option><option value='3'>Query 3</option><option value='4'>Query 4</option><option value='5'>Query 5</option><option value='6'>Query 6</option><option value='7'>Query 7</option><option value='8'>Query 8</option><option value='9'>Query 9</option><option value='10'>Query 10</option><option value='11'>Query 11</option>					</select>
					<input type="submit" name="submit" value="Go"/>
				</form>
			</div>
			<table>
	           
<?php
  if(isset($_POST['dropDown']))
  {

      
      //Connect to mySQL
        $link = mysqli_connect("localhost","root","","world") or die("Connect Error " . mysqli_error($link));

        

        //Query 1
        $q1 = "SELECT District, Population 
            FROM City 
            WHERE Name = 'Springfield' 
            ORDER BY Population DESC";
        
        $q2 = "SELECT Name, District, Population       FROM City
            WHERE CountryCode = 'BRA'
            ORDER BY Name ASC";
            
        $q3 = "SELECT Name, Continent, GovernmentForm 
            FROM Country
            ORDER BY SurfaceArea ASC
            LIMIT 20";    
   
        $q4 = "SELECT Name, Continent, GovernmentForm, GNP 
        FROM Country 
        WHERE GNP > 200000
        ORDER BY Name ASC";
            
        $q5 = "SELECT Name, LifeExpectancy
        FROM Country 
        WHERE LifeExpectancy IS NOT NULL
        ORDER BY LifeExpectancy DESC
        LIMIT 10 OFFSET 10";
            
        $q6 = "SELECT Name
        FROM City 
        WHERE Name LIKE 'B%s'
        ORDER BY Population DESC";           
            
        $q7 = "SELECT City.Name, City.Population, Country.Name 
        FROM City
        INNER JOIN Country
        ON City.CountryCode = Country.Code
        WHERE City.Population > 6000000
        ORDER BY City.Population DESC";

        $q8 = "SELECT Country.Name, Country.IndepYear, Country.Region 
        FROM Country
        INNER JOIN CountryLanguage
        ON Country.Code = CountryLanguage.CountryCode
        WHERE CountryLanguage.Language = 'English' AND
        CountryLanguage.IsOfficial = 1
        ORDER BY Country.Region ASC, 
            Country.Name ASC";    

        $q9 = "SELECT City.Name, City.Population, (City.Population/Country.Population)*100 AS 'Percentage'
        FROM Country
        INNER JOIN City
        ON City.CountryCode = Country.Code
        WHERE Country.Capital = City.ID
        ORDER BY City.Population DESC";

        $q10 = "SELECT CountryLanguage.Language, Country.Name, CountryLanguage.Percentage, (CountryLanguage.Percentage*Country.Population)/100 AS 'PercentageSpeakers'
        FROM CountryLanguage
        INNER JOIN Country
        ON Country.Code = CountryLanguage.CountryCode
        WHERE CountryLanguage.IsOfficial = 1
        ORDER BY PercentageSpeakers DESC";

        $q11 = "SELECT Name, Region, GNP, GNPOld, (GNP-GNPOld)/GNPOld AS 'GNPChange' 
        FROM Country  
        WHERE GNP IS NOT NULL AND
        GNPOld IS NOT NULL
        ORDER BY GNPChange DESC";

        $queries = array($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11);
      
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




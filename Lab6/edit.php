<?php

//connect to db
$link = mysqli_connect("localhost", "root","", "lab6") or die ("Connection Error " . mysqli_error($link));

//display non-editable textbox for attribute $key
function printNonEditable($key) 
{
	echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input class='form-control' type='text' name='".$key."' value='".$_POST[$key]."' readonly>";
	echo "</div>";
}

//display editable textbox for attribute $key
function printInput($key)
{
	echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input class='form-control' type='text' name='".$key."' value='".$_POST[$key]."' required>";
	echo "</div>";
}

//display editable textbox for numeric attribute $key
function printNumeric($key) {
	echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input class='form-control' type='number' name='".$key."' value='".$_POST[$key]."' required>";
	echo "</div>";
}

function printRadio($key)
{
    echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input checked = 'check' type='radio' name='".$key."' value='".$_POST[$key]."' required>";
    echo "T";
    echo "<input checked = 'check' type='radio' name='".$key."' value='".!$_POST[$key]."' required>";
    echo "F";
	echo "</div>";
}

//editable form for records from the city table
function displayCity() 
{
	echo "<h2>Edit City Record</h2>";
    echo "<form action='edit.php' method='POST' >";
	echo "<input type='hidden' name='table' value='City'>";
	printNonEditable('ID');
	printNonEditable('Name');
	printNonEditable('CountryCode');
	printInput('District');
	printNumeric('Population');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function saveCity() 
{
	global $link;
	$sql = "UPDATE City SET District=?, Population=? WHERE ID=?";
	if ($stmt = mysqli_prepare($link, $sql)) //prepare successful
    {
		mysqli_stmt_bind_param($stmt, "sss", htmlspecialchars($_POST['District']), htmlspecialchars($_POST['Population']), htmlspecialchars($_POST['ID'])) or die("bind param");
		if(mysqli_stmt_execute($stmt)) //execute successful
        {
			success();
		} else 
        { 
			fail(); 
		}
	} 
    else //prepare failed
    { 
		fail(); 
	}
}

//editable form for records from the Country table
function displayCountry() 
{
	echo "<h2>Edit Country Record</h2>";
    echo "<form action='edit.php' method='POST' >";
	echo "<input type='hidden' name='table' value='Country'>";
	printNonEditable('Code');
	printNonEditable('Name');
	printNonEditable('Continent');
    printNonEditable('Region');
    printNonEditable('SurfaceArea');
    printNumeric('IndepYear');
	printNumeric('Population');
    printNonEditable('LifeExpectancy');
    printNonEditable('GNP');
    printNonEditable('GNPOld');
    printInput('LocalName');
    printInput('GovernmentForm');
    printNonEditable('HeadOfState');
    printNonEditable('Capital');
    printNonEditable('Code2');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function saveCountry() 
{
	global $link;
	$sql = "UPDATE Country SET IndepYear=?, Population=?, LocalName=?, GovernmentForm=? WHERE Code=?";
	if ($stmt = mysqli_prepare($link, $sql)) //prepare successful
    {
		mysqli_stmt_bind_param($stmt, "sssss", htmlspecialchars($_POST['IndepYear']), 
        htmlspecialchars($_POST['Population']), htmlspecialchars($_POST['LocalName']), 
        htmlspecialchars($_POST['GovernmentForm']), htmlspecialchars($_POST['Code'])) or die("bind param");
        
		if(mysqli_stmt_execute($stmt)) //execute successful
        {
			success();
		} 
        else 
        { 
			fail(); 
		}
	} 
    else //prepare failed
    { 
		fail(); 
	}
}

//editable form for records from the Country table
function displayLanguage()
{
	echo "<h2>Edit Language Record</h2>";
    echo "<form action='edit.php' method='POST' >";
	echo "<input type='hidden' name='table' value='CountryLanguage'>";
	printNonEditable('CountryCode');
	printNonEditable('Language');
    printRadio('IsOfficial');
    printNumeric('Percentage');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function saveLanguage() 
{
	global $link;
	$sql = "UPDATE CountryLanguage SET IsOfficial=?, Percentage=? WHERE Language=? AND CountryCode=?";
	if ($stmt = mysqli_prepare($link, $sql)) //prepare successful
    {
		mysqli_stmt_bind_param($stmt, "ssss", htmlspecialchars($_POST['IsOfficial']), 
        htmlspecialchars($_POST['Percentage']), htmlspecialchars($_POST['Language']), 
        htmlspecialchars($_POST['CountryCode'])) or die("bind param");
		if(mysqli_stmt_execute($stmt)) //execute successful
        {
			success();
		} 
        else 
        { 
			fail(); 
		}
	} 
    else //prepare failed
    { 
		fail(); 
	}
}

function delete()
{
    global $link;
    
    switch($_POST['table'])//Which table
    {
        case "City":
                $sql = "DELETE FROM City WHERE ID =? LIMIT 1";
                $stmt = mysqli_prepare($link, $sql) or die ("Query Error " . mysqli_error($link));
                mysqli_stmt_bind_param($stmt, 'i', htmlspecialchars($_POST['ID'])) or die ("Bind Error ");
            break;
            
        case "Country":
                $sql = "DELETE FROM Country WHERE Code = ? LIMIT 1";
                $stmt = mysqli_prepare($link, $sql) or die ("Query Error " . mysqli_error($link));
                mysqli_stmt_bind_param($stmt, 's', htmlspecialchars($_POST['Code'])) or die ("Bind Error ");
            break;
            
        case "CountryLanguage":
                $sql = "DELETE FROM CountryLanguage WHERE CountryCode = ? AND Language = ? LIMIT 1";
                $stmt = mysqli_prepare($link, $sql) or die ("Query Error " . mysqli_error($link));
                mysqli_stmt_bind_param($stmt, 'ss', htmlspecialchars($_POST['CountryCode']), 
                htmlspecialchars($_POST['Language'])) or die ("Bind Error ");
            break;
    }
    if(!$stmt)
    {
        fail();
    }
	if(mysqli_stmt_execute($stmt)) //execute successful
    {
        success();
    } 
    else 
    { 
        fail(); 
	}
}

//no table was provided, display error message
function fail() 
{
	mysqli_close($link);
    header("Location: fail.php");
}

function success()
{
    mysqli_close($link);
    header("Location: success.php");
}

?>

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
            <?php
	
if(isset($_POST['table']))
{
   if(isset($_POST['delete']))
    {
        delete();
    }
    else//Update or save
    {
        
        switch($_POST['table'])//what table are we updating
        {
            case "City":
				displayCity();
                if(isset($_POST['save']))
                    saveCity();
			break;
                
            case "Country":
                displayCountry();
                if(isset($_POST['save']))
                    saveCountry();
            break;
                
            case "CountryLanguage":
                displayLanguage();
                if(isset($_POST['save']))
                    saveLanguage();
            break;
                
            default:
					fail();
            break;
		}//End switch
        
    }
}
else//If we don't know table data
{
    fail();
}
?>
        </div>
    </body>

    </html>
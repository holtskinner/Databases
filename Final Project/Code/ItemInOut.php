<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: login2.php");
    }

    if(!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS'])
    {
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
        <title>Item Checkout/Checkin</title>

        <script>

        function r(){
           document.ItemInOut.action = "attemptRenew.php";
           document.ItemInOut.submit();
           return true;
       }
            function CheckOut(){
                document.ItemInOut.action = "attemptOut.php";
                document.ItemInOut.submit();
                return true;
            }

            function CheckIn(){
                document.ItemInOut.action = "CheckIn.php";
                document.ItemInOut.submit();
                return true;
            }

            function toggleAutoSwitch(){
		            document.ItemInOut.action = "toggleAutoSwitch.php"; //changes session variable for autoswitching.
		              document.ItemInOut.submit();
		                return true;
            }
        </script>
    </head>
    <body>
      <?php
include_once("navbar.php");
?>
        <div class="container-fluid">
            <br>
            <br>
            <div class="row text-center">
                <h1>Item CheckIn/CheckOut</h1>
                <form name="ItemInOut" method="post" class="col-md-4 col-md-offset-5">
                    <div class="row">
                        <div class="input-group">
			    <div class="form-group">
				<input class="btn btn-primary" name"Toggle" value="Auto-Switch" onclick="return toggleAutoSwitch();">
			    </div>
                            <div class="form-group">
                                <label class="inputdefault">Student Id</label>
                                <input class="form-control" type="password"  name="Id" id="Id" value="">
                            </div>
                            <div class="form-group">
                                <label class="inputdefault">Item BarCode</label>
                                <input class="form-control" type="text" name="Item" id="Item" value="">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" type="button"name="Out" onclick="CheckOut()">Check Out</button>
                                <button class="btn btn-success" type="button" name="In" onclick="CheckIn()">Check In</button>
                                <button class="btn btn-warning" type="button" name="Renew" onclick="r()">Renew Item</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <?php
                    if(isset($_GET['result']))
                    {
                        $results = $_GET['result'];
                        switch($results){
                            case 0:
                                echo "<div class='alert alert-warning' role='alert'>Item does not exist in inventory.</div>";
                                break;
                            case 1:
                                echo "<div class='alert alert-warning' role='alert'>Item is already checked out.</div>";
                                break;
                            case 2:
                                echo "<div class='alert alert-success' role='alert'>Item successfully checked out.</div>";
                                break;
                            case 3:
                                echo "<div class='alert alert-warning' role='alert'>Item is not checked out.</div>";
                                break;
                            case 4:
                                echo "<div class='alert alert-success' role='alert'>Item successfully checked in.</div>";
                                break;
                            case 5:
                                echo "<div class='alert alert-warning' role='alert'>Please enter an item barcode number.</div>";
                                break;
                            case 6:
                                echo "<div class='alert alert-warning' role='alert'>Please enter a student id number.</div>";
                                break;
                            case 7:
                                echo "<div class='alert alert-danger' role='alert'>Student needs to fill out waiver.</div>";
                                break;
                            case 8:
                                echo "<div class='alert alert-info' role='alert'>Item check in canceled.</div>";
				break;
			    case 9:
				echo "<div class='alert alert-success' role='alert'>Item successfully renewed.</div>";
                        }
                    }
                ?>
            </div>
        </div>
	<script>
		//Javascript to automatically switch between fields after id is scanned
		var setElement = document.getElementById("Id"); //debug note: Element must have id attribute for getElementById to function.
		setElement.focus(); //field will be in focus after page load to remove clicks from workflow
		var currentValue = setElement.value;
		<?php
			if($_SESSION["Auto-Switch"]){
				//Enable auto switching. 500 is number of miliseconds between checks. Can be altered if client experiences problems with speed.
				echo "var interval = window.setInterval(ifChanged, 500);";
			}
		?>
		/**
		* Function to automatically switch between fields. Origionally called by:
		* 	var interval = window.setInterval(ifChanged, 500);
		* Documentation claims that window. and document. prefixes can be removed, but attempts to do this during testing resulted in errors.
		* If Element is refered to an id other than "Item", please change "Item" in document.getElementById("Item").focus(); to new id.
		* This goes for previous usage of funcition a well
		*
		* @author Justin H.
		*/
		function ifChanged(){
			if(setElement.value != currentValue){
				currentValue = setElement.value;
				document.getElementById("Item").focus();
			}
		}
	</script>
    </body>
</html>

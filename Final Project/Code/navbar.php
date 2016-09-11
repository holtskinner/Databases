<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Mizzou Desk Service</a>
        </div>
        <div class="collapse navbar-collapse" id = "Navbar">
            <ul class="nav navbar-nav">
                <li><a href="ItemInOut.php">Check In/Out Item</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Inventory
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="addinventory.php">Add New Item</a></li>
                        <li><a href="viewinventory.php">View Inventory</a></li>
                    </ul>
                </li>
                <?php

                  if ($_SESSION["permission_id"] == 'admin') //Only display these menu options if admin
                  {
                    ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Add New Data<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="location.php">Add New Location</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Student Data<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="student.php">Add New Student</a></li>
                            <li><a href="viewstudent.php">View Student Data</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Employee Data<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="employee.php">Add New Employee</a></li>
                            <li><a href="viewemployee.php">View Employee Data</a></li>
                        </ul>
                    </li>
                    <li><a href="getBarcode.php">Create Barcode</a></li>


                <?php
                  }

                 ?>
                                 </ul>
                 <ul class="nav navbar-nav navbar-right">
                     <li><a href="login2.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                     <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                 </ul>
        </div>
</nav>

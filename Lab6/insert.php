<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <br>
        <br>
        <div class="row">
            <form action="/lab6/insert.php" method="POST" class="col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="input-group">
                        <div class='form-group'>
                            <label class='inputdefault'>Name</label>
                            <input class='form-control' type='text' name='Name' value=''>
                        </div>
                        <div class='form-group'>
                            <label class='inputdefault'>District</label>
                            <input class='form-control' type='text' name='District' value=''>
                        </div>
                        <div class='form-group'>
                            <label class='inputdefault'>Population</label>
                            <input class='form-control' type='text' name='Population' value=''>
                        </div>
                        <div class='form-group'>
                            <label class='inputdefault'>CountryCode</label>
                            <select name='CountryCode'>

                                <?php
                                
   $link = mysqli_connect("localhost","root","","lab6") or die("Connect Error " . mysqli_error($link));
    $q = "SELECT Code, Name FROM Country";                           
    $result = mysqli_query($link, $q) or die("Query Error: " . mysqli_error($link));
                                
    while($row = mysqli_fetch_assoc($result))
    {
        echo '<option value="'.$row["Code"].'">'.$row["Name"].'</option>';
                                    
    }
                                
        if(isset($_POST['Name']))
        {
            $name = $_POST['Name'];
            $dist = $_POST['District'];
            $pop = $_POST['Population'];
            $code = $_POST['CountryCode'];
            
            $q = "INSERT INTO City (Name, District, Population, CountryCode) VALUES (?, ?, ?, ?)";
            
            if($stmt = mysqli_prepare($link, $q))
            {
                mysqli_stmt_bind_param($stmt, "ssss", htmlspecialchars($name), htmlspecialchars($dist), htmlspecialchars($pop), htmlspecialchars($code)) or die("bind param");
                mysqli_stmt_execute($stmt);    
                header("Location: success.php");
                mysqli_close($link);
                
            }
            mysqli_close($link);
            header("Location: fail.php");
        }
?>

                            </select>
                        </div>
                        <input class=" btn btn-info" type="submit" name="submit" value="Go">
                    </div>
                </div>
            </form>
            <a href="index.php" class="btn btn-primary">Back to index</a>
        </div>


    </div>
</body>

</html>
<?php
    $workingDays=4;
    $startingDate=date_create("2020-02-05");
    $endingDate=$startingDate;
    //date_add($startingDate,date_interval_create_from_date_string("1 day"));
    
    echo date_format($startingDate,"Y-m-d")."<br>"; 


    echo date_format($endingDate,"Y-m-d")."<br>"; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Choose Your Account Login Page</title>
</head>
<body>
    <form action="adminPanelLogin.php" method="post">

        <input type="submit" value="ADMIN" name="adminRole">

    </form>

    <form action="userPanelLogin.php" method="post">

        <input type="submit" value="USER" name="userRole">

    </form>

</body>
</html>
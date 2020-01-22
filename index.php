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

    <br>

    <form action="userPanelLogin.php" method="post">

        <input type="submit" value="USER" name="userRole">

    </form>

</body>
</html>

<?php
        //This will remove any unused free day from last year if month July started.
        $currentYear=date("Y");
        $currentMonth=date("n");    
    
        if($currentMonth>6)
        {
            $conn = new mysqli("localhost", "root", "", "companyannualleave");
            $sql = "UPDATE employees SET employeeFreeDays=20 WHERE employeeFreeDays > 20";
            $result = $conn->query($sql);
            //echo "Unused free days from last year was lost!<br>";
        }

?>
<?php
        $adminUsername=$_POST['ausername'];
        $adminPassword=$_POST['apassword'];

        if(empty($adminUsername) || empty($adminPassword))
            echo "<h1>You have to insert both username and password!</h1>";
           
        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM admins WHERE adminUsername='$adminUsername' AND adminPassword='$adminPassword'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach($rows as $firstrow)
            $row = $firstrow;

        if(($row['adminUsername']==$adminUsername) && ($row['adminPassword']==$adminPassword))   
            echo "Welcome back ".$row['adminName']." ".$row['adminSurname']."!<br>";
        else
            header("location:adminPanelLogin.php");
        
        $conn2=new mysqli("localhost","root","","companyannualleave");
        $sql2= "SELECT * FROM employees WHERE employeeAnnualRequest = true";
        $result2= $conn2->query($sql2);
        $rows2 = $result2->fetch_all(MYSQLI_ASSOC);

        echo "<br>This is a list of employees who sent Annual Request: <br><br>";
        foreach($rows2 as $row2)
        {
            echo $row2['employeeName']." ".$row2['employeeSurname']." [".$row2['employeePosition']."]<br>";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN SCREEN</title>
</head>
<body>
        <br><br><br>
        <?php
        echo "<a href='adminPanelControl.php'>CONTROL PANEL</a><br>";
        echo "<a href='adminPanelAdd.php'>ADD NEW EMPLOYEE</a><br>";
        echo "<a href='adminPanelList.php'>LIST ALL EMPLOYEES</a><br>";
        echo "<a href='adminPanelDelete.php'>REMOVE EMPLOYEE</a><br><br>";
        ?>   
</body>
</html>
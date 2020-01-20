<?php
    if(isset($_POST['adminLogin']))
    {
        $adminUsername=$_POST['ausername'];
        $adminPassword=$_POST['apassword'];

        if(empty($adminUsername) || empty($adminPassword))
            echo "<h1>You have to insert both username and password!</h1>";
           
        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM admins WHERE adminUsername='$adminUsername' AND adminPassword='$adminPassword'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach($rows as $row)
            echo "Welcome back ".$row['adminName']." ".$row['adminSurname']."!";
        
        $conn2=new mysqli("localhost","root","","companyannualleave");
        $sql2= "SELECT * FROM employees WHERE employeeAnnualRequest = true";
        $result2= $conn2->query($sql2);
        $rows2 = $result2->fetch_all(MYSQLI_ASSOC);

        echo "<br>This is a list of employees who sent Annual Request: <br><br>";
        foreach($rows2 as $row)
        {
            echo $row['employeeName']." ".$row['employeeSurname']." [".$row['employeePosition']."]<br>";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN LOGIN</title>
</head>
<body>
        <form action= adminPanelLogin.php method=post >
        
        Admin Username: <input type="text" name="ausername"><br>
        Admin Password: <input type="text" name="apassword"><br>

        <input type="submit" name="adminLogin" value="LOGIN">

        </form>
    <?php
        



    ?>
</body>
</html>
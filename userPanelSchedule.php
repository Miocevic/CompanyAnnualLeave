
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
        $userUsername=$_POST['uusername'];
        $userPassword=$_POST['upassword'];

        if(empty($userUsername) || empty($userPassword))
            echo "<h1>You have to insert both username and password!</h1>";
            
        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM employees WHERE employeeUsername='$userUsername' AND employeePassword='$userPassword'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach($rows as $row)
            if(($row['employeeUsername']==$userUsername) && ($row['employeePassword']==$userPassword))
            {
            echo "Welcome back ".$row['employeeName']." ".$row['employeeSurname']."!<br><br>";
            echo "You have ".$row['employeeFreeDays']." Free days remaining to the end of this year.<br><br>";
            if($row['employeeFreeDays']>20)
            {
                $lastYearFreeDays = $row['employeeFreeDays']-20;
                echo "However, from this ".$row['employeeFreeDays']." days, you have to use ".$lastYearFreeDays." days from last year until 1. July ".date("Y").", or you will lose them!<br><br>";
            }
            }
            else
            {
                //echo "You have entered wrong username and/or password. Please, try again.";
                header("Location: userPanelLogin.php");
            }
  
?>
    <form>
        Select when You want to start Annual Leave: <br><input type="date" name="edateSchedule"><br>
        How many days do You want to take off? Now you have 
        <?php $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM employees WHERE employeeUsername='$userUsername' AND employeePassword='$userPassword'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row)
            if(($row['employeeUsername']==$userUsername) && ($row['employeePassword']==$userPassword))
                {
                    echo $row['employeeFreeDays']." days left.<br>";
                    echo "<select name='dayschoose'>";
                    for($i=1;$i<=$row['employeeFreeDays'];$i++){
                        echo "<option>".$i."</option>";
                    }
                    echo "</select>";
                }
        ?>
    <br><br>
    <input type="submit" name="userSelectedAnnual" value="SELECT">

    </form>
</body>
</html>
<?php
session_start();        

        $userUsername=$_POST['uusername'];
        $userPassword=$_POST['upassword'];
        $_SESSION['employeeUsername']= $_POST['uusername'];
        $_SESSION['employeePassword']= $_POST['upassword'];

        if(empty($userUsername) || empty($userPassword))
            echo "<h1>You have to insert both username and password!</h1>";

        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM employees WHERE employeeUsername='$userUsername' AND employeePassword='$userPassword'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $firstrow)
            $tryId = $firstrow['employeeId'];

        $employeeId=$tryId;
        echo $employeeId." ";
        $_SESSION['employeeId']=$employeeId;
        echo $_SESSION['employeeId']."<br>";
            
    





        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM employees WHERE employeeUsername='$userUsername' AND employeePassword='$userPassword'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        
        foreach($rows as $firstrow)
            $row=$firstrow;        

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
                header("location: userPanelLogin.php");
            }        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action=userPanelSchedule.php method=post>
        Select when You want to start Annual Leave: 
        <br><input type="date" min="<?php echo date("Y") ?>-01-01" max="<?php echo date("Y") ?>-12-31" name="edateSchedule"><br>

        How many days do You want to take off? Now you have 
        <?php 
        
        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM employees WHERE employeeUsername='$userUsername' AND employeePassword='$userPassword'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $firstrow)
            $row=$firstrow;

        if(($row['employeeUsername']==$userUsername) && ($row['employeePassword']==$userPassword))
                {
                    echo $row['employeeFreeDays']." days left.<br>";
                    if($row['employeeFreeDays']==0)
                        echo "You have used all of Your free days this year. Stay with Us one more year for more. :)";
                    else 
                    {
                        echo "<select name='daysChoose'>";
                        for($i=1;$i<=$row['employeeFreeDays'];$i++){
                        echo "<option>".$i."</option>";
                        }
                    echo "</select>";
                    }
                }
        ?>
    <br><br>
    <input type="submit" name="userSelectedAnnual" value="SELECT">

    </form>
</body>
</html>

<?php
    if(isset($_POST['userSelectedAnnual']))
    {   

        $employeeAnnualDate=$_POST['edateSchedule'];
        $employeeAnnualSelectedDays=$_POST['daysChoose'];

        echo $employeeAnnualDate;
        
        $freeWorkingDays=$employeeAnnualSelectedDays;
        $startingDate=date_create($employeeAnnualDate);
        $endingDate=$startingDate;

        for($i=0;$i<$freeWorkingDays-1;)
        {
            $dayNumber=(int)(date_format($endingDate,"N")); 
            if($dayNumber==5 || $dayNumber==6)
                date_add($endingDate,date_interval_create_from_date_string("1 day"));
            else
            {        
                date_add($endingDate,date_interval_create_from_date_string("1 day"));
                $i++;
            }
        }   
        echo date_format($endingDate,"Y-m-d");

        $endingDate = $endingDate->format('Y-m-d');

        $_SESSION['employeeAnnualDateStart']=$employeeAnnualDate;
        $_SESSION['employeeAnnualSelectedDays']=$employeeAnnualSelectedDays;
        $_SESSION['employeeAnnualDateEnd']=$endingDate;
        //$employeeId=$_SESSION['employeeId'];
        echo "OVO JE ID ".$employeeId."<br>";

        $conn = new mysqli("localhost", "root", "", "companyannualleave");
		$sql = "UPDATE employees SET employeeAnnualRequest = 'true', employeeAnnualDateStart = '$employeeAnnualDate', employeeAnnualDateEnd = '$endingDate', employeeAnnualSelectedDays = '$employeeAnnualSelectedDays' WHERE employeeId = '$employeeId'";
		$result = $conn->query($sql);
        echo "Uspesno UPDEJT!";
        header("location:userPanelLogin.php");

    }
?>
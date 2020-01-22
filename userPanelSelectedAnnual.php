<?php
    session_start();
    if(isset($_POST['userSelectedAnnual']))
    {   

        $employeeAnnualDate=$_POST['edateSchedule'];
        $employeeAnnualSelectedDays=$_POST['daysChoose'];

        
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
        
        $endingDate = $endingDate->format('Y-m-d');

        $_SESSION['employeeAnnualDateStart']=$employeeAnnualDate;
        $_SESSION['employeeAnnualSelectedDays']=$employeeAnnualSelectedDays;
        $_SESSION['employeeAnnualDateEnd']=$endingDate;
        $employeeId=$_SESSION['employeeId'];
        
        //This part will set start and end date for employee Annual Leave.

        $conn = new mysqli("localhost", "root", "", "companyannualleave");
		$sql = "UPDATE employees SET employeeAnnualRequest = true, employeeAnnualDateStart = '$employeeAnnualDate', employeeAnnualDateEnd = '$endingDate', employeeAnnualSelectedDays = '$employeeAnnualSelectedDays' WHERE employeeId = '$employeeId'";
        $result = $conn->query($sql);
        

        // This part will take position of the selected employee and his/hers date for requested Annual Leave

        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM employees WHERE employeeId='$employeeId'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row)
        {
            $ePosition=$row['employeePosition'];
            $eAnnualStartDate=strtotime($row['employeeAnnualDateStart']);
            $eAnnualEndDate=strtotime($row['employeeAnnualDateEnd']);
        }
        
        // This part will get all employees who works on same position and have got aprroved Annual Leave.
        // If there is that case, choosen start and end date for employee Annual Leave will be deleted.


        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM employees WHERE employeePosition = '$ePosition'AND employeeAnnualStatus = true AND employeeId != '$employeeId'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $i=0;
        foreach($rows as $row)
        {
            $currentDateEnd= strtotime($row['employeeAnnualDateEnd']);
            $currentDateStart= strtotime($row['employeeAnnualDateStart']);

            
            if(($eAnnualStartDate <= $currentDateEnd) && ($eAnnualEndDate >= $currentDateStart))
            {
                $i=1;
                echo "<h2>You have to choose another date! Your coleague is already using his Annual Leave with this date span!</h2><br><br>";

                $conn = new mysqli("localhost", "root", "", "companyannualleave");
		        $sql = "UPDATE employees SET employeeAnnualRequest = false, employeeAnnualDateStart = NULL, employeeAnnualDateEnd = NULL, employeeAnnualSelectedDays = 0 WHERE employeeId = '$employeeId'";
                $result = $conn->query($sql); 
            }
        }
        if($i==0){
            echo "<h2>You have successfuly choosed your Annual Leave for this year. Please wait for our Administartor to check the dates.</h2><br><br>";   
        }
    //header("location:userPanelLogin.php");

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YOU CANNOT DO THAT</title>
</head>
<body>

    <a href='index.php'>LOGOUT</a><br>
    
</body>
</html>
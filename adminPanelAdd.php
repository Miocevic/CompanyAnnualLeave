<?php
if(isset($_POST['addNewEmployee']))
{
    $employeeName=$_POST['ename'];
    $employeeSurname=$_POST['esurname'];
    $employeeBirthDate=$_POST['ebirthdate'];
    $employeeStartJobDate=$_POST['ejobdate'];
    $employeePosition = $_POST['eposition'];
    $employeeContractType=$_POST['econtracttype'];
    $employeeUsername=$_POST['eusername'];
    $employeePassword=$_POST['epassword'];
    $employeeFreeDays=0;
    $employeeAnnualStatus=false;
    $employeeAnnualRequest=false;
    

    $yearStartJob = date('Y', strtotime($employeeStartJobDate));
    $currentYear = date("Y");
    
    if(($yearStartJob<$currentYear) && ($employeeContractType=="Full Time"))
       {
        $employeeFreeDaysCurrentYear=20;
        $employeeFreeDaysLastYear=rand(0,20);
       }
        else if (($yearStartJob==$currentYear) && (($employeeContractType=="Full Time")||($employeeContractType=="Part Time")))
        {
            $employeeFreeDaysLastYear=0;

            $dayStartJob = date('j',strtotime($employeeStartJobDate));
            
            $monthStartJob = date('n', strtotime($employeeStartJobDate)); 
                if($dayStartJob==1)
                    $monthFreeDay = 12 - $monthStartJob + 1;
                else
                    $monthFreeDay = 12 - $monthStartJob;
                    
                    echo "<br>".$monthFreeDay;

            $employeeFreeDaysCurrentYear = round(20/12 * $monthFreeDay, 0, PHP_ROUND_HALF_UP);
                        
        }
    $employeeFreeDays = $employeeFreeDaysCurrentYear+$employeeFreeDaysLastYear;

   if(empty($employeeName)|| empty($employeeSurname) || empty($employeeBirthDate) || empty($employeeStartJobDate) || empty($employeePosition) || empty($employeeContractType) || empty($employeeUsername) || empty($employeePassword))
        echo "<h1>You have to insert all the details about new Employee!</h1>";
    else
    { 
        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "INSERT INTO employees(employeeId,employeeName,employeeSurname,employeeBirthDate,employeeStartJobDate,employeePosition,employeeContractType,employeeUsername,employeePassword,employeeFreeDays,employeeAnnualStatus,employeeAnnualRequest) VALUES ('','$employeeName','$employeeSurname','$employeeBirthDate','$employeeStartJobDate','$employeePosition','$employeeContractType','$employeeUsername','$employeePassword','$employeeFreeDays','$employeeAnnualStatus','$employeeAnnualRequest')";
        $result= $conn->query($sql);
        echo "<h1>You have successfully added a new Employee!</h1>";
    }
}

?>

<html>
<head>
	<title>Add New Employee</title>
</head>
<body>
	<form action="adminPanelAdd.php" method="post">
    


	    Employee Name: <input type="text" name="ename"><br>
        Employee Surname: <input type="text" name="esurname"><br>
		Employee Date of Birth: <input type="date" name="ebirthdate"><br>
        Employee Job Start Date: <input type="date" name="ejobdate"><br>
       
        Employee Position: 
        <?php
            $positions=['Front End Developer','Back End Developer','Full Stack Developer', 'Manager', 'Economist'];

            echo "<select name='eposition'>";
            foreach($positions as $row){
                echo "<option>".$row."</option>";
            }
            echo "</select>";
            
        ?>
        <br>
        
        Employee Contract Type: 
        <?php
            $contractType=['Full Time','Part Time'];

            echo "<select name='econtracttype'>";
            foreach($contractType as $row){
                echo "<option>".$row."</option>";
            }
            echo "</select>";
            
        ?><br>
        Employee Username: <input type="text" name="eusername"><br>
        Employee Password: <input type="text" name="epassword"><br>
        <br><br><br>
        <input type="submit" name="addNewEmployee">

	</form>
</body>
</html>
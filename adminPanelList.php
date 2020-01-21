<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees List</title>
</head>
<body>
    <?php

        $conn = new mysqli("localhost", "root", "", "companyannualleave");
        $sql = "SELECT * FROM  employees ORDER BY employeeName,employeeSurname ASC";
        $result = $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    
        //echo "<a href='adminPanelControl.php'>CONTROL PANEL</a><br>";
        echo "<a href='adminPanelAdd.php'>ADD NEW EMPLOYEE</a><br>";
        echo "<a href='adminPanelList.php'>LIST ALL EMPLOYEES</a><br>";
        echo "<a href='adminPanelDelete.php'>REMOVE EMPLOYEE</a><br><br>";
        
        echo "<br>";
        foreach($rows as $row){
            echo "Name: " . $row['employeeName'] . "<br>";
            echo "Surname: ". $row['employeeSurname'] . "<br>";
            echo "Birth Date: " . $row['employeeBirthDate'] . "<br>";
            echo "Start Job Date: " . $row['employeeStartJobDate'] . "<br>";
            echo "Position: ". $row['employeePosition'] . "<br>";
            echo "Contract Type: " . $row['employeeContractType'] . "<br>";
            echo "Annual Leave Days left: " . $row['employeeFreeDays'] . " days <br>";
            echo "Employee using Annual Leave at this Time? ";
                if($row['employeeAnnualStatus']== true)
                    echo "YES.";
                else
                    echo "NO.";

           
            echo "<hr>";
        }
    
    
    ?>
</body>
</html>
<?php
    include "connection.php";
	$employeeId = $_POST['employeeId'];
    
    //  query to update data 
	 
	$result  = mysqli_query($connection , "UPDATE employees SET employeeAnnualStatus=true, employeeAnnualRequest=false, employeeFreeDays=employeeFreeDays-employeeAnnualSelectedDays, employeeAnnualSelectedDays = 0 WHERE employeeId='$employeeId'");
	if($result){
		header("Refresh:0; url:index.php");
	}

?>
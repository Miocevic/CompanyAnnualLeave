<?php
    include "connection.php";
	$employeeId = $_POST['employeeId'];
    
    //  query to update data 
	 
	$result  = mysqli_query($connection , "UPDATE employees SET employeeAnnualRequest=false, employeeAnnualDateStart=NUll, employeeAnnualDateEnd=NULL, employeeAnnualSelectedDays = 0 WHERE employeeId='$employeeId'");
	if($result){
		header("Refresh:0; url:index.php");
	}

?>
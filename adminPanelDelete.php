<?php
if(isset($_POST['remove'])){

		$id = $_POST['employees'];
		$conn = new mysqli("localhost", "root", "", "companyannualleave");
		$sql = "DELETE FROM employees WHERE employeeId = '$id'";
		$result = $conn->query($sql);
}
?>

<html>
<head>
	<title>Remove Employee from Database</title>
</head>
<body>
<a href='adminPanelAdd.php'>ADD NEW EMPLOYEE</a><br>
    <a href='adminPanelList.php'>LIST ALL EMPLOYEES</a><br>
    <a href='adminPanelDelete.php'>REMOVE EMPLOYEE</a><br><br> 
	<a href='index.php'>LOGOUT</a><br><br>
		
	<form action="adminPanelDelete.php" method="post">
		
		<?php
			$conn = new mysqli("localhost", "root", "", "companyannualleave");
			$sql = "SELECT * FROM employees ORDER BY employeeName,employeeSurname ASC";
			$result = $conn->query($sql);
            $rows = $result->fetch_all(MYSQLI_ASSOC);



            echo "Select Employee from a list: <br>";
			echo "<select name='employees'>";
			foreach($rows as $row){
				echo "<option value='".$row['employeeId']."'>" . $row['employeeName'] ." ".$row['employeeSurname']. "</option>";
			}
			echo "</select><br>";

		?> 
	

			<br><input type="submit" name="remove">
	</form>
</body>
</html>
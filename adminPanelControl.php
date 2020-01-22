<?php
        session_start();
        $_SESSION['adminUsername']=$_POST['ausername'];
        $_SESSION['adminPassword']=$_POST['apassword'];
        
        $adminUsername=$_POST['ausername'];
        $adminPassword=$_POST['apassword'];

        if(empty($_SESSION['adminUsername']) || empty($_SESSION['adminPassword']))
            echo "<h1>You have to insert both username and password!</h1>";
           
        $conn=new mysqli("localhost","root","","companyannualleave");
        $sql= "SELECT * FROM admins WHERE adminUsername='$adminUsername' AND adminPassword='$adminPassword'";
        $result= $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach($rows as $firstrow)
            $row = $firstrow;

        if(($row['adminUsername']==$adminUsername) && ($row['adminPassword']==$adminPassword))   
            echo "<h2>Welcome back ".$row['adminName']." ".$row['adminSurname']."!</h2>";
        else
            header("location:adminPanelLogin.php");
?>
   <?php
  include 'connection.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ADMIN CONTROL PANEL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<br/>
    <a href='adminPanelAdd.php'>ADD NEW EMPLOYEE</a><br>
    <a href='adminPanelList.php'>LIST ALL EMPLOYEES</a><br>
    <a href='adminPanelDelete.php'>REMOVE EMPLOYEE</a><br><br>
  <h2>APPROVE OF THE EMPLOYEES ANNUAL LEAVE</h2>
  <p>Select choise for every employee listed.</p>            
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Annual Start Date</th>
        <th>Annual End Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $table  = mysqli_query($connection ,'SELECT * FROM employees WHERE employeeAnnualRequest=true');
          while($row  = mysqli_fetch_array($table)){ ?>
              <tr id="<?php echo $row['employeeId']; ?>">
                <td data-target="employeeName"><?php echo $row['employeeName']; ?></td>
                <td data-target="employeeSurname"><?php echo $row['employeeSurname']; ?></td>
                <td data-target="employeeAnnualDateStart"><?php echo $row['employeeAnnualDateStart']; ?></td>
                <td data-target="employeeAnnualDateEnd"><?php echo $row['employeeAnnualDateEnd']; ?></td>
                <td><button data_role="confirm" onclick=confirm(this) id ="<?php echo $row['employeeId'] ;?>">CONFIRM</button></td>
                <td><button data-role="reject" onclick=reject(this) id="<?php echo $row['employeeId'] ;?>">REJECT</td>
              </tr>
         <?php }
       ?>
       
    </tbody>
  </table>  
</div>

</body>

<script>
 function confirm(obj){
    var employeeId  = obj.id;
    $.ajax({
      url:"confirmAnnualLeave.php",
      type: "POST",
      data: {employeeId: employeeId},

      success:function(){
        alert("You have Accepted this request.");
        header('Location: index.php');}
    })
  }

  function reject(obj){
    var employeeId  = obj.id;
    $.ajax({
      url:"rejectAnnualLeave.php",
      type: "POST",
      data: {employeeId: employeeId},

      success:function(){
        alert("You have Rejected this request."); 
        header('Location: .');          }
    })
  }



</script>
</html>

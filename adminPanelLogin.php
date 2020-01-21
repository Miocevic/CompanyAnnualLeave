<?php
    session_start();
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
        <form action= adminPanelControl.php method=post >
        
        Admin Username: <input type="text" name="ausername"><br>
        Admin Password: <input type="text" name="apassword"><br>

        <input type="submit" name="adminLogin" value="LOGIN">

        </form>
</body>
</html>
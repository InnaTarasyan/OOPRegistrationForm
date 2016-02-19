<html>
<head>
    <link rel="stylesheet" type="text/css" href="myStyles.css">
</head>
<body>
<?php
   include "Controller.php";
   $controller=new Controller();
   $controller->viewProfile();
?>
<div class="rightTopCorner"><a href="LogOut.php">Log Out</div>
</body>
</html>
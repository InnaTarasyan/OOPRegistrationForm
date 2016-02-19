<html>
<head>
    <link rel="stylesheet" type="text/css" href="myStyles.css">
</head>
<body>
<div class="centerText">
    <h1>Registration</h1>
    <table  class="center">
        <form action="RegistrationView.php" method="POST" enctype="multipart/form-data">
            <tr>
                <td>
                    <label>First Name*: </label>
                </td>
                <td>
                    <input id="user_name" type="text" name="first_name"  value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" />
                </td>
            </tr>
            <tr><td><label>Last Name: </label></td>
                <td><input id="last_name" type="text" name="last_name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></td>
            </tr>
            <tr>
                <td>
                    <label>E-Mail*: </label></td>
                <td>
                    <input id="email" type="text" name="email"  value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password*: </label>
                </td>
                <td>
                    <input id="password1" type="password" name="password1" value="<?php if (isset($_POST['password1'])) echo $_POST['password1']; ?>" />
                </td>
            </tr>
            <tr><td><label>Confirm Password*: </label></td>
                <td>
                    <input id="password2" type="password" name="password2" value="<?php if (isset($_POST['password2'])) echo $_POST['password2']; ?>" />
                </td>
            </tr>
            <tr>
                <td>Upload Image*: </td>
                <!--<input type="hidden" name="size" value="350000">-->
                <td><input type="file" name="image" ></td>
            </tr>
            <tr >
                <td >
                    <input  type="submit" name="submit" value="SAVE" />
                </td>
            </tr>
        </form>
    </table>
</div>
<div  class="centerText">
    <?php
       include "Controller.php";
       $controller=new Controller();
       $controller->register();
    ?>
</div>
</body>
</html>

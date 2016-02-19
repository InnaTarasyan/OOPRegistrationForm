<html>
<head>
    <link rel="stylesheet" type="text/css" href="myStyles.css">
</head>
<body>
<div class="centerText">
    <h1>Login</h1>
    <table class="center">
        <form action="LoginView.php" method="POST">
            <tr>
                <td>
                    <label>E-Mail*: </label></td>
                <td>
                    <input id="email" type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password*: </label>
                </td>
                <td>
                    <input id="password" type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" />
                </td>
            </tr>
            <tr >
                <td >
                    <input  type="submit" name="submit" value="LOGIN" />
                </td>
            </tr>
        </form>
    </table>
</div>
<div class="centerText">
    <?php
    include "Controller.php";
    $controller=new Controller();
    $controller->login();
    ?>
</div>
</body>
</html>
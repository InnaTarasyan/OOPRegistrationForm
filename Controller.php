<?php
include "DBConnect.php";

class Controller
{
    public function register()
    {
    error_reporting(0);
    $userErrors="";
    $check=1;
    if (isset($_POST["submit"])) {
        $first_name = $_POST['first_name'];
        if(!$first_name)
        {
            $userErrors.= "Input First Name<br/>";
            $check=0;
        }
        $last_name = $_POST['last_name'];
        if(!$last_name)
        {
            $userErrors.= "Input Last Name<br/>";
            $check=0;
        }

        $email = $_POST['email'];
        if(!$email)
        {
            $userErrors.= "Input Email<br/>";
            $check=0;
        }
        else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $userErrors .= "Invalid email format<br/>";
                $check=0;
            }
        }

        $user_password = $_POST['password1'];

        if(!$user_password)
        {
            $userErrors.= "Input Password<br/>";
            $check=0;
        }

        $conf_password= $_POST['password2'];

        if(!$conf_password)
        {
            $userErrors.= "Confirm Password<br/>";
            $check=0;
        }

        if($user_password && $conf_password && !($user_password==$conf_password))
        {
            $userErrors.= "Passwords do not match<br/>";
            $check=0;
        }

        if ($user_password && (!preg_match('/([a-z]{1,})/', $user_password))) {

            $userErrors.="Password does not contain lowercase<br>";
            $check=0;
        }

        if ($user_password && (!preg_match('/([A-Z]{1,})/', $user_password))) {

            $userErrors.="Password does not contain uppercase<br>";
            $check=0;
        }

        if ($user_password && (!preg_match('/([\d]{1,})/', $user_password))) {

            $userErrors.="Password does not contain digit<br>";
            $check=0;
        }

        if ($user_password && (strlen($user_password) < 5)) {

            $userErrors.="Password length is less than 5.<br>";
            $check=0;

        }

        if(isset($_FILES['image'])) {

            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

            $expensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $expensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "images/" . $file_name);
                //  echo "Success"." ".$file_name;


            } else {
                //print_r($errors);
                $userErrors.= "Select Image<br/>";
                $check=0;
            }

            echo "<span class='error'>".$userErrors."</span>";
                if($check==1) {
                    $connection=new DBConnect();
                    $connection->registration($first_name,$last_name,$email,$user_password,$file_name);

                }
        }

    }

    }

    public function login()
    {
    session_start();
    error_reporting(0);

    if (isset($_POST["submit"])) {

        $email = $_POST['email'];
        $check=1;
        $userErrors="";

        if(!$email)
        {
            $userErrors.= "Empty email<br>";
            $check=0;
        }
        $user_password = $_POST['password'];

        if(!$user_password)
        {
            $userErrors.="Empty Password<br/>";
            $check=0;
        }
        echo "<span class='error'>".$userErrors."</span>";
        if ($check==1) {

            $email = $_POST['email'];
            $user_password = $_POST['password'];
            $email = stripslashes($email);

            $connection=new DBConnect();
            $res=$connection->login($email,$user_password);

            if($res==1) {
                header("Location: http://localhost/OOPRegForm/myProfileView.php");
            }
        }
    }
    }


    public function viewProfile()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: LoginView.php');
        }
        error_reporting(0);
        if(isset($_SESSION['user_id']))
        {
            echo "<div class='centerText title'>".$_SESSION['first_name']."</div>";
            echo "<div class='centerText title'>".$_SESSION['last_name']."</div>";
            echo "<div class='centerText title'><img class='simpleImage' src='images/". $_SESSION['image_name']."'></div>";
        }
    }

    public function logout()
    {
        echo "logout";
        session_start();
        session_destroy();
        header("Location: http://localhost/OOPRegForm/LoginView.php");
    }
}

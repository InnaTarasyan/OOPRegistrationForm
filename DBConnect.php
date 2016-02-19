<?php
include "db_config.php";

class DBConnect
{
    public $db;
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (mysqli_connect_errno()) {
            //echo "Error: Could not connect to database.<br>";
            exit;
        }else
        {
            echo "Success<br>";
        }
    }

    public function registration($first_name,$last_name,$email,$password,$image)
    {

        $sql = "INSERT INTO person (first_name, last_name, email,password,image_name)
           VALUES ('$first_name', '$last_name', '$email',MD5('$password'),'$image')";

        if ($this->db->query($sql) === TRUE) {
             //  echo "registered<br>";
        } else {
           // echo "Error: " . $sql . "<br>" . $this->db->error;
        }
    }

    public function login($email,$password)
    {
        $sql = "SELECT * FROM person where email='" . $email . "' and password='" . md5($password) . "'";
        $result = mysqli_query($this->db, $sql);
        $rowCount = mysqli_num_rows($result);
        if($rowCount==0)
        {
            echo "<span class='error'>Wrong Email/Password.</color>";
        }
        else{
            while ($row = mysqli_fetch_array($result)) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = MD5($row['password']);
                $_SESSION['image_name'] = $row['image_name'];
            }
        }
        return $rowCount;
    }

    function __destruct() {
        $this->db->close();
    }
}
?>
<?php

$fullname =trim($_POST['fullName']) ;
$email = trim($_POST['Email']);
$username = trim($_POST['Username']);
$password = trim($_POST['Password']);
$repeatedpassword = trim($_POST['RepeatPassword']);
$terms = $_POST['terms'];


if(empty($fullname) || empty($email) || empty($username) || empty($password) || empty($repeatedpassword) || empty($terms )){
echo 'please fill out the fields';

}else if(!preg_match("/^[a-zA-Z' ]*$/",$fullname)){echo 'full name field only accepts letters';

}else if (strlen($fullname) >=30){echo 'fullname is too large';}

else if ($fullname == ''){echo 'please fill out fullname field';}

else if (strlen($username) <=4){echo 'username is too short';}

else if(strlen($username) > 12){echo 'username is too large';}

else if (empty($username)){echo 'please fill out username field';}

else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){echo 'please enter a vaild email';}

else if ($repeatedpassword !== $password ){
    echo 'the repeated password does not match';
}

else if(strlen($password) <= 6 ){
    echo 'password is too short';
}
else if (strlen($password) >= 50){
    echo 'password is too large';
}



else{
$servername = 'localhost';
$dbname = 'users';
$user = 'root';
$pass = '';

    try{
        $connection = new PDO ("mysql:host=$servername;dbname=$dbname",$user ,$pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO users (fullName , Email , UserName , Password )
        VALUES ('$fullname','$email','$username','$password')";
        $connection-> exec($sql);
        
        echo "account created !";
    }catch(PDOException $e){
        echo $sql.'<br>'.$e->getMessage();
    }
}




?>
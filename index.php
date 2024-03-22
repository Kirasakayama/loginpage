<?php

$fullname =trim($_POST['fullName']) ;
$email = trim($_POST['Email']);
$username = trim($_POST['Username']);
$password = trim($_POST['Password']);
$repeatedpassword = trim($_POST['RepeatPassword']);
$terms = $_POST['terms'];


if(empty($fullname) || empty($email) || empty($username) || empty($password) || empty($repeatedpassword) || empty($terms )){
echo 'please fill out the fields';
}elseif(!preg_match("/^[a-zA-Z' ]*$/",$fullname)){
    echo 'full name field only accepts letters';}
elseif (strlen($fullname) >=30){
    echo 'fullname is too large';}
elseif ($fullname == ''){
    echo 'please fill out fullname field';}
elseif (strlen($username) <=4){
    echo 'username is too short';}
elseif(strlen($username) > 12){
    echo 'username is too large';}
elseif (empty($username)){
    echo 'please fill out username field';}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo 'please enter a vaild email';}
elseif ($repeatedpassword !== $password ){
    echo 'the repeated password does not match';
}elseif(strlen($password) <= 6 ){
    echo 'password is too short';
}else if (strlen($password) >= 50){
    echo 'password is too large';
}



else{
$servername = 'localhost';
$dbname = 'users';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username = :username ");
    $stmt->bindParam(':Username', $username);
    $stmt->execute();
  
    if($stmt->rowCount()> 0){
        echo 'user already exists';
    }else {
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

  }

  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
  echo "</table>";

  
    
}




?>

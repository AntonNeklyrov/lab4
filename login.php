<?php
require_once 'connect_bd.php';
require_once 'index.php';

$userEmail = $_POST['user_email'];
$userPhone = $_POST['user_phone'];
$userPassword = $_POST['user_password'];
$userPassword2 = $_POST['user_password2'];
$userName = $_POST['user_name'];
$userSurname = $_POST['user_surname'];

if($_POST['user_password'] !== $_POST['user_password2']){
    echo "<script>alert('Пороли не совпадают')</script>";
    exit('<meta http-equiv="refresh" content="0; url=index.php" />');
}

if(!filter_var($_POST['user_phone'], FILTER_VALIDATE_INT )){
    echo "<script>alert('Телефон указан неверно')</script>";
    exit('<meta http-equiv="refresh" content="0; url=index.php" />');
}

if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){
    echo "<script>alert('Емаил указан неверно')</script>";
    exit('<meta http-equiv="refresh" content="0; url=index.php" />');
}

$conn = connect();

$sel = "SELECT * FROM users WHERE user_email = '$userEmail' ";
$res =  $conn->query($sel);
$num =  $res->rowCount();

if($num == 0) {
    $sql = "INSERT INTO users(user_name,user_surname,user_email,user_phone,user_password) 
        VALUES('$userName','$userSurname','$userEmail','$userPhone','$userPassword')";
    $result = $conn->query($sql);
    $_SESSION['user_name'] = $userName;
    if($result) { echo "<script>alert('Пользователь успешно зарегистрирован')</script>"; }
    else  { echo "<script>alert('Ошибка!')</script>"; }
}
else { echo "<script>alert('Такой пользователь уже существует!')</script>"; }

header("Refresh: 5");


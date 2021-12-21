<?php
require_once 'connect_bd.php';
require_once 'index.php';


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

$sel = "SELECT * FROM users WHERE user_email = '$_POST[user_email]'";
$res =  $conn->query($sel);
$num =  $res->rowCount();


if($num == 0) {
    $hash = password_hash($_POST["user_password"],PASSWORD_BCRYPT);
    $sql = "INSERT INTO users(user_name,user_surname,user_email,user_phone,user_password) 
        VALUES('$_POST[user_name]','$_POST[user_surname]','$_POST[user_email]','$_POST[user_phone]','$hash')";
    $result = $conn->query($sql);
    $_SESSION['userName'] = $_POST('user_name');
    if($result) { echo "<script>alert('Пользователь успешно зарегистрирован')</script>"; }
    else  { echo "<script>alert('Ошибка!')</script>"; }

}
else { echo "Пользователь с таким именем существует! "; }

exit('<meta http-equiv="refresh" content="0; url=index.php" />');


<?php

require_once 'connect_bd.php';
require_once 'index.php';

$conn = connect();
$userEmail = $_POST['user_login'];
$userPassword = $_POST['user_password_SignIn'];

$sql = "select user_name
from users
where user_email='$userEmail'
AND user_password='$userPassword'";

$res = $conn->query($sql);
$num = $res->rowCount();

if($num==0){
    echo "<script>alert('Данный пользователь не найден')</script>";
    exit('<meta http-equiv="refresh" content="0; url=index.php" />');
}

$name = $res->fetch(PDO::FETCH_COLUMN);

$_SESSiON['user_email'] = $name;

echo "<script>alert('Вход выполнен успешно!')</script>";
exit('<meta http-equiv="refresh" content="0; url=index.php" />');
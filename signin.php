<?php

require_once 'connect_bd.php';
require_once 'index.php';

$conn = connect();
$hash = password_hash($_POST['user_password'],PASSWORD_BCRYPT);

$sql = "select *
from users
where user_email='$_POST[user_email]'
AND user_password='$hash'";

$res = $conn->query($sql);
$num = $res->rowCount();

if($num==0){
    echo "<script>alert('Данный пользователь не найден')</script>";
    exit('<meta http-equiv="refresh" content="0; url=index.php" />');
}

$_SESSiON['userEmail'] = $_POST('user_email');

echo "<script>alert('Вход выполнен успешно!')</script>";
exit('<meta http-equiv="refresh" content="0; url=index.php" />');
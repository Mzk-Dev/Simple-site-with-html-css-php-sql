<?php 
if($_GET['key'] && $_GET['token'] && $_POST['pass'])
{
    include "db.php";
    $email = $_GET['key'];
    $token = $_GET['token'];
    $new_pass=$_POST['pass'];
    $query = mysqli_query($link,"SELECT * FROM `reset_pass` WHERE `token`='".$token."' and `email`='".$email."';"); 
    if (mysqli_num_rows($query) > 0) 
    {
        $password = md5(md5(trim($new_pass)));
        $change = mysqli_query($link , "UPDATE `users` SET `password` = '".$password."' WHERE `email` = '".$email."'");
        header( 'Location: login.php', true, 303 );
        echo "Пароль успешно обновлен";
    }
    else {
        echo "Ошибка";
    }  
}   
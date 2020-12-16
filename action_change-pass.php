<?php include 'dp.php';
$sql = mysqli_query($link , "UPDATE `password` FROM `users` WHERE `email` = ")
if($sql){
    header('Location: login.php', true, 303 );
    //Как получить мыло?
}
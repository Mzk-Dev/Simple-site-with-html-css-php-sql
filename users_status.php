<?php
    include 'db.php';
    $id = (int) $_GET['id'];
    $check = mysqli_query($link , "SELECT `role_id` FROM `user_role` WHERE `user_id`=$id");
    $result= mysqli_fetch_row($check);
    if ($result['0'] === '1')
    {
        $update=mysqli_query($link , "UPDATE `user_role` SET `role_id` = '2' WHERE `user_id`=$id");
        header('Location: users.php', true, 303 );exit;
    }
    if ($result['0'] === '2')
    {
        $update=mysqli_query($link , "UPDATE `user_role` SET `role_id` = '1' WHERE `user_id`=$id");
        header('Location: users.php', true, 303 );exit;
    }
    
?>
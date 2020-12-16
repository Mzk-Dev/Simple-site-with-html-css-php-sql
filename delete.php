<?php 
    include 'db.php';
    if($_COOKIE['id']===NULL){
        header("Location: index.php"); exit();
    }
    $role = mysqli_query($link ,"SELECT `role_id` FROM `user_role` WHERE `user_id`='".$_COOKIE['id']."'");
    $roles=mysqli_fetch_row($role);
    if ($roles['0'] !='1'){
        header("Location: index.php");exit(); 
    }
    $id = (int) $_GET['id']; 
    $sql = mysqli_query($link, "DELETE FROM `post` WHERE  `id` = $id");
    if($sql){
        header( 'Location: index.php?suc=1', true, 303 );
    } else {
        header( 'Location: index.php?suc=0', true, 303 );
    }


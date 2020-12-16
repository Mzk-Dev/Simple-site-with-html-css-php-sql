<?php
    include 'db.php';
    $id = (int) $_GET['id'];
    //Если переменная Name передана
    if (isset($_POST["Name"])) { 
        //Вставляем данные, подставляя их в запрос
        $sql = mysqli_query($link, "UPDATE `post` SET `name` ='{$_POST['Name']}', `desc` = '{$_POST['Desc']}'   WHERE `id`=$id");
        //Если вставка прошла успешно
        if ($sql) {
            header('Location: index.php?suc=1', true, 303 );
        } 
    }
?>
<?php 
    include 'db.php';
    //Если переменная Name передана
    if (isset($_POST["Name"])) {
        //Вставляем данные, подставляя их в запрос
        $sql = mysqli_query($link, "INSERT INTO `post` (`name`, `desc`) VALUES ('{$_POST['Name']}', '{$_POST['Desc']}' )");
        //Если вставка прошла успешно
        if ($sql) {
            header( 'Location: index.php?suc=1', true, 303 );
        // echo '<p>Данные успешно добавлены.</p>';
        // } else {
        // echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
        }
    }
?>
   
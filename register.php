<?php
// Страница регистрации нового пользователя
// Соединямся с БД
include 'db.php';
$err=[];
$email = ($_POST["email"]);
if(isset($_POST['email'])){
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$_POST['email']))
    {
        $err[] .= "Неверный формат email";
    }
    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT `id` FROM `users` WHERE `email`='".mysqli_real_escape_string($link, $_POST["email"])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] .= "Пользователь с таким email уже существует в базе данных";
    }
}
if($_POST['email'] && empty($err))
{
    $login = $_POST['email']; 
    // Убераем лишние пробелы и делаем двойное хеширование
    $password = md5(md5(trim($_POST['password'])));
    mysqli_query($link,"INSERT INTO `users` SET `email` ='".$login."', `password` ='".$password."'");
    $id = mysqli_query($link, "SELECT `id` FROM `users` WHERE `email` ='".mysqli_real_escape_string($link, $login)."'");
    $idrow = mysqli_fetch_row($id);
    mysqli_query($link , "INSERT INTO `user_role` SET `user_id` = '".$idrow[0]."'");
    header("Location: login.php"); exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Registration</title>
  </head>
  <body>
    <div class="container-fluid bg-dark vh-100">
        <div class="container-login col-10 m-auto bg-info vh-100 d-flex align-items-center justify-content-center ">
            <?php    // проверям логин
        
            
            ?>
            <!-- Переходит на экшн страницу без проверки -->
            <form class="col-6"  method="POST">
                <div class="form-group col-8 m-auto py-3 row">
                    <?if(count($err)){
                        print "<b>При регистрации произошли следующие ошибки:</b><br>";
                        foreach($err as $error)
                        {
                            print $error."<br>";
                    }}?>
                </div>
                <div class="form-group col-8 m-auto py-3 row">
                    <label for="email"><strong>Email : </strong></label>
                    <input class="form-control" name="email" type="text" id="email" required>
                </div>
                <div class="form-group col-8 m-auto py-3">
                    <label for="pass"><strong>Пароль : </strong> </label>
                    <input class="form-control" name="password" id="pass" type="password" required></input>
                </div>
                <div class="form-group col-8 m-auto d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>
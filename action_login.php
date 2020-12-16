<?php
// Страница авторизации
// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}
// Соединямся с БД
include 'db.php';
if(isset($_POST))
{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT `id`, `password` FROM `users` WHERE `email` ='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    // Сравниваем пароли
    if($data['password'] === md5(md5($_POST['password'])))
    {
        // Ставим куки
        setcookie("id", $data['id'], time()+60*60*24*30, "/");
        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: index.php"); exit();
    }
    else
    {
        header('Location: login.php?suc=0', true, 303 );
    }
}
?>
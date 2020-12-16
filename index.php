<?php
    $suc = (int) $_GET['suc']; 
    include 'db.php';
    if(isset($_COOKIE['id'])){
    $role = mysqli_query($link ,"SELECT `role_id` FROM `user_role` WHERE `user_id`='".$_COOKIE['id']."'");
    $roles=mysqli_fetch_row($role);
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
    <title>Home</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'nav.php';?>
            <div class="content-container col-md-10 col-lg-10">
                <h1 class="text-center px-2">Home</h1>
                <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item"><a href="#">Posts</a></li>
                    </ol>
                </nav> -->
                <?php if ($roles['0'] ==='1'){?>
                    <div class="add-container d-flex justify-content-center pb-3">
                        <a href="new.php" class="btn btn-primary ">Add new post</a>
                    </div>
                    <div class="add-container d-flex justify-content-center pb-3">
                        <?php if ($suc==1){
                            echo "Данные успешно обновлены";
                        }?>
                    </div>
                    <?}?>
                <div class="post-container p-0 mr-auto ml-auto col-md-10 col-lg-11 bg-light">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                            $num = 5;
                            // Извлекаем из URL текущую страницу
                            $page = $_GET['page'];
                            // Определяем общее число сообщений в базе данных
                            $result = mysqli_query($link , "SELECT COUNT(*) FROM `post` ");
                            $posts = mysqli_fetch_row($result);
                            // Находим общее число страниц
                            $total = intval(($posts[0] - 1) / $num) + 1;
                            // Определяем начало сообщений для текущей страницы
                            $page = intval($page);
                            // Если значение $page меньше единицы или отрицательно
                            // переходим на первую страницу
                            // А если слишком большое, то переходим на последнюю
                            if(empty($page) or $page < 0) $page = 1;
                            if($page > $total) $page = $total;
                            // Вычисляем начиная к какого номера
                            // следует выводить сообщения
                            $start = $page * $num - $num;
                            // Выбираем $num сообщений начиная с номера $start
                            $result = mysqli_query($link ,"SELECT * FROM `post` LIMIT $start, $num");
                            // В цикле переносим результаты запроса в массив $postrow
                            while ( $postrow[] = mysqli_fetch_array($result))
                        ?>
                            <tr>
                                <?php for($i = 0; $i < $num; $i++) { 
                                    if(isset($postrow[$i]['id'])){?>
                                <th scope="rowgroup"><?php echo $postrow[$i]['id'];?></th>
                                <td class="text-break" ><?php echo $postrow[$i]['name'];?></td>
                                <td class="text-break"><?php echo $postrow[$i]['desc'];?></td>
                                <td class="text-break"><?php echo $postrow[$i]['created'];?></td>
                                <td scope="row">
                                    <div class="d-flex justify-content-around ">
                                        <a class="text-info" href="view.php?id=<?php echo $postrow[$i]['id'];?>">View</a>
                                        <?php if ($roles['0'] ==='1'){?>
                                        |<a class="text-info" href="edit.php?id=<?php echo $postrow[$i]['id'];?>">Edit</a>|
                                        <a class="text-info" href="delete.php?id=<?php echo $postrow[$i]['id'];?>">Delete</a> 
                                        <?}?>
                                    </div>
                                </td>
                            </tr>
                            <?}
                            }?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    <?php
                        // Проверяем нужны ли стрелки назад
                        if ($page != 1) $pervpage = '<a href= ./index.php?page=1><<</a>
                                                    <a href= ./index.php?page='. ($page - 1) .'><</a> ';
                        // Проверяем нужны ли стрелки вперед
                        if ($page != $total) $nextpage = ' <a href= ./index.php?page='. ($page + 1) .'>></a>
                                                        <a href= ./index.php?page=' .$total. '>>></a>';

                        // Находим две ближайшие станицы с обоих краев, если они есть
                        if($page - 2 > 0) $page2left = ' <a href= ./index.php?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
                        if($page - 1 > 0) $page1left = '<a href= ./index.php?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
                        if($page + 2 <= $total) $page2right = ' | <a href= ./index.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
                        if($page + 1 <= $total) $page1right = ' | <a href= ./index.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>';

                        // Вывод меню
                        echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;

                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
        include 'footer.php';
    ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>
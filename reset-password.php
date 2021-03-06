<?php 
if($_GET['key'] && $_GET['token'])
{
    include "db.php";
    $email = $_GET['key'];
    $token = $_GET['token'];
    $query = mysqli_query($link,"SELECT * FROM `reset_pass` WHERE `token`='".$token."' and `email`='".$email."';"); 
    $curDate = date("Y-m-d H:i:s");
    if (mysqli_num_rows($query) > 0) 
    {
        $row= mysqli_fetch_array($query);
        if($row['exp_date'] >= $curDate)
        {
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
    <title>Login</title>
  </head>
  <body>
    <div class="container-fluid bg-dark vh-100">
        <div class="container-login col-10 m-auto bg-info vh-100 d-flex align-items-center justify-content-center ">
            <form class="container-fluid" action="action-reset-password.php?key=<?php echo $email?>&token=<? echo $token?>" method="POST">
                <h3 class="text-center">Введите новый пароль</h3>
                <div class="form-group col-6 m-auto py-3 row">
                    <label for="pass"><strong>Пароль : </strong></label>
                    <input class="form-control" name="pass" type="password" id="pass" required>
                </div>
                <div class="form-group col-6 m-auto d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-lg btn-primary">Далее</button>
                </div>
            </form>
            <?php } } else{?>
            <p>This forget password link has been expired</p>
            <?}
            }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>
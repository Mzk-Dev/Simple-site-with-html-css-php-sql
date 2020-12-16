<?php $suc=$_GET['suc'];?>
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
            <form class="container-fluid" action="action_login.php" method="POST">
                <div class="form-group col-5 m-auto py-3 row">
                    <label for="email"><strong>Email : </strong></label>
                    <input class="form-control" name="email" type="text" id="email" required>
                </div>
                <?if($suc==='0'){?>
                    <h3 class="text-center m-0 p-0">Вы ввели неправильный логин , или пароль</h3>
                <?}?>
                <div class="form-group col-5 m-auto py-3">
                    <label for="pass"><strong>Пароль : </strong> </label>
                    <input class="form-control" name="password" id="pass" type="password" required></input>
                </div>
                <div class="form-group col-5 m-auto py-2 d-flex justify-content-end">
                    <a class="text-dark" href="f_password.php">Забыли пароль?</a><br>
                </div>
                <div class="form-group col-5 m-auto d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-lg btn-primary">Вход</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>
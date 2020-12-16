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
    <title>Users</title>
  </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <?php 
                include 'nav.php';
                ?>
                <div class="content-container col-md-10 col-lg-10">
                    <h1 class="text-center py-2">Users</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                    <div class="post-container p-0 mr-auto ml-auto col-md-10 col-lg-11 bg-light">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $result = mysqli_query($link, "SELECT users.id , users.email , user_role.role_id FROM `users` INNER JOIN `user_role` ON users.id = user_role.user_id ");
                            $n=0;
                            while ( $postrow[] = mysqli_fetch_array($result)):
                                 ?>
                        <tr>
                                
                                <th scope="rowgroup"><?php echo $postrow[$n]['id'];?></th>
                                <td class="text-break" ><?php echo $postrow[$n]['email'];?></td>
                                <td class="text-break"><?php if ($postrow[$n]['role_id']==='1'){echo "admin";}else{echo "user";};?></td>
                                <td scope="row">
                                    <div class="d-flex justify-content-around ">
                                        <a class="text-info" href="users_status.php?id=<?php echo $postrow[$n]['id'];?>">Change status</a>
                                    </div>
                                </td>
                            <? ++$n;?>
                        </tr>
                        </tbody>
                            <?
                            
                            
                           
                        endwhile;?>
                    </table>
                </div>
            </div>
        </div>
        <?php include 'footer.php';?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>
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
    <title>Edit</title>
  </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <?php include 'nav.php';?>
                <div class="content-container col-md-10 col-lg-10">
                    <h1 class="text-center py-2">Edit</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Option/Edit</li>
                        </ol>
                    </nav>
                    <?php 
                        $id = (int) $_GET['id'];
                        $sql = mysqli_query($link, "SELECT * FROM `post` WHERE id = $id");
                        while ($result = mysqli_fetch_array($sql)):
                    ?>
                    <form action="action_edit.php?id=<?echo "$id";?>" method="POST">
                        <div class="form-group col-8 m-auto py-3">
                            <label for="textinput">Change Name</label>
                            <input type="text" class="form-control" id="textinput" name="Name" placeholder="Example Name" value="<?php echo $result['name']?>">
                        </div>
                        <div class="form-group col-8 m-auto py-3">
                            <label for="textareainput">Change description</label>
                            <textarea class="form-control" id="textareainput" rows="3" name="Desc" placeholder="Random text"><?php echo $result['desc']?></textarea>
                        </div>
                        <div class="form-group col-8 m-auto d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <?php endwhile;?>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'footer.php';?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>
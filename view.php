<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>View</title>
  </head>
    <body>
        <?php include 'db.php';?>
        <div class="container-fluid">
            <div class="row">
                <?php include 'nav.php';?>
                <div class="content-container col-md-10 col-lg-10">
                    <h1 class="text-center py-2">View</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Option/View</li>
                        </ol>
                    </nav>
                    <div class="view-container col-8 m-auto">
                        <div class="view-content">
                            <?php 
                                $id = (int) $_GET['id'];
                                $sql = mysqli_query($link, "SELECT * FROM `post` WHERE id = $id");
                                while ($result = mysqli_fetch_array($sql)):
                            ?>
                                <h2 class="text-break">Name: <?php echo $result['name'];?></h2>
                                <p class="text-break">Description: <?php echo $result['desc'];?></p>
                                <p class="text-break">Created: <?php echo $result['created'];?></p>
                                <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php';?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>
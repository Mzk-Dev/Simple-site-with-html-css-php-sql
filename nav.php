<div class="col-md-2 col-lg-2 navbar-container bg-light">
    <nav class="navbar navbar-expand-md navbar-light">
        <a href="#" class="navbar-brand">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                <?php include 'db.php';
                    if(isset($_COOKIE['id'])){
                    $query=mysqli_query($link,"SELECT `email` FROM `users` WHERE `id` = '".$_COOKIE['id']."'");
                    $data = mysqli_fetch_row($query);
                    ?>
                <h6 class="py-2 text-primary m-auto">Hello <?echo $data[0]?> </h6>
                <? }?>
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <?php 
                $role = mysqli_query($link ,"SELECT `role_id` FROM `user_role` WHERE `user_id`='".$_COOKIE['id']."'");
                $roles=mysqli_fetch_row($role);
                if ($_COOKIE['id'] && ($roles['0'] ='1')){?>
                <li class="nav-item">
                    <a href="users.php" class="nav-link">Users</a>
                </li>
                <?}?>
                <?php if(!isset($_COOKIE['id'])){?>
                <li class="nav-item">
                    <a href="register.php" class="nav-link">Registration</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">Login</a>
                </li>
                <?}?>
                <?php 
                if(isset($_COOKIE['id'])){?>  
                <!-- if user login    -->
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Logout</a>
                <?}?>
                </li>
            </ul>
        </div>
    </nav>
</div>
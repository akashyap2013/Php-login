<?php
    session_start();
    $con = mysqli_connect("localhost","root","","php_login");
    if (!$con){
        die("Connection Failed in Home.php File : " . mysqli_connect_error());
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>

<img src="Images/everest_mountain_sky.jpg" class="img1" alt="clip">
<section>
    <form action="Home.php" method="post">
        <div class="container">
            <div class="div1">
                <h1>You are Successfully Log In...!</h1>
            </div>
            <div class="div2">
                <?php
                    $query  = "SELECT * FROM log WHERE id = '$_SESSION[user_id]'";
                    $result = mysqli_query($con,$query);
                    $row = mysqli_fetch_array($result);
                ?>
                <h3 class="wlc">Welcome <?php echo $row['uname']; ?></h3>
                <?php
                    if (!empty($_POST["lagout"])){

                        session_destroy();
                        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Login.php';
                        header("Location: " . $home_url);
                    }
                ?>
                <input type="submit" id="#logout" name="lagout" value="Lagout">
            </div>
        </div>
    </form>
</section>


</body>
</html>

<?php
    session_start();
    $con  = mysqli_connect("localhost","root","","php_login");
    if (!$con){
        die("Connection Failed : " . mysqli_connect_errno());
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="Style.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Berkshire+Swash|Courgette');
    </style>
</head>
<body>
<?php
    $email = $passwd = $error = "";
    $errorflag = false;

    $erroremail = "<h3 class='erroremail'>Email Required...!</h3>";
    $errorpasswd = "<h3 class='errorpasswd'>Password Required...!</h3>";

    if (isset($_POST["submit"])){
        if (empty($_POST["email"])){
            echo $erroremail;
            $errorflag = false;
        }elseif (!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
            $erroremail = "<h3 class='erroremail'>Invalid Email...!</h3>";
            echo $erroremail;
            $errorflag = false;
        }else{
            $email = validation_input($_POST["email"]);
            $errorflag = true;
        }

        if (empty($_POST["passwd"])){
            echo $errorpasswd;
            $errorflag = false;
        }else{

            $len = strlen($_POST["passwd"]);
            if ($len > 15 || $len < 3){
                $errorpasswd = "<h3 class='errorpasswd'>Password Must Between 3 to 15 Characters</h3>";
                echo $errorpasswd;
                $errorflag= false;
            }else{
                $passwd = validation_input($_POST["passwd"]);
                $errorflag = true;
            }
        }


        if ($errorflag = true){

            $query = "SELECT * FROM log WHERE uname = '$_POST[email]' AND passwd = '$_POST[passwd]'";
            $result = mysqli_query($con,$query);
            $row = mysqli_fetch_array($result);
            if ($row > 0){
                $_SESSION["user_id"] = $row["id"];
                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Home.php';
                header('Location: '. $home_url);
            }else {
                $error = "Username or Password Not Match...!";

            }

        }



    }


    function validation_input($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


?>

<img src="Images/everest_mountain_sky.jpg" class="img1" alt="clip">
    <section>
        <form action="Login.php" method="post">
            <div class="container">
                <div class="div1">
                    <h1>How will you build your Login page ?</h1>
                    <h3>Let's Create it...!</h3>
                </div>
                <div class="div2">
                    <img src="Images/pexels-photo-428331.jpeg" alt="">
                    <h4>Need an Account ?<a href="#"> Sign Up</a></h4>
                    <input type="text" name="email" placeholder="email">
                    <input type="password" name="passwd" placeholder="Password">
                    <span style="color: red"><?php echo $error; ?></span>
                    <input type="submit" id="sub" name="submit" value="Sign In">
                    <a href="#">Forgot Your Password ?</a>
                </div>
            </div>
        </form>
    </section>

</body>
</html>
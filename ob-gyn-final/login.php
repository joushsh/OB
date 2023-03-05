<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">

    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nabla&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <?php

    session_start();

    $_SESSION["user"]="";
    $_SESSION["usertype"]="";

    //import database
    include("connection.php");

    if($_POST){

        $email=$_POST['email'];
        $password=$_POST['password'];
        
        $error='<label></label>';

        $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
        if($result->num_rows==1){
            $utype=$result->fetch_assoc()['usertype'];
            if ($utype=='p'){
                $checker = $database->query("SELECT * FROM patient WHERE patient_email='$email' AND patient_password='$password'");
                if ($checker->num_rows==1){
                    //   Patient dashbord
                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='p';
                    
                    header('Location: patient/index.php');

                } else{
                    $error='<label>Invalid email or password</label>';
                }

            } elseif($utype =='a'){
                $checker = $database->query("SELECT * FROM admin WHERE admin_email='$email' AND admin_password='$password'");
                if ($checker->num_rows==1){

                    //   Admin dashbord
                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='a';
                    
                    header('Location: admin/index.php');

                } else{
                    $error='<label>Invalid email or password</label>';
                }


            } elseif($utype=='d'){
                $checker = $database->query("SELECT * FROM secretary WHERE secretary_email='$email' AND secretary_password='$password'");
                if ($checker->num_rows==1){


                    //   doctor dashbord
                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='s';
                    header('Location: secretary/index.php');

                } else{
                    $error='<label>Invalid Email or Password</label>';
                }

            }
            
        } else{
            $error='<label>Invalid Email or Password</label>';
        }
        
    } else{
        $error='<label>&nbsp;</label>';
    }

    ?>

    <div class="split-screen">
        <div class="left">
            <section class="content">
                <h1>Lorem Ipsum</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            </section>
        </div>
        <div class="right">
            <a href="index.html" class="home-btn">
                <img src="media/icons/homepage.png" alt="">
            </a>
            <form action="#" method="POST">
                <section class="content">
                    <h2>Hello!</h2>
                    <div class="login-container">
                        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                    </div>
                </section>
                <div class="input-field">
                    <input id="email" name="email" type="text" required spellcheck="false"> 
                    <label>Email</label>
                </div>
                <div class="input-field">
                    <input id="password" name="password" type="password" required spellcheck="false"> 
                    <label>Password</label>
                </div>
                <div style="font-size:13px;color:red;margin:5px;font-weight:700;text-align:center;">
                    <?php echo $error ?>
                </div>
                <button class="signup-btn" type="submit">Log In</button>
                <section class="copy-legal">
                    <p><span class="small">By continuing, you agree to accept our <br> <a href="#">Privacy Policy</a> &amp; <a href="#">Terms of Services</a></span></p>
                </section>
            </form>
        </div>
    </div>
</body>
</html>
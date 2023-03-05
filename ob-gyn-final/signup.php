<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign Up</title>

    <link rel="stylesheet" href="css/signup.css">

</head>
<body>
    <?php
    
    session_start();

    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Databse
    include("connection.php");

    if($_POST) {

        $result = $database->query("SELECT * FROM webuser");

        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $name = $first_name." ".$last_name;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $tele_number = $_POST['tele_number'];
        $date_of_birth = $_POST['date_of_birth'];

        if($result = $database->query("SELECT * FROM webuser WHERE email = '$email';")) {

            if($result->num_rows==1) {
                $error = 
                '<label>This Email address is already taken. Try another.</label>';
            } else {
                $database->query 
                ("INSERT INTO patient(patient_email, patient_name, patient_password, patient_address, patient_dateofbirth, patient_tel) 
                VALUES('$email', '$name', '$password', '$address', '$date_of_birth', '$tele_number');");

                $database->query("INSERT INTO webuser VALUES('$email', 'p');");

                $_SESSION["user"] = $email;
                $_SESSION["usertype"] = "p";
                $_SESSION["username"] = $fname;

                header('Location: patient/index.php');

                $error = 
                '';
            }
        } else {
            $error =
            '';
        }
    } else {
        $error = 
        '';
    }

    ?>

    <section class="container">
      <header>Create your Account</header>
      <form action="#" class="form" method="POST">
        <div class="column">
          <div class="input-field">
            <input id="fname" name="fname" type="text" required spellcheck="false"> 
            <label>First Name</label>
          </div>
          <div class="input-field">
            <input id="lname" name="lname" type="text" required spellcheck="false"> 
            <label>Last Name</label>
          </div>
        </div>

        <div class="input-field">
            <input id="email" name="email" type="email" required spellcheck="false"> 
            <label>Email Address</label>
        </div>

        <div style="color:red;margin-top:5px;font-weight:700;">
          <?php echo $error ?>
        </div>

        <div class="column">
          <div class="input-field">
            <input id="tele_number" name="tele_number" type="tel" maxlength="11" required spellcheck="false"> 
            <label>Mobile Number</label>
          </div>
          <div class="input-field">
            <input id="date_of_birth" name="date_of_birth" type="date" required spellcheck="false"> 
            <label class="dob-white">Date of Birth</label>
          </div>
        </div>

        <div class="input-field">
            <input id="address" name="address" type="text" required spellcheck="false"> 
            <label>Address</label>
        </div>

        <div class="input-field">
            <input id="password" name="password" type="password" required spellcheck="false"> 
            <label>Password</label>
        </div>

        <div class="buttons-a">
          <a href="login.php">Or Sign In</a>
          <button type="submit">Submit</button>
        </div>
      </form>
      <div class="pp-tas">
          By continuing, you agree to accept our <a href="#">Priacy Policy</a> & <a href="#">Terms of Services</a>
      </div>
    </section>
</body>
</html>
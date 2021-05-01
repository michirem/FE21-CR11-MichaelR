<?php

require_once 'actions/db_connect.php';
require_once 'actions/file_upload.php';
require_once 'components/functions.php';

session_start(); // start a new session or continues the previous
if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); // redirects to home.php
}
if (isset($_SESSION['adm']) != "") {
    header("Location: home.php"); // redirects to home.php
}

$error = false;
$fname = $lname = $email = $date_of_birth = $pass = $picture = '';
$fnameError = $lnameError = $emailError = $dateError = $passError = $picError = '';

if (isset($_POST['btn-signup'])) {

    // sanitize user input to prevent sql injection
    $fname = sanitize($_POST['fname']);
    $lname = sanitize($_POST['lname']);
    $email = sanitize($_POST['email']);
    $pass = sanitize($_POST['pass']);

    $uploadError = '';
    $picture = file_upload($_FILES['picture'], 'user');

    // basic name validation
    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }
   
    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
    // checks whether the email exists or not
        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    // password validation
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    // password hashing for security
    $password = hash('sha256', $pass);
    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO user(first_name, last_name, password, email, picture) VALUES('$fname', '$lname', '$password', '$email', '$picture->fileName')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';

        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        }
    }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS bundle  -->
    <?php include_once 'components/bootcss.php';?>
    <title>Register - Meme Pets</title>
</head>
<body>
    <?php   
        include_once 'components/defaulthero.php';
    ?>
    <div class="container">
        <div class="d-flex flex-column align-items-center py-5">
        <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" enctype="multipart/form-data">
                <?php
                if (isset($errMSG)) {
                ?>
                    <div class="alert alert-<?php echo $errTyp ?>" >
                        <p><?php echo $errMSG; ?></p>
                        <p><?php echo $uploadError; ?></p>
                    </div>
                <?php
                }
                ?>

                <input type ="text"  name="fname"  class="form-control"  placeholder="First name" maxlength="50" value="<?php echo $fname ?>"  />
                <span class="text-danger"> <?php echo $fnameError; ?> </span>

                <input type ="text"  name="lname"  class="form-control"  placeholder="Surname" maxlength="50" value="<?php echo $lname ?>"  />
                <span class="text-danger"> <?php echo $fnameError; ?> </span>

                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value ="<?php echo $email ?>"  />
                <span  class="text-danger"> <?php echo $emailError; ?> </span>

                <input class='form-control' type="file" name="picture" >
                <span class="text-danger"> <?php echo $picError; ?> </span>

                <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15"  />
                <span class="text-danger"> <?php echo $passError; ?> </span>
                <hr/>
                <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
                <hr/>
                <a href="login.php">Sign in Here...</a>
            </form>
        </div>
    </div>
    <?php
        include_once 'components/footer.php';
    ?>
    <!-- Bootstrap 5 JS bundle  -->
    <?php include_once 'components/bootjs.php';?>
</body>
</html>
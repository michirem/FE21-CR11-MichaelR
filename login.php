<?php
session_start();

require_once 'actions/db_connect.php';
require_once 'components/functions.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "" || isset($_SESSION['adm']) != "") {
    header("Location: home.php"); // redirects to ahome.php
    exit;
}

$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = sanitize($_POST['email']);
    $pass = sanitize($_POST['pass']);

    // prevent sql injections / clear user invalid inputs

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing

        $sqlSelect = "SELECT user_id, first_name, password, status FROM user WHERE email = ? ";
        $stmt = mysqli_prepare($connect, $sqlSelect);
        $stmt->bind_param("s", $email);
        $work = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $result->num_rows;
        if ($count == 1 && $row['password'] == $password) {
            if($row['status'] == 'adm'){
                $_SESSION['adm'] = $row['user_id'];           
                header( "Location: home.php");}
            else{
                $_SESSION['user'] = $row['user_id']; 
               header( "Location: home.php");
            }          
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
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
    <title>Login - Meme Pets</title>
</head>
<body>
    <?php   
        include_once 'components/defaulthero.php';
    ?>
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center py-5">
            <form class="w-50" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <?php
                if (isset($errMSG)) {
                    echo $errMSG;
                }
                ?>
        
                <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>"  maxlength="40" />
                <span class="text-danger"><?php echo $emailError; ?></span>

                <input type="password" name="pass"  class="form-control" placeholder="Your Password" maxlength="15"  />
                <span class="text-danger"><?php echo $passError; ?></span>
                <hr/>
                <button button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button>
                <hr/>
                <a href="register.php">Not registered yet? Click here</a>
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
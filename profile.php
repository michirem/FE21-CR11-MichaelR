<?php
session_start();

require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['adm'])) {
$res = mysqli_query($connect, "SELECT * FROM user WHERE user_id=" . $_SESSION['adm']);
}
if (isset($_SESSION['user'])) {
    $res = mysqli_query($connect, "SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
    }
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

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
    <title>Profile - Meme Pets</title>
</head>
<body>
    <header>
        <?php
            include_once 'components/navigation.php';
        ?>
    </header>
    <div class="d-flex justify-content-center align-items-center" style="background-image: url(https://images.unsplash.com/photo-1511367461989-f85a21fda167?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2978&q=80); height: 50vh; background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;">
        <h1 class="text-center text-light">My Profile</h1>
    </div>
    <div class="container">
        <div class="d-flex justify-content-center mt-3">     
            <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $row['picture'] ?>' style="width: 50%;" alt="<?php echo $row['picture']?>">
            <p class="text-white" >Hi <?php echo $row['first_name']; ?></p>
        </div>
        <table class="table">
                    <tr>
                        <th>First Name</th>
                        <td><?php echo $row['first_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><?php echo $row['last_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <a href="update_profile.php?id=<?php echo $row['user_id'] ?>" class="btn btn-primary mx-2">Update Profile</a>
                            <a href="logout.php?logout" class="btn btn-danger mx-2" type="button">Logout</a>
                        </td>
                    </tr>
                </table>
    </div>
    <?php
        include_once 'components/footer.php';
    ?>
    <!-- Bootstrap 5 JS bundle  -->
    <?php include_once 'components/bootjs.php';?>
</body>
</html>
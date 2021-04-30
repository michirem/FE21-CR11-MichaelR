<?php
session_start();

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS bundle  -->
    <?php include_once 'components/bootcss.php';?>
    <title>Home - Meme Pets</title>
</head>
<body>
    <header>
        <?php
            include_once 'components/navigation.php';
        ?>
    </header>
        <?php
            include_once 'components/homehero.php';
        ?>
    <div class="container">
        <h1 class="my-3 text-center">Collection of the finest Pets you can find on the web!</h1>
        <div class="row justify-content-evenly py-5">
            <?php
                include_once 'components/homemain.php';
            ?>
        </div>
    </div>
    <?php
        include_once 'components/footer.php';
    ?>
    <!-- Bootstrap 5 JS bundle  -->
    <?php include_once 'components/bootjs.php';?>
</body>
</html>
<?php

session_start();

include_once 'actions/db_connect.php';
include_once 'components/functions.php';
include_once 'actions/a_select.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// if session is set to user this will redirect to the home page
if (isset($_SESSION['user'])) {
    header("Location: home.php");
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
    <title>Take back</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-evenly py-5">
            <div class="mt-3 mb-3">
                <h1>Pet to be taken back</h1>
                <?php echo showPet($data['picture'], $data['name'], $data['description'], $data['age'], $data['address'], $data['city'], $data['zip'], $data['animal_id']);?>
                <h3 class="mb-4">Do you really want to take this pet back?</h3>
                <form action ="actions/a_takeback.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <button class="btn btn-primary" type="submit">Yes</button>
                    <a href="home.php" class="btn btn-danger">No</a>
                </form>
            </div>
        </div>
    </div>
    <?php
        include_once 'components/footer.php';
    ?>
    <!-- Bootstrap 5 JS bundle  -->
    <?php include_once 'components/bootjs.php';?>
</body>
</html>
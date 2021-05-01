<?php
session_start();

require_once 'actions/db_connect.php';
require_once 'components/functions.php';

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
    <title>Senior - Meme Pets</title>
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
        <h1 class="my-3 text-center">Our kind senior pets are waiting for you!</h1>
        <div class="row justify-content-evenly py-5">
            <?php
                $query = "SELECT * FROM animals LEFT JOIN location ON animals.location_id = location.location_id WHERE animals.age >= 8 AND animals.status = 'available'";
                $result = mysqli_query($connect, $query);
                for ($set = array(); $row = mysqli_fetch_assoc($result); $set[] = $row);     
                    if(mysqli_num_rows($result)) {
                        foreach($set as $value){
                            echo showPet($value['picture'], $value['name'], $value['description'], $value['age'], $value['address'], $value['city'], $value['zip'], $value['animal_id']);
                            }
                    } else {
                        echo "<div>No data to display</div>";
                    }      
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
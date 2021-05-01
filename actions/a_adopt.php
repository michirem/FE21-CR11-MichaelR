<?php 

session_start();

include_once 'db_connect.php';
include_once 'a_select.php';
include_once '../components/functions.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// if session is set to user this will redirect to the home page
if (isset($_SESSION['adm'])) {
    header("Location: adopted.php");
    exit;
}

$locations = mysqli_query($connect,"SELECT * FROM location WHERE location_id = $location_id");
$row = $locations->fetch_array(MYSQLI_ASSOC);

$user_id = $_SESSION['user'];
$query = "INSERT INTO petadoption (animal_id, user_id, date_collected) VALUES ('$animal_id','$user_id', CURDATE())";
    if (mysqli_query($connect, $query) === true) {
        $query2 = "UPDATE `animals` SET `status` = 'adopted' WHERE `animals`.`animal_id` = '$animal_id'";
        if (mysqli_query($connect, $query2) === true){
            $class = "success";
            $tags = '&#127881;&#127881;&#127881;&#127881;&#127881;';
            $message = "Congratulations! You adopted: <br>".showPet($picture, $name, $description, $age, $row['address'], $row['city'], $row['zip'], '#');
        }
        else {
            $class = "danger";
            $tags = '';
            $message = "The pet was not adopted due to: <br>" . $connect->error;
        }
    } else {
        $class = "danger";
        $tags = '';
        $message = "The pet was not adopted due to: <br>" . $connect->error;
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
    <?php include_once '../components/bootcss.php';?>
    <title>Update</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-evenly py-5">
            <div class="d-flex flex-column align-items-center mt-3 mb-3">
                <h1>Adoption:</h1>
                <h2><?=$tags;?></h2>
            </div>
            <div class="alert alert-<?=$class;?> d-flex flex-column align-items-center" role="alert">
                <?=$message;?>
                <a href='../home.php' class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</body>
</html>
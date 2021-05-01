<?php

session_start();

include_once 'actions/db_connect.php';
include_once 'components/functions.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user'];

if (isset($_SESSION['user'])){
    $query = "SELECT animals.picture, name, date_collected, first_name, last_name FROM petadoption LEFT JOIN `user` ON petadoption.user_id = user.user_id LEFT JOIN animals ON petadoption.animal_id = animals.animal_id WHERE petadoption.user_id = {$id}";
}

if (isset($_SESSION['adm'])){
    $query = "SELECT animals.picture, name, date_collected, first_name, last_name FROM petadoption LEFT JOIN `user` ON petadoption.user_id = user.user_id LEFT JOIN animals ON petadoption.animal_id = animals.animal_id";
}

$tbody = '';
$result = mysqli_query($connect, $query);
    if ($result){
        if(mysqli_num_rows($result)  > 0){
            for ($set = array(); $rows = mysqli_fetch_assoc($result); $set[] = $rows);
            foreach($set as $value){
                $tbody .= showRows($value['picture'], $value['name'], $value['date_collected'], $value['first_name']." ".$value['last_name']);
            }
        } else {
            echo "<tr><td colspan='4'><center>No Data Available </center></td></tr>";
        }
        $connect->close();
    } else {
    header("location: error.php");
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
    <title>Adopted Pets</title>
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
        <div class="class=d-flex flex-column align-items-center py-2">
            <table class='table table-striped'>
                <thead class='table-primary'>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Date collected</th>
                        <th>By user</th>
                        <?php if(isset($_SESSION['adm'])){echo "<th>Action</th>";};?>
                    </tr>
                </thead>
                <tbody>
                 <?= $tbody; ?>
                </tbody>
            </table>
            <a href="home.php" class='btn btn-primary my-3'>Back</a></td>
        </div>
    </div>
    <?php
        include_once 'components/footer.php';
    ?>
    <!-- Bootstrap 5 JS bundle  -->
    <?php include_once 'components/bootjs.php';?>
</body>
</html>
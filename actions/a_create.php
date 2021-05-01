<?php
    session_start();

    include_once 'db_connect.php';
    include_once '../components/functions.php';

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

    if($_POST) { // if the input that has the type submit has a value (when clicked)
       
        $name = $_POST['name'];
        $picture = $_POST['picture'];
        $location_id = $_POST['location'];
        $description = $_POST['description'];
        $hobbies= $_POST['hobbies'];
        $age = $_POST['age'];
        $status = $_POST['status'];
        $type = $_POST['type'];
        $id = settype($_POST['id'], "integer");

        $locations = mysqli_query($connect,"SELECT * FROM location WHERE location_id = $id");
        $row = $locations->fetch_array(MYSQLI_ASSOC);

        $query = "INSERT INTO `animals` (`location_id`, `name`, `description`, `hobbies`, `age`, `picture`, `status`, `type`) VALUES ('$location_id', '$name', '$description', '$hobbies', '$age', '$picture', '$status', '$type')"; 

        if(mysqli_query($connect, $query) == true){
        $class = "success";
        $message = "The entry below was successfully created:<br><br>".showPet($picture, $name, $description, $age, $row['address'], $row['city'], $row['zip'], ' '); // Preview of updated item
        } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        }
        $connect->close();
    } else {
        header("location: ../error.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS bundle  -->
    <?php include_once '../components/bootcss.php';?>
    <title>Create</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-evenly py-5">
            <div class="mt-3 mb-3">
                <h1>Create Request</h1>
            </div>
            <div class="alert alert-<?=$class;?> d-flex flex-column align-items-center" role="alert">
                <?php echo ($message) ?? ''; ?>
                <a href='../home.php' class="btn btn-primary my-2">Home</a>
                <a href='../create.php' class="btn btn-primary my-2">Add another Pet</a>
            </div>
        </div>
    </div>
    <?php
        include_once '../components/footer.php';
    ?>
    <!-- Bootstrap 5 JS bundle  -->
    <?php include_once '../components/bootjs.php';?>
</body>
</html>
<?php 

$options = '';

if ($_GET['id']) {
    $id = $_GET['id'];
    $query = "SELECT * FROM animals LEFT JOIN location ON animals.location_id = location.location_id WHERE animal_id = {$id}";
    $result = mysqli_query($connect, $query);
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();

        $animal_id = $data['animal_id'];
        $location_id = $data['location_id'];
        $address = $data['address'];
        $city = $data['city'];
        $zip = $data['zip'];
        $name= $data['name'];
        $description = $data['description'];
        $hobbies = $data['hobbies'];
        $age = $data['age'];
        $picture = $data['picture'];
        $status = $data['status'];
        $type = $data['type'];

    } else {
        header("location: error.php");
    }
} else {
    header("location: error.php");
}
?>
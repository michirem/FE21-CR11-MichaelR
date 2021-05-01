<?php

require_once 'actions/db_connect.php';
require_once 'functions.php';

$query = "SELECT * FROM animals LEFT JOIN location ON animals.location_id = location.location_id";
$result = mysqli_query($connect, $query);
for ($set = array(); $row = mysqli_fetch_assoc($result); $set[] = $row);

    if(mysqli_num_rows($result) > 0 && isset($_SESSION['adm'])) {
        echo
        '<div class="d-flex justify-content-center my-3">
            <a href= "create.php" class="btn btn-primary">Add Pets</a>
        </div>';
        foreach($set as $value){
            echo showPetAdmin($value['picture'], $value['name'], $value['description'], $value['age'], $value['address'], $value['city'], $value['zip'], $value['animal_id']);
            }
    } else if (mysqli_num_rows($result) > 0 && isset($_SESSION['user'])) {
        foreach($set as $value){
            echo showPet($value['picture'], $value['name'], $value['description'], $value['age'], $value['address'], $value['city'], $value['zip'], $value['animal_id']);
            }
    } else {
        echo "<div>No data to display</div>";
    }        

?>
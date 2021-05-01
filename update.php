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

$query2 = "SELECT * FROM location";
$loc = mysqli_query($connect, $query2);

while ($row = mysqli_fetch_array($loc, MYSQLI_ASSOC)){
    $options .= 
"<option value='{$row['location_id']}'>{$row['address']} - {$row['city']} - {$row['zip']}</option>";
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
    <title>Update Request</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-evenly py-5">
            <div class="mt-3 mb-3">
                <h1>Element to be updated</h1>
                <?php echo showPet($picture, $name, $description, $age, $address, $city, $zip, ' ') ?>
                <fieldset>
                <legend class='h2 py-4'>Update Pet</legend>
                <form action="actions/a_update.php" method= "post" enctype="multipart/form-data">
                    <table class='table'>
                        <tr>
                            <th>Name</th>
                            <td><input class='form-control' type="text" name="name"  placeholder="Pet Name" value="<?php echo $name ?>"/></td>
                        </tr>
                        <tr>
                            <th>Picture</th>
                            <td><input class='form-control' type="url" name="picture"  placeholder="Picture URL" value="<?php echo $picture ?>"/></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><select id="locations" name="location">
                                <?php echo $options; ?>
                                <option selected value="<?php echo $location_id ?>"><?php echo $address." - ".$city." - ".$zip ?></option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><textarea class='form-control' type="text" name= "description" placeholder="Short descrpition" rows="5"><?php echo $description ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Hobbies</th>
                            <td><textarea class='form-control' type="text" name= "hobbies" placeholder="Hobbies" rows="2"><?php echo $hobbies ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td><input class='form-control' type="number" name="age" value="<?php echo $age?>"/></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                            <select id="status" name="status">
                                <option selected value="<?php echo $status ?>">Current: <?php echo $status; ?></option>
                                <option value="available">available</option>
                                <option value="adopted">adopted</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td><select id="type" name="type">
                                <option selected value="<?php echo $type ?>">Current: <?php echo $type; ?></option>
                                <option value="small">small</option>
                                <option value="large">large</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <input type= "hidden" name= "id" value= "<?php echo $id ?>" />
                            <td><button class="btn btn-primary" type= "submit">Save Changes</button></td>
                            <td><a href= "home.php" class="btn btn-danger">Back</a></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
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
<?php

session_start();

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
    <title>Add Medium</title>
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
        <div class="d-flex flex-column align-items-center">
            <fieldset>
                <legend class='h2 py-4'>Add a new Medium</legend>
                <form action="actions/a_create.php" method= "post" enctype="multipart/form-data">
                <table class='table'>
                        <tr>
                            <th>Name</th>
                            <td><input class='form-control' type="text" name="name"  placeholder="Pet Name"/></td>
                        </tr>
                        <tr>
                            <th>Picture</th>
                            <td><input class='form-control' type="url" name="picture"  placeholder="Picture URL" /></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><select id="locations" name="location">
                                <?php echo $options; ?>
                                <option selected value="none">Please select one</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><textarea class='form-control' type="text" name= "description" placeholder="Short descrpition" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <th>Hobbies</th>
                            <td><textarea class='form-control' type="text" name= "hobbies" placeholder="Hobbies" rows="2"></textarea></td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td><input class='form-control' type="number" name="age"/></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                            <select id="status" name="status">
                                <option selected value="none">Please select one</option>
                                <option value="available">available</option>
                                <option value="adopted">adopted</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td><select id="type" name="type">
                                <option selected value="none">Please select one</option>
                                <option value="small">small</option>
                                <option value="large">large</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><button class='btn btn-primary mx-2' type="submit">Insert Medium</button><a href="home.php" class='btn btn-danger mx-2'>Cancel</a></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>
    </div>
    <?php
        include_once 'components/footer.php';
    ?>
    <!-- Bootstrap 5 JS bundle  -->
    <?php include_once 'components/bootjs.php';?>
</body>
</html>
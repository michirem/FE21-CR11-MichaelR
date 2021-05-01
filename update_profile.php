<?php
session_start();

require_once 'actions/db_connect.php';
require_once 'actions/file_upload.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['adm']) && !isset($_SESSION['user']) ) {
    header("Location: login.php");
    exit;
}
$message = '';
$uploadError = '';

//fetch and populate form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE user_id = {$id}";
    $result = $connect->query($sql);
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        $f_name = $data['first_name'];
        $l_name = $data['last_name'];
        $email = $data['email'];
        $picture = $data['picture'];
    }   
}

//update
$class = 'd-none';
if (isset($_POST["submit"])) {
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    //variable for upload pictures errors is initialized
    $uploadError = '';    
    $pictureArray = file_upload($_FILES['picture'], 'user'); //file_upload() called
    $picture = $pictureArray->fileName;
    if ($pictureArray->error === 0) {       
        ($_POST["picture"] == "avatar.webp") ?: unlink("pictures/{$_POST["picture"]}");
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', picture = '$pictureArray->fileName' WHERE user_id = {$id}";
    } else {
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', WHERE user_id = {$id}";
    }
    if ($connect->query($sql) === true) {     
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update_profile.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update_profile.php?id={$id}");
    }
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
    <title>Update Profile</title>
</head>
<header>
    <?php
        include_once 'components/navigation.php';
    ?>
</header>
<body>
    <div class="d-flex justify-content-center align-items-center" style="background-image: url(https://images.unsplash.com/photo-1511367461989-f85a21fda167?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2978&q=80); height: 50vh; background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;">
        <h1 class="text-center text-light">Update Profile</h1>
    </div>
    <div class="container">
    <div class="<?php echo $class; ?>" role="alert">
                <p><?php echo $message; ?></p>
                <p><?php echo $uploadError; ?></p>       
            </div>
            <h2 class="text-center mt-2">Update</h2>
            <div class="d-flex justify-content-center mt-2">     
                <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $data['picture'] ?>' style="width: 50%;" alt="<?php echo $f_name ?>">
            </div>
            <form  method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <th>First Name</th>
                        <td><input class="form-control" type="text"  name="first_name" placeholder ="First Name" value="<?php echo $f_name ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><input class="form-control" type= "text" name="last_name"  placeholder="Last Name" value ="<?php echo $l_name ?>" /></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input class="form-control" type="email" name="email" placeholder= "Email" value= "<?php echo $email ?>" /></td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td><input class="form-control" type="file" name="picture" /></td>
                    </tr>
                    <tr>
                        <input type= "hidden" name= "id" value= "<?php echo $data['id'] ?>" />
                        <input type= "hidden" name= "picture" value= "<?php echo $picture ?>" />
                        <td> </td>
                        <td><button name="submit" class="btn btn-primary mx-2" type= "submit">Save Changes</button><a href= "profile.php"><button class="btn btn-danger mx-2" type="button">Cancel</button></a></td>
                    </tr>
                </table>
            </form>    
    </div>
    <?php
        include_once 'components/footer.php';
    ?>
    <!-- Bootstrap 5 JS bundle  -->
    <?php include_once 'components/bootjs.php';?>
</body>
</html>
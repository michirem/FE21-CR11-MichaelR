<?php
    session_start();

    include_once 'db_connect.php';
    include_once 'file_upload.php';
    include_once 'showitems.php';

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
        $img = '';
        $imgname = '';

        if($_POST["imagelink"] === "") { //check if URL was provided, if not do a file upload
            $img = file_upload($_FILES["imagename"]);
            $imgname = '../pictures/'.$img->fileName; //for immediate showcase
            $imgupload = $img->fileName; //for upload to database
        } else if ($_FILES["imagename"]["name"] === "" || $_FILES["imagename"]["size"] === 0 && $_POST["imagelink"] !== "") // if URL provided, post image URL and upload URL to database
        {
            $img = $_POST["imagelink"];
            $imgname = $img;
            $imgupload = $img;
        } else if ($_FILES["imagename"]["name"] !== "" && $_FILES["imagename"]["size"] !== 0 && $_POST["imagelink"] !== "") // if both URL and Upload are provided, an error message will show - doesn't work - can't figure why database accepts empty entry for image if set to "NOT NULL"
        {
            $class = "danger";
            $message = "Please choose only one method of adding a picture<br>";
        }
        else // if neither URL or Upload were provided, proceed with default picture from $result
        {
            $img = file_upload($_FILES["imagename"]);
            $imgname = '../pictures/'.$img->fileName;
            $imgupload = $img->fileName;
        }
    
    $title = $_POST["title"];
    $author_id = $_POST["author_id"];
    $isbn = $_POST["ISBN"];
    $short_desc = $_POST["short_desc"];
    $publish_date = $_POST["publish_date"];
    $publisher_id = $_POST["publisher_id"];
    $type = $_POST["type"];
    $status = $_POST["status"];
    $uploadError = '';
         
    $query = "INSERT INTO media(image, author_id, ISBN, short_desc, publish_date, publisher_id, type, status, title) VALUES ('$imgupload', '$author_id', '$isbn', '$short_desc', '$publish_date', '$publisher_id', '$type', '$status', '$title')";
    // query that creates a new record in the table test. The values come from the form
         
        if(mysqli_query($connect, $query) == true){ // if the query runs successfully it will show a message and a link to go back to the home page.
        $class = "success";
        $message = "The entry below was successfully created:<br><br>".showitem($imgname, $title, $type, $author_id, '', $author_id/* id left empty for practicality reasons */); // Preview of added item
            if($_POST["imagelink"] === ""){ // only apply if no URL was provided and an image was uploaded
            $uploadError = ($img->error !=0)? $img->ErrorMessage :'';
            }
        } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
            if($_POST["imagelink"] === ""){ // only apply if no URL was provided and an image was uploaded
            $uploadError = ($img->error !=0)? $img->ErrorMessage :'';
            }
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
    <title>Update</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-evenly py-5">
            <div class="mt-3 mb-3">
                <h1>Create Request</h1>
            </div>
            <div class="alert alert-<?=$class;?> d-flex flex-column align-items-center" role="alert">
                <span><?php echo ($message) ?? ''; ?></span>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../main.php' class="btn btn-primary my-2">Home</a>
                <a href='../create.php' class="btn btn-primary my-2">Add another Medium</a>
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
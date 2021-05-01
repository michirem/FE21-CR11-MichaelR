<?php
    // sanitization of user inputs
    function sanitize($var){
        $sanitized = trim($var);
        $sanitized = strip_tags($sanitized);
        $sanitized = htmlspecialchars($sanitized);
        return $sanitized;
    }

    // show pets for users
    function showPet($img, $name, $description, $age, $address, $city, $zip, $id)
    {
        return "<div class=\"col-6 col-md-4 col-lg-3 my-3\">
            <div class=\"card\">
                <div style='background-image: url(".$img."); background-repeat: no-repeat; background-size: contain; height: 350px; background-position: center;'>
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Name: ".$name."</h5>
                    <p class=\"card-text\">Description: ".$description."</p>
                    <p class=\"card-text\">Age: ".$age."</p>
                    <p class=\"card-text\">Location:<br>".$address."<br>".$city."<br>ZIP: ".$zip."</p>
                </div>
                <div class=\"card-body\">
                    <a href='adopt.php?id=".$id."' class='btn btn-primary btn-sm'>Take me home</a>
                </div>
            </div>
        </div>";
    }

    // show pets for administrators with edit and delete buttons
    function showPetAdmin($img, $name, $description, $age, $address, $city, $zip, $id)
        {
        return "<div class=\"col-6 col-md-4 col-lg-3 my-3\">
            <div class=\"card\">
                <div style='background-image: url(".$img."); background-repeat: no-repeat; background-size: contain; height: 350px; background-position: center;'>
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Name: ".$name."</h5>
                    <p class=\"card-text\">Description: ".$description."</p>
                    <p class=\"card-text\">Age: ".$age."</p>
                    <p class=\"card-text\">Location:<br>".$address."<br>".$city."<br>ZIP: ".$zip."</p>
                </div>
                <div class=\"card-body\">
                    <a href='adopt.php?id=".$id."' class='btn btn-primary btn-sm'>Take me home</a>
                </div>
                <div class=\"card-body\">
                    <a href='update.php?id=".$id."' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='delete.php?id=".$id."' class='btn btn-danger btn-sm'>Delete</a>
                </div>
            </div>
        </div>";
        }
    
    // show rows for users and admins
    function showRows($picture, $name, $date_collected, $user_id) {
        if (isset($_SESSION['user'])){
        $row = "<tr>
            <td><img class='img-thumbnail' style='height: 150px;' src='".$picture."'</td>
            <td>".$name."</td>
            <td>".$date_collected."</td>
            <td>".$user_id."</td>
        </tr>";
        }

        if (isset($_SESSION['adm'])){
        $row = "<tr>
            <td><img class='img-thumbnail' style='height: 150px;' src='".$picture."'</td>
            <td>".$name."</td>
            <td>".$date_collected."</td>
            <td>".$user_id."</td>
            <td><button class='btn btn-danter btn-sm'>Take Back</button></td>
        </tr>";
        }

        return $row;
}
?>
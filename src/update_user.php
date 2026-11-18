<?php 
include('../settings/database.php');

//Data coming from the form
$id = $_POST['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$mobile_phone = $_POST['mobile_phone'];

//Part A: Update the data
$sql = 'UPDATE users
        SET firstname = $1, lastname = $2, email = $3, mobile_phone = $4
        WHERE id = $5';

$res = pg_query_params($local_conn, $sql, array($firstname, $lastname, $email, $mobile_phone, $id));

if(!$res){
    echo "Error updating data";
    exit;
}


//Part B: The photo (only if one was chosen)
if ($_FILES['photo']['name'] !=""){

    //File extension in lowercase: jpg, jpeg, png
    $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

    if ($ext == "jpg" || $ext == "jpeg" || $ext == "png"){

        //Photo name = mobile phone + extension
        $photo_url = "photos/" . $mobile_phone . "." . $ext;

        //Move the photo to the temporary folder or src/photos
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $photo_url)){

            //Save the path in the database
            $sql = 'UPDATE users SET url_photo = $1 WHERE id = $2';
            pg_query_params($local_conn, $sql, array($photo_url, $id));

        }else{
            echo "The photo could not be saved. Check the folder photos";
            exit;
        }

    }else{
        echo "Only JPG or PNG photos are allowed. <a href ='edit_user.php?userID=$id'>Return</a>";
        exit;
    }

}

//Part C: Return the list 
header("Location: list_users.php");
exit;
?>
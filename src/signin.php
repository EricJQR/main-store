<?php
// Get database connection
include('../settings/database.php');

session_start();

// Get payload from frontend
$email = $_POST['email'];
$passwd_form = $_POST['pswd'];

// Get password from database
$sql_get_password = "
    SELECT password
    FROM users
    WHERE email = '$email'
";

$res = pg_query($local_conn, $sql_get_password);
$row = pg_fetch_assoc($res);

if ($row) {

    $passwd_db = $row['password'];

    // Verify password
    $passwd = password_verify($passwd_form, $passwd_db);

    if ($passwd) {

        // Get user information
        $sql_check_email = "
            SELECT
                id,
                firstname,
                lastname,
                email,
                url_photo
            FROM users
            WHERE email = '$email'
        ";

        $res = pg_query($local_conn, $sql_check_email);
        $row = pg_fetch_assoc($res);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_firstname'] = $row['firstname'];
        $_SESSION['user_lastname'] = $row['lastname'];

        header('Location: home.php');
        exit();

    } else {
        echo "Invalid password.";
    }

} else {
    echo "User not found.";
}
?>
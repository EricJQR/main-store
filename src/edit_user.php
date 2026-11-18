<?php 

include ('../settings/database.php');

$id = $_GET['userID'];

$sql = 'SELECT * FROM users WHERE id = $1';

$res = pg_query_params($local_conn, $sql, array($id));
$user = pg_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Users</h1>

    <form action="update_user.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $user['id'];?>">

        <label>Name</label> <br>
        <input type="text" name="firstname" value="<?php echo $user['firstname'];?>" required> <br><br>

        <label>Lastname</label> <br>
        <input type="text" name="lastname" value="<?php echo $user['lastname'];?>" required> <br><br>
        
        <label>Email</label> <br>
        <input type="email" name="email" value="<?php echo $user['email'];?>" required> <br><br>
        
        <label>Mobile phone:</label> <br>
        <input type="text" name="mobile_phone" value="<?php echo $user['mobile_phone'];?>" required> <br><br>
        
        <?php if ($user['url_photo'] !="" ){ ?>
            <p>Current photo:</p>
            <img src="<?php echo $user ['url_photo']; ?>" width="120"> <br><br>
        <?php } ?>

        <label>Photo(JPG o PNG) </label><br>
        <input type="file" name="photo" accept=".jpg, .jpeg, .png"><br><br>
        
        <button type="submit">Save</button>
        <a href="list_users.php">Cancel</a>
    </form>    
</body>
</html>
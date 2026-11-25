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
    <title>Main Store - Edit User</title>

    <style>

        body{
            background-color: #F4F7FB;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 30px 15px;
        }

        .container{
            width: 100%;
            max-width: 450px;
            margin: 30px auto;
            padding: 30px;
            box-sizing: border-box;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        h1{
            color: #142D4E;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle{
            color: #777777;
            text-align: center;
            margin-bottom: 30px;
        }

        label{
            display: block;
            color: #142D4E;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #D5DDE8;
            border-radius: 6px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        input:focus {
            outline: none;
            border-color: #2878C8;
        }

        input[type="file"] {
            width: 100%;
            margin-bottom: 20px;
        }

        .current-photo {
            text-align: center;
            margin-bottom: 20px;
        }

        .current-photo img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #D5DDE8;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        button, .cancel {
            flex: 1;
            padding: 13px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background-color: #2878C8;
            color: white;
            border: none;
        }

        button:hover {
            background-color: #142D4E;
        }

        .cancel {
            background-color: #E8EDF4;
            color: #142D4E;
        }

        .cancel:hover {
            background-color: #D5DDE8;
        }

    </style>
</head>
<body>

    <div class="container">
    <h1>Edit Users</h1>
    <p class="subtitle"> Update user information </p>

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
            <div class = "current-photo">
                <p>Current photo:</p>

                <img src="<?php echo $user ['url_photo']; ?>" width="120"> <br><br>
            
            </div>
            <?php } ?>

        <label>Photo(JPG o PNG) </label><br>
        <input type="file" name="photo" accept=".jpg, .jpeg, .png"><br><br>
        

        <div class="buttons">

                <button type="submit">Save Changes</button>

                <a href="list_users.php" class="cancel">Cancel</a>
    </div>    
        <!--<button type="submit">Save</button>
        <a href="list_users.php">Cancel</a>-->
    </form>    
</body>
</html>
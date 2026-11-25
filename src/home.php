<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('refresh:0;url=signin.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Store - Home</title>

    <style>

        body{
            background-color: #F4F7FB;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        header{
            background-color: #142D4E;
            color: white;
            padding: 20px 50px;
        }

        header h2{
            margin: 0;
        }

        .container{
            max-width: 900px;
            margin: 80px auto;
            padding: 20px;
            text-align: center;
        }

        .welcome-card h1{
            color: #142D4E;
            margin-bottom: 15px;
        }

        .welcome-card p{
            color: #777777;
            font-size: 17px;
        }

        .store-section{
            margin-top: 35px;
        }

        .store-section h2{
            color: #142D4E;
        }

        .store-card{
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .logout{
            display: inline-block;
            margin-top: 25px;
            padding: 12px 30px;
            background-color: #2878C8;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .logout.hover{
            background-color: #142D4E;
        }

    </style>


</head>
<body>

    <header>
        <h2>Main Store</h2>
    </header>

    <main class="container">
        <section class = "welcome-card">
        <h1>Welcome,
        <?php echo $_SESSION['user_firstname']." " . $_SESSION['user_lastname']; ?>! 
        </h1>

        <p> 
        Welcome to main store <br>
        We are happy to have you here!</p>

        
</section>
<section class="store-section">
    <h2>Explore Main Store</h2>

    <div class="store-card">
        <h3>Your experience starts here!</h3>

        <br><a href="list_users.php">List of users</a> <br> <br>
        <a href="logout.php">Logout</a>
        
    </div>
</section>
</main>
</body>
</html>
<?php 
    require 'functions/functions.php';
    session_start();
    // Check whether user is logged on or not
    if (!isset($_SESSION['user_id'])) {
        header("location:index.php");
    }
    // Establish Database Connection
    $conn = connect();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Network</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="resourcess/css/login.css">
    <link rel="stylesheet" type="text/css" href="resourcess/css/main.css">
    
    <style>
  
    .frame a{
        text-decoration: none;
        color: #4267b2;
    }
    .frame a:hover{
        text-decoration: underline;
    }
    </style>
</head>

<body class="body-background">
    
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        
        <div class="alert alert-primary mx-auto mt-4 w-100 text-center" role="alert">
            <h2>Amigos</h2>
        </div>

        <?php
            echo '<center>'; 
            $sql = "SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_gender
                    FROM users
                    JOIN (
                        SELECT friendship.user1_id AS user_id
                        FROM friendship
                        WHERE friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 1
                        UNION
                        SELECT friendship.user2_id AS user_id
                        FROM friendship
                        WHERE friendship.user1_id = {$_SESSION['user_id']} AND friendship.friendship_status = 1
                    ) userfriends
                    ON userfriends.user_id = users.user_id";
            $query = mysqli_query($conn, $sql);
            $width = '168px';
            $height = '168px';
            if($query){
                if(mysqli_num_rows($query) == 0){
                    echo '<div class="alert alert-warning mx-auto mt-4 w-75 text-center">';
                    echo 'No tienes contactos.';
                    echo '</div>';
                } else {
                    while($row = mysqli_fetch_assoc($query)){
                    echo '<div class="frame">';
                    echo '<center>';
                    include 'includes/profile_picture.php';
                    echo '<br>';
                    echo '<a href="profile.php?id=' . $row['user_id'] . '">' . $row['user_firstname'] . ' ' . $row['user_lastname'] . '</a>';
                    echo '</center>';
                    echo '</div>';
                    }
                }
            }
            echo '</center>';
        ?>
    </div>
</body>
</html>
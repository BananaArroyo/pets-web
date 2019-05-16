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
</head>

<body class="body-background">

    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <div class="alert alert-primary mx-auto mt-4 w-100 text-center" role="alert">
            <h2>Interesados</h2>
        </div>
        <?php
        // Responding to Request
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['accept'])) {
                $sql = "UPDATE friendship
                        SET friendship.friendship_status = 1
                        WHERE friendship.user1_id = {$_GET['id']} AND friendship.user2_id = {$_SESSION['user_id']}";
                $query = mysqli_query($conn, $sql);
                if($query){
                    echo '<div class="userquery">';
                    echo 'HAS ACEPTADO A ' . $_GET['name'];
                    echo '<br><br>';
                    echo 'CARGANDO EN 5 SEGUNDOS';
                    echo '<br><br>';
                    echo '</div>';
                    echo '<br>';
                    header("refresh:5; url=requests.php" );
                }
                else{
                    echo mysqli_error($conn);
                }
            } else if(isset($_GET['ignore'])) {
                $sql6 = "DELETE FROM friendship
                        WHERE friendship.user1_id = {$_GET['id']} AND friendship.user2_id = {$_SESSION['user_id']}";
                $query6 = mysqli_query($conn, $sql6);
                if($query){
                    echo '<div class="userquery">';
                    echo 'RECHAZASTE A ' . $_GET['name'];
                    echo '<br><br>';
                    echo 'CARGANDO EN 5 SEGUNDOS';
                    echo '<br><br>';
                    echo '</div>';
                    echo '<br>';
                    header("refresh:5; url=requests.php" );
                }
            }
        }
        //
        ?>
        <?php
        $sql = "SELECT users.user_gender, users.user_id, users.user_firstname, users.user_lastname
                FROM users
                JOIN friendship
                ON friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 0 AND friendship.user1_id = users.user_id";
        $query = mysqli_query($conn, $sql);
        $width = '168px';
        $height = '168px';

        if(!$query)
            echo mysqli_error($conn);
        if($query){
            if(mysqli_num_rows($query) == 0){
                echo '<div class="alert alert-warning mx-auto mt-4 w-75 text-center">';
                echo 'No hay solicitudes nuevas.';
                echo '</div>';
            }
            while($row = mysqli_fetch_assoc($query)){
                echo '<div class="userquery">';
                include 'includes/profile_picture.php';
                echo '<br>';
                echo '<a class="profilelink" href="profile.php?id=' . $row['user_id'] .'">' . $row['user_firstname'] . ' ' . $row['user_lastname'] . '<a>';
                echo '<form method="get" action="requests.php">';
                echo '<input type="hidden" name="id" value="' . $row['user_id'] . '">';
                echo '<input type="hidden" name="name" value="' . $row['user_firstname'] . '">';
                echo '<input type="submit" value="ACEPTAR" name="accept">';
                echo '<br><br>';
                echo '<input type="submit" value="IGNORAR" name="ignore">';
                echo '<br><br>';
                echo'</form>';
                echo '</div>';
                echo '<br>';
            }
        }
        ?>
    </div>
</body>
</html>
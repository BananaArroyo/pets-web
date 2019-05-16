<?php 
    require 'functions/functions.php';
    session_start();
    ob_start();
    // Check whether user is logged on or not
    if (!isset($_SESSION['user_id'])) {
        header("location:index.php");
    }
    // Establish Database Connection
    $conn = connect();
    ?>

    <?php
    if(isset($_GET['id']) && $_GET['id'] != $_SESSION['user_id']) {
        $current_id = $_GET['id'];
        $flag = 1;
    } else {
        $current_id = $_SESSION['user_id'];
        $flag = 0;
    }
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
    .post{
        margin-right: 50px;
        float: right;
        margin-bottom: 18px;
    }
    .profile{
        margin-left: 50px;
        width: 220px;
        padding: 20px;
    }
    
    input[type="file"]{
        display: none;
    }
    label.upload{
        cursor: pointer;
        color: white;
        background-color: #4267b2;
        padding: 8px 12px;
        display: inline-block;
        max-width: 80px;
        overflow: auto;
    }
    label.upload:hover{
        background-color: #23385f;
    }
    .changeprofile{
        color: #23385f;
        font-family: Fontin SmallCaps;
    }

    </style>
</head>

<body class="body-background">
    <?php include 'includes/navbar.php'; ?>

    <div class="container">

        <div class="alert alert-primary mx-auto mt-4 w-100 text-center" role="alert">
            <h2>Perfil</h2>
        </div>
       
        <?php
        $postsql;
        if($flag == 0) { // Your Own Profile       
            $postsql = "SELECT posts.post_caption, posts.post_time, users.user_firstname, users.user_lastname,
                                posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                users.user_birthdate, users.user_hometown, users.user_status, users.user_about, 
                                posts.post_id
                        FROM posts
                        JOIN users
                        ON users.user_id = posts.post_by
                        WHERE posts.post_by = $current_id
                        ORDER BY posts.post_time DESC";
            $profilesql = "SELECT users.user_id, users.user_gender, users.user_hometown, users.user_status, users.user_birthdate,
                                 users.user_firstname, users.user_lastname
                          FROM users
                          WHERE users.user_id = $current_id";
            $profilequery = mysqli_query($conn, $profilesql);
        } else { // Another Profile ---> Retrieve User data and friendship status
            $profilesql = "SELECT users.user_id, users.user_gender, users.user_hometown, users.user_status, users.user_birthdate,
                                    users.user_firstname, users.user_lastname, userfriends.friendship_status
                            FROM users
                            LEFT JOIN (
                                SELECT friendship.user1_id AS user_id, friendship.friendship_status
                                FROM friendship
                                WHERE friendship.user1_id = $current_id AND friendship.user2_id = {$_SESSION['user_id']}
                                UNION
                                SELECT friendship.user2_id AS user_id, friendship.friendship_status
                                FROM friendship
                                WHERE friendship.user1_id = {$_SESSION['user_id']} AND friendship.user2_id = $current_id
                            ) userfriends
                            ON userfriends.user_id = users.user_id
                            WHERE users.user_id = $current_id";
            $profilequery = mysqli_query($conn, $profilesql);
            $row = mysqli_fetch_assoc($profilequery);
            mysqli_data_seek($profilequery,0);
            if(isset($row['friendship_status'])){ // Either a friend or requested as a friend
                if($row['friendship_status'] == 1){ // Friend
                    $postsql = "SELECT posts.post_caption, posts.post_time, users.user_firstname, users.user_lastname,
                                        posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                        users.user_birthdate, users.user_hometown, users.user_status, users.user_about, 
                                        posts.post_id
                                FROM posts
                                JOIN users
                                ON users.user_id = posts.post_by
                                WHERE posts.post_by = $current_id
                                ORDER BY posts.post_time DESC";
                }
                else if($row['friendship_status'] == 0){ // Requested as a Friend
                    $postsql = "SELECT posts.post_caption, posts.post_time, users.user_firstname, users.user_lastname,
                                        posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                        users.user_birthdate, users.user_hometown, users.user_status, users.user_about, 
                                        posts.post_id
                                FROM posts
                                JOIN users
                                ON users.user_id = posts.post_by
                                WHERE posts.post_by = $current_id AND posts.post_public = 'Y'
                                ORDER BY posts.post_time DESC";
                }
            } else { // Not a friend
                $postsql = "SELECT posts.post_caption, posts.post_time, users.user_firstname, users.user_lastname,
                                    posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                    users.user_birthdate, users.user_hometown, users.user_status, users.user_about, 
                                    posts.post_id
                            FROM posts
                            JOIN users
                            ON users.user_id = posts.post_by
                            WHERE posts.post_by = $current_id AND posts.post_public = 'Y'
                            ORDER BY posts.post_time DESC";
            }
        }

        $postquery = mysqli_query($conn, $postsql);    
        if($postquery){
            // Posts
            $width = '40px'; 
            $height = '40px';
            if(mysqli_num_rows($postquery) == 0){ // No Posts
                if($flag == 0){ // Message shown if it's your own profile
                    echo '<div class="post alert alert-warning mx-auto mt-4 w-65 text-center">';
                    echo 'No hay posts por mostrar.';
                    echo '</div>';
                } else { // Message shown if it's another profile other than you.
                    echo '<div class="post alert alert-warning mx-auto mt-4 w-65 text-center">';
                    echo 'No hay posts por mostrar.';
                    echo '</div>';
                }
                include 'includes/profile.php';
            } else {
                while($row = mysqli_fetch_assoc($postquery)){
                    include 'includes/post.php';
                }
                // Profile Info
                
                include 'includes/profile.php';
                ?>
                
                <?php if($flag == 0){?>

                    <div class="card text-center mt-4">
                        <div class="card-header">Imagen de perfil</div>
                        <br>
                        <form action="" method="post" enctype="multipart/form-data">
                            <center>
                                <label class="upload" onchange="showPath()">
                                    <span id="path" style="color: white;">... BUSCAR</span>
                                    <input type="file" name="fileUpload" id="selectedFile">
                                </label>
                            </center>
                            <br>
                            <input type="submit" value="SUBIR IMAGEN" name="profile">
                        </form>
                    </div>

                    <div class="card mx-auto mt-4 w-30">
                        <div class="card-body">Agregar celular</div>
                        <form method="post" onsubmit="return validateNumber()">
                            <center>
                                <input type="text" name="number" id="phonenum">
                                <div class="required"></div>
                                <br>
                                <input type="submit" value="Submit" name="phone">
                            </center>
                        </form>
                    </div>
                    <br>
                    <?php } ?>
                <?php
            }
        }
        ?>
    </div>
</body>

    <script>
        function showPath(){
            var path = document.getElementById("selectedFile").value;
            path = path.replace(/^.*\\/, "");
            document.getElementById("path").innerHTML = path;
        }
        function validateNumber(){
            var number = document.getElementById("phonenum").value;
            var required = document.getElementsByClassName("required");
            if(number == ""){
                required[0].innerHTML = "DEBES DE ESCRIBIR EL NUMERO.";
                return false;
            } else if(isNaN(number)){
                required[0].innerHTML = "SOLO CONTIENE NUMEROS."
                return false;
            }
            return true;
        }
    </script>
</html>

<?php include 'functions/upload.php'; ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted
        if (isset($_POST['request'])) { // Send a Friend Request
            $sql3 = "INSERT INTO friendship(user1_id, user2_id, friendship_status)
                    VALUES ({$_SESSION['user_id']}, $current_id, 0)";
            $query3 = mysqli_query($conn, $sql3);
            if(!$query3){
                echo mysqli_error($conn);
            }
        } else if(isset($_POST['remove'])) { // Remove
            $sql3 = "DELETE FROM friendship
                    WHERE ((friendship.user1_id = $current_id AND friendship.user2_id = {$_SESSION['user_id']})
                    OR (friendship.user1_id = {$_SESSION['user_id']} AND friendship.user2_id = $current_id))
                    AND friendship.friendship_status = 1";
            $query3 = mysqli_query($conn, $sql3);
            if(!$query3){
                echo mysqli_error($conn);
            }
        } else if(isset($_POST['phone'])) { // Add a Phone Number to Your Profile
            $sql3 = "INSERT INTO user_phone(user_id, user_phone) VALUES ({$_SESSION['user_id']},{$_POST['number']})";
            $query3 = mysqli_query($conn, $sql3);
            if(!$query3){
                echo mysqli_error($conn);
            } 
        }
        sleep(4);
    }
?>

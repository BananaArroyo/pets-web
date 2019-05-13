<?php 
require 'functions/functions.php';
session_start();
if (isset($_SESSION['user_id'])) {
    header("location:home.php");
}
session_destroy();
session_start();
ob_start(); 
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
      

    <div class="container card mt-4 text-center" style="width: 30rem;">
    
        <div style="text-align:center;">
            <div class="card-header">
                <li class="fas fa-user"></li> Login                      
            </div>                          
        </div>

        <a class="btn btn-dark btn-block" href="inicio-petsweb/index.html" >
        <li class="far fa-question-circle"></li> Información
        </a>
        
        <!--<a href="new-index.php">AIDE</a>-->

        <br>

        <div class="tab">
            <button type="button" class="btn btn-info" onclick="openTab(event,'signin')" id="link1">Iniciar Sesión</button>
            <button type="button" class="btn btn-info" onclick="openTab(event,'signup')" id="link2">Crear Cuenta</button>
        </div>
        
        <!--***********************************      SIGN UP     **************************************-->
            
            <div class="tabcontent" id="signin">
                <div class="card-body"> 
                    <form method="post" onsubmit="return validateLogin()">
                        <div class="form-group">
                            <input type="text" class="form-control" name="useremail" id="loginuseremail" placeholder="E-mail" required autofocus>
                        </div>
                        
                        <div class="form-group">
                            <input type="password" class="form-control" name="userpass" id="loginuserpass" placeholder="Password" required>
                        </div>
                        
                        <input type="submit" class="btn btn-success btn-block" value=" Iniciar Sesión" name="login">
                    </form>      
                </div>
            </div>

            <!--***********************************      SIGN UP     ************************************-->

            <div class="tabcontent" id="signup">
                <div class="card-body">
                    <form method="post" onsubmit="return validateRegister()">
                        
                        <!--First Name-->
                        <div class="form-group">
                            <input type="text" class="form-control" name="userfirstname" id="userfirstname" placeholder="Name" required autofocus>
                        </div>
                        
                        <!--Last Name-->
                        <div class="form-group">
                            <input type="text" class="form-control" name="userlastname" id="userlastname" placeholder="Last name" required>
                        </div>
                        
                        <!--Nickname-->
                        <div class="form-group">
                            <input type="text" class="form-control" name="usernickname" id="usernickname" placeholder="Nickname"required>
                        </div>
            
                        <!--Password-->
                        <div class="form-group">
                            <input type="password" class="form-control" name="userpass" id="userpass" placeholder="Password" required>
                        </div>
                        
                        <!--Confirm Password-->
                        <div class="form-group">
                            <input type="password" class="form-control" name="userpassconfirm" id="userpassconfirm" placeholder="Confirm password" required>
                        </div>
                        
                        <!--CORREO-->
                        <div class="form-group">
                            <input type="text" class="form-control" name="useremail" id="useremail" placeholder="E-mail" reuqired>
                        </div>
                        
                        <!--COLONIA-->
                        <div class="from-group">
                            <input type="text" class="form-control" name="userhometown" id="userhometown" placeholder="Colonia" required>
                        </div>
                        <br/>

                        <!--FECHA DE NACIMIENTO-->
                        <div class="form-group">
                            <select name="selectday">
                                <?php
                                    for($i=1; $i<=31; $i++){
                                        echo '<option value="'. $i .'">'. $i .'</option>';
                                    }
                                ?>
                            </select>
                            <select name="selectmonth">
                            <?php
                                echo '<option value="1">January</option>';
                                echo '<option value="2">February</option>';
                                echo '<option value="3">March</option>';
                                echo '<option value="4">April</option>';
                                echo '<option value="5">May</option>';
                                echo '<option value="6">June</option>';
                                echo '<option value="7">July</option>';
                                echo '<option value="8">August</option>';
                                echo '<option value="9">September</option>';
                                echo '<option value="10">October</option>';
                                echo '<option value="11">Novemeber</option>';
                                echo '<option value="12">December</option>';
                            ?>
                            </select>
                            <select name="selectyear">
                                <?php
                                    for($i=2017; $i>=1900; $i--){
                                        if($i == 1996){
                                            echo '<option value="'. $i .'" selected>'. $i .'</option>';
                                        }
                                        echo '<option value="'. $i .'">'. $i .'</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <!--GENERO-->

                        <div class="form-group">
                            <input type="radio" name="usergender" value="M" id="malegender">
                            <label>Masculino</label>
                            <input type="radio" name="usergender" value="F" id="femalegender">
                            <label>Femenino</label>
                            <!--<input type="radio" name="usergender" value="F" id="femalegender" class="usergender">
                            <label>Otro</label>-->
                        </div>
                            

                        <!--SITUACION MARITAL-->
                        <div class="form-group">
                            <input type="radio" name="userstatus" value="S" id="singlestatus">
                            <label>Soltero</label>
                            <input type="radio" name="userstatus" value="E" id="engagedstatus">
                            <label>Comprometido</label>
                            <input type="radio" name="userstatus" value="M" id="marriedstatus">
                            <label>Casado</label> 
                        </div>
                        
                        <!--SOBRE MI-->
                        <div class="form-group">
                            <textarea class="form-control" rows="10" name="userabout" id="userabout" placeholder="Escribe sobre ti"></textarea>
                        </div>
                        
                        <input type="submit" class="btn btn-success btn-block" value="Crear Cuenta" name="register">

                    </form>
                </div>
            </div>
    </div>
    <script src="resourcess/js/main.js"></script>
</body>
</html>

<?php
    $conn = connect();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted
        if (isset($_POST['login'])) { // Login process
            $useremail = $_POST['useremail'];
            $userpass = md5($_POST['userpass']);
            $query = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$useremail' AND user_password = '$userpass'");
            if($query){
                if(mysqli_num_rows($query) == 1) {
                    $row = mysqli_fetch_assoc($query);
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_firstname'] . " " . $row['user_lastname'];
                    header("location:home.php");
                }
                else {
                    ?> <script>
                        document.getElementsByClassName("required")[0].innerHTML = "Invalid Login Credentials.";
                        document.getElementsByClassName("required")[1].innerHTML = "Invalid Login Credentials.";
                    </script> <?php
                }
            } else{
                echo mysqli_error($conn);
            }
        }
        if (isset($_POST['register'])) { // Register process
            // Retrieve Data
            $userfirstname = $_POST['userfirstname'];
            $userlastname = $_POST['userlastname'];
            $usernickname = $_POST['usernickname'];
            $userpassword = md5($_POST['userpass']);
            $useremail = $_POST['useremail'];
            $userbirthdate = $_POST['selectyear'] . '-' . $_POST['selectmonth'] . '-' . $_POST['selectday'];
            $usergender = $_POST['usergender'];
            $userhometown = $_POST['userhometown'];
            $userabout = $_POST['userabout'];
            if (isset($_POST['userstatus'])){
                $userstatus = $_POST['userstatus'];
            }
            else{
                $userstatus = NULL;
            }
            // Check for Some Unique Constraints
            $query = mysqli_query($conn, "SELECT user_nickname, user_email FROM users WHERE user_nickname = '$usernickname' OR user_email = '$useremail'");
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                if($usernickname == $row['user_nickname'] && !empty($usernickname)){
                    ?> <script>
                    document.getElementsByClassName("required")[4].innerHTML = "This Nickname already exists.";
                    </script> <?php
                }
                if($useremail == $row['user_email']){
                    ?> <script>
                    document.getElementsByClassName("required")[7].innerHTML = "This Email already exists.";
                    </script> <?php
                }
            }
            // Insert Data
            $sql = "INSERT INTO users(user_firstname, user_lastname, user_nickname, user_password, user_email, user_gender, user_birthdate, user_status, user_about, user_hometown)
                    VALUES ('$userfirstname', '$userlastname', '$usernickname', '$userpassword', '$useremail', '$usergender', '$userbirthdate', '$userstatus', '$userabout', '$userhometown')";
            $query = mysqli_query($conn, $sql);
            if($query){
                $query = mysqli_query($conn, "SELECT user_id FROM users WHERE user_email = '$useremail'");
                $row = mysqli_fetch_assoc($query);
                $_SESSION['user_id'] = $row['user_id'];
                header("location:home.php");
            }
        }
    }
?>
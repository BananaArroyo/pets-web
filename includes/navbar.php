<div class="usernav">
    <?php
        $sql2 = "SELECT COUNT(*) AS count FROM friendship 
                 WHERE friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 0";
        $query2 = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($query2);
    ?>
    <ul> <!-- Ensure there are no enter escape characters.-->
        <li><a href="requests.php">PETS USUARIOS (<?php echo $row['count'] ?>)</a></li><li><a href="profile.php">PERFIL</a></li><li><a href="friends.php">CONTACTOS</a></li><li><a href="home.php">INICIO</a></li><li><a href="logout.php">SALIR</a></li>
    </ul>
    <div class="globalsearch">
        <form method="get" action="search.php" onsubmit="return validateField()"> <!-- Ensure there are no enter escape characters.-->
            <select name="location">
                <option value="emails">CORREO</option>
                <option value="names">NOMBRE</option>
                <option value="hometowns">COLONIA</option>
                <option value="posts">POSTS</option>
            </select><input type="text" placeholder="BUSCAR" name="query" id="query"><input type="submit" value="BUSCAR" id="querybutton">
        </form>
    </div>
</div>

<script>
function validateField(){
    var query = document.getElementById("query");
    var button = document.getElementById("querybutton");
    if(query.value == "") {
        query.placeholder = 'Escribe algo!';
        return false;
    }
    return true;
}
</script>
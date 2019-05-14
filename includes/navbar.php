<div class="usernav">
    <?php
        $sql2 = "SELECT COUNT(*) AS count FROM friendship 
                 WHERE friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 0";
        $query2 = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($query2);
    ?>

    <!--***********************************      NAV     **************************************-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <!--  LOGO
        <a class="navbar-brand" href="home.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    -->

    <div class="collapse navbar-collapse" id="navbarSupportedContent">  
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Inicio </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="requests.php">Usuarios(<?php echo $row['count'] ?>)</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="profile.php">Perfil</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="friends.php">Contactos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="logout.php">Salir</a>
            </li>
        </ul>
    
        <form method="get" action="search.php" onsubmit="return validateField()"> <!-- Ensure there are no enter escape characters.-->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <select class="form-control" name="location">
                        <option value="emails">Correo</option>
                        <option value="names">Nombre</option>
                        <option value="hometowns">Colonia</option>
                        <option value="posts">Fecha</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="Buscar" name="query" id="query">
                </div>

                <div class="form-group col-md-4">
                    <input type="submit" class="btn btn-outline-secondary form-control" value="Search" id="querybutton">
                </div>

            </div>
        </form>

    </div>
    </nav>
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

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>

    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>

</div>
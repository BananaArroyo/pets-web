<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="resourcess/css/login.css">

</head>

<body class="body-background">
    
    <div class="row">
    <div class="col-md-4 mx-auto">
        <div class="card mt-4 text-center">
        <div class="card-header">
            <h1 class="h4">
            Account Login
            </h1>
        </div>
            <img class="rounded-circle mx-auto d-block logo m-4" src="/img/logo.png" alt="Logo">
        <div class="card-body">
            <form action="/users/signin" method="POST">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button class="btn btn-primary btn-block">
                Signin 
            </button>
            </form>
        </div>
        </div>
    </div>
    </div>

</body>
</html>
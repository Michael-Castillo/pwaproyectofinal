<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema gestor de tareas</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <style>
        body{
            min-height: 100vh;
            background: linear-gradient(rgba(5,7,12,0.75),rgba(5,7,12,0.75)), 
            url(img/fondo.jpg) no-repeat center center fixed;
            background-size: cover;
        }
        img {
            width: 20vw;
            height: auto;
            border-radius: 20px;
        }
    </style>
    <div class="container">
        <header>
            <h1 class="center">Sistema gestor de tareas</h1>
        </header>
        <div class="container">
            <div class="row center">

            </div>
            <div class="row">
                <div class="col">
                    <h2>Inicie sesión</h2>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div> 

                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena">
                        </div>
                    
                        <button type="submit" id="boton_acceso" name="boton_acceso" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
                <div class="col">
                    <img src="img/inicio.jpg" id="img_achicada">
                </div>
            </div>
        </div>
    </div>
    <script src="./bootstrap/bootstrap.bundle.min.js"></script>
    <script src="./bootstrap/popper.min.js"></script>
</body>
</html>
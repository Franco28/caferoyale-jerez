<?php

require_once "../db/config.php";

session_start();

header('Access-Control-Allow-Origin: *');
$_SESSION = $_SERVER['REMOTE_ADDR'];
 
$usuario = ""; 
$usuario_err = "";
$apellido = ""; 
$apellido_err = ""; 
$email = ""; 
$email_err = ""; 
$provincia = ""; 
$provincia_err = ""; 
$notificacion = ""; 
$mensaje = ""; 
$mensaje_err = "";
$notificacion_err = ""; 
$mysqli = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (empty(trim($_POST["nombre"]))) {
        $username_err = "Por favor, ingrese un nombre.";
    } else {
        $sql = "SELECT id FROM contacto WHERE Nombre = ?";    

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_usuario);            
            $param_usuario = trim($_POST["nombre"]);         

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);      
                $usuario = trim($_POST["nombre"]);
            } else {
                echo "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }         
       mysqli_stmt_close($stmt);
    }

    if (empty(trim($_POST["apellido"]))) {
        $apellido_err = "Por favor, ingrese un apellido.";
    } else {
        $sql = "SELECT id FROM contacto WHERE Apellido = ?";  
              
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_apellido);            
            $param_apellido = trim($_POST["apellido"]);        

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $apellido = trim($_POST["apellido"]);               
            } else {
                echo "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }         
       mysqli_stmt_close($stmt);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, ingrese un email.";
    } else {
        $sql = "SELECT id FROM contacto WHERE Email = ?";  
              
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_eamail);            
            $param_eamail = trim($_POST["email"]);        

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $email = trim($_POST["email"]);               
            } else {
                echo "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }         
       mysqli_stmt_close($stmt);
    }
    
    if (empty(trim($_POST["mensaje"]))) {
        $mensaje_err = "Por favor, ingrese un mensaje.";
    } else {
        $sql = "SELECT id FROM contacto WHERE Mensaje = ?";  
              
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_mensaje);            
            $param_mensaje = trim($_POST["mensaje"]);        

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $mensaje = trim($_POST["mensaje"]);               
            } else {
                echo "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }         
       mysqli_stmt_close($stmt);
    }
        
    if (empty(trim($_POST["provincia"]))) {
        $provincia_err = "Por favor, ingrese una provincia.";
    } else {
        $sql = "SELECT id FROM contacto WHERE Provincia = ?";  
              
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_provincia);            
            $param_provincia = trim($_POST["provincia"]);        

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $provincia = trim($_POST["provincia"]);               
            } else {
                echo "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }         
       mysqli_stmt_close($stmt);
    }

    if (isset($_POST['notificaciones'])) {
        $notificacion = "true";
        $sql = "SELECT id FROM contacto WHERE Notificaciones = ?";  
              
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_notificaciones);            
            $param_notificaciones = trim($_POST["notificaciones"]);        

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $notificacion = trim($_POST["notificaciones"]);               
            } else {
                echo "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }         
       mysqli_stmt_close($stmt);
    }  

    if (empty($usuario_err) && empty($email_err) && empty($mensaje_err) && empty($provincia_err)) {
        $sql = "INSERT INTO contacto (Nombre, Apellido, Email, Provincia, Mensaje, Notificaciones) VALUES (?, ?, ?, ?, ?, ?)";
         
        if ($stmt = mysqli_prepare($link, $sql)) {
            $stmt->bind_param("ssssss", $param_usuario, $param_apellido, $param_eamail, $param_provincia, $param_mensaje, $param_notificaciones);
       
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $param_usuario = $usuario;
            $param_apellido = $apellido;
            $param_email = $email;
            $param_provincia = $provincia;
            $param_mensaje = $mensaje;
            $param_notificaciones = $notificacion; 
        }
        mysqli_stmt_close($stmt);
    }
     
   mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/normalize.css">
    <link rel="stylesheet" href="../CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
    <header>
        
        <!-- Logotipo -->
        <nav class="BarraDeNavegacion">
            <div class="Logotipo">
                <a href="../index.html">
                    <img src="../images/Logoblanco.png" alt="Logotipo" >
                </a>
            </div>
             <!--Barra De Navegacion Y Busqueda -->   
            <ul class="Categoria">
                <li><a href="Productos.html">Productos</a></li>
                <li><a href="QuienesSomos.html">Sobre Nosotros</a> </li>
                <li> <a href="Recomendaciones.html">Recomendaciones</a> </li>
                <li><a href="Contacto.html"> Contacto</a> </li>
                <li><div class="BarraDeBusqueda">
                        <form action="" method="POST" enctype="">
                            <label for="BarraDeBusqueda"></label>
                            <input class="Barrita" type="text" id="BarraDeBusqueda" name="BarraDeBusqueda" value="Buscar...">
                        </form> 
                   </div>
                </li>
            </ul>
        </nav>
          
    </header>
    <main>
       
        <h2>Contacto</h2> 
        <div class="DatosDeContacto">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">           
                <div class="mb-3 form-group <?php echo (!empty($usuario_err)) ? 'has-error' : ''; ?>">
                    <label>Nombre</label>
                    <input title="Nombre" type="text" name="nombre" class="form-control" value="<?php echo $usuario; ?>">
                    <span class="help-block"><?php echo $usuario_err; ?></span>
                </div>   
                <div class="mb-3 form-group <?php echo (!empty($apellido_err)) ? 'has-error' : ''; ?>">
                    <label>Apellido</label>
                    <input title="Apellido" type="text" name="apellido" class="form-control" value="<?php echo $apellido; ?>">
                    <span class="help-block"><?php echo $apellido_err; ?></span>
                </div>   
                <div class="mb-3 form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input title="Email" type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>   
                <div class="mb-3 form-group <?php echo (!empty($mensaje_err)) ? 'has-error' : ''; ?>">
                    <label>Mensaje</label>
                    <textarea class="form-control" name="mensaje" id="mensaje" rows="3" value="<?php echo $mensaje; ?>"></textarea>
                    <span class="help-block"><?php echo $mensaje_err; ?></span>
                </div>   

                <div class="mb-3 form-group <?php echo (!empty($provincia_err)) ? 'has-error' : ''; ?>">
                    <select class="form-select" name="provincia" id="provincia">
                            <option value="Buenos Aires">Buenos Aires </option>
                            <option value="Capital Federal">Capital Federal </option>
                            <option value="Catamarca">Catamarca </option>
                            <option value="Chaco"> Chaco</option>
                            <option value="Chubut"> Chubut</option>
                            <option value="Córdoba">Córdoba </option>
                            <option value="Corrientes">Corrientes </option>
                            <option value="Entre Ríos">Entre Ríos </option>
                            <option value="Formosa">Formosa </option>
                            <option value="Jujuy">Jujuy </option>
                            <option value="La Pampa">La Pampa </option>
                            <option value="La Rioja">La Rioja </option>
                            <option value="Mendoza">Mendoza </option>
                            <option value="Misiones">Misiones </option>
                            <option value="Neuquén">Neuquén </option>
                            <option value="Río Negro">Río Negro </option>
                            <option value="Salta">Salta </option>
                            <option value="San Juan">San Juan </option>
                            <option value="San Luis"> San Luis</option>
                            <option value="Santa Cruz">Santa Cruz </option>
                            <option value="Santa Fe">Santa Fe </option>
                            <option value="Santiago del Estero">Santiago del Estero </option>
                            <option value="Tierra del Fuego"> Tierra del Fuego</option>
                            <option value="Tucumán">Tucumán </option>
                    </select>
                </div>

                <div class="form-check mb-3 form-group">
                    <input class="form-check-input <?php echo (!empty($notificacion_err)) ? 'has-error' : ''; ?>" type="checkbox" value="true" name="notificaciones" id="notificaciones">
                    <label class="form-check-label" for="notificaciones">Quiero recibir informacion por Email</label>
                </div>

                <div class="mb-3 form-group">
                    <input type="submit" class="button btn btn-primary btn-success" title="Enviar" value="Enviar">
                    <input type="reset" class="button btn btn-primary btn-danger" title="Vaciar casilleros" value="Vaciar casilleros">
                </div>

                </form>   
            </div>             
    </main>

    <footer>
       <!--Redes Sociales-->
        <div class="RedesSociales">
                <h3>Red Social 1</h3>
                <h3>Red Social 2</h3>
                <h3>Red Social 3</h3>
        </div>
        <!--Derechos Reservados-->
        <div>
              <p>© 2021 Matias Jerez derechos de autor</p> 
        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>
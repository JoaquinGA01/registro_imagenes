<?php
session_start();

$nombre = $descripcion = $imagen = "";
$nombre_err = $descripcion_err = $imagen_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un nombre";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Por favor ingrese un nombre valido.";
    } else{
        $nombre = $input_nombre;
    }
    
    // Validate address
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Por favor ingrese una descripcion.";     
    } else{
        $descripcion = $input_descripcion;
    }

	$check = getimagesize($_FILES["Imagen"]["tmp_name"]);
    if($check === false){
        $unidad_err = "Por favor ingresa una imagen.";
    }else{
        $image = $_FILES['Imagen']['tmp_name'];
		$imgContent = addslashes(file_get_contents($image));
    }
    
	
    if(empty($nombre_err) && empty($descripcion_err) && empty($imagen_err)){
		$dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'actividadplantas';
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        $insert = $db->query("INSERT INTO plantas (nombre, descripcion, Imagen) VALUES ('$nombre', '$descripcion', '$imgContent')");

            if($insert){
                // Records created successfully. Redirect to landing page
                header("location: index2.php");
                exit();
            } else{
                echo "UPS! Algo salio mal. Por favor, intentelo de nuevo mas tarde.";
            }
         
        // Close statement
        $db->close();
    }
    
    // Close connection
    
}
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Galeria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />

    <link rel="shortcut icon" href="favicon.ico">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/salvattore.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/modernizr-2.6.2.min.js"></script>
</head>

<body>

    <header id="fh5co-header" role="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a class="navbar-brand" href="index2.html">Galeria Plantas</a>
                    <a href="logout.php" class="btn btn-success pull-right"> Cerrar sesión</a>
                </div>
            </div>
            <?php 
			
			?>
        </div>
    </header>

    <div id="fh5co-main">
        <div class="container">

            <div class="row">

                <div id="fh5co-board" data-columns>

                    <?php
						$dbHost     = 'localhost';
						$dbUsername = 'root';
						$dbPassword = '';
						$dbName     = 'actividadplantas';
						$con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
						$res = $con->query("SELECT * FROM Plantas;");
						if($res === null){
							echo '<h1>No hay registros</h1>';
						}else{
						while ($respuesta = $res->fetch_array()){
					?>

                    <div class="item">
                        <div class="animate-box">
                            <a href="data:image/png;base64,<?php echo  base64_encode($respuesta['Imagen']); ?> "
                                class="image-popup fh5co-board-img" title="<?php echo $respuesta['Descripcion'] ?>">
                                <img width="50%"
                                    src="data:image/png;base64,<?php echo  base64_encode($respuesta['Imagen']); ?> ">
                            </a>
                        </div>
                        <div class="fh5co-desc">
                            <h3><?php echo $respuesta['Nombre'] ?> </h3>
                        </div>
                        <div class="fh5co-desc"> <?php echo $respuesta['Descripcion'] ?> </div>
                    </div>


                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
    <?php
	if($_SESSION["Rol"]){
		echo '<div id="fh5co-main">';
		echo '<div class="container">';
				echo '<h1>Nueva </h1>';
				echo '<form action="';echo htmlspecialchars($_SERVER["PHP_SELF"]); echo'" method="post" enctype="multipart/form-data">';
				echo '<div class=id="fh5co-main">';
					echo '<div>';
						echo '<input type="text" name="nombre" id="nombre" value=""';
							echo 'placeholder="Ingresa el titulo" />';
					echo '</div>';
					echo '<div>';
						echo '<textarea name="descripcion" id="descripcion" placeholder="Escribe la Description"';
							echo 'rows="6"></textarea>';
					echo '</div>';
					echo '<div>';
						
								echo '<input type="file" name="Imagen" id="Imagen" accept="image/png">';
						
						
					echo '</div>';
					echo '<div>';
						
							echo '<button>Agregar Planta</button>';
							echo '<input type="reset" id="btnLimpiar" value="Limpiar" />';
						
					echo '</div>';

				echo '</div>';
			echo '</form>';
		echo '</div>';
	echo '</div>';
	}
	?>

    <footer id="fh5co-footer">

        <div class="container">
            <div class="row row-padded">
                <div class="col-md-12 text-center">
                    <p><small> <br>Diseñado por: <a href="https://github.com/JoaquinGA01/registro_imagenes"
                                target="_blank">JoaquinGA</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Magnific Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- Salvattore -->
    <script src="js/salvattore.min.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>




</body>

</html>
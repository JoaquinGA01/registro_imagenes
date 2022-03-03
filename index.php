<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet'
    href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style2.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <!-- Mixins-->
  <!-- Pen Title--> 
  <div class="pen-title">
    <h1>Login</h1>
  </div>
  <div class="container">
    <div class="card"></div>
    <div class="card">
      <h1 class="title">Login</h1>
      <form action="ingreso.php" method="post">
        <div class="input-container">
          <input type="text" id="username" name="username" required="required" />
          <label for="Username">Username</label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="password" id="password" name="password" required="required" />
          <label for="password">Contraseña </label>
          <div class="bar"></div>
        </div>
        <div class="button-container">
          <button><span>Iniciar</span></button>
        </div>
        <div class="footer"><a href="#">Olvidaste tu contraseña?</a></div>
      </form>
    </div>
    <div class="card alt">
      <div class="toggle"></div>
      <h1 class="title">Registrate
        <div class="close"></div>
      </h1>
      <form action="registro.php" method="post">
        <div class="input-container">
          <input type="text" id="username" name="username" required="required"/>
          <label for="username">Username</label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="password" id="password" name="password" required="required" />
          <label for="password">Contraseña</label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="password" id="confirm_password" name="confirm_password" required="required" />
          <label for="confirm_password">Repite la Contraseña</label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <select name="rol" id="rol">
            <option value="1">Administrador</option>
            <option value="0">Visitante</option>
          </select>
        </div>
        <div class="button-container">
          
          <button><span>Registrar</span></button>
        </div>
      </form>
    </div>
  </div>
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/script2.js"></script>

</body>

</html>
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, ingrese un nombre de usuario.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "El nombre de usuario solo puede contener letras, numeros y guiones bajos.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM usuarios WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "Este nombre de usuario ya esta en uso.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "UPS! Algo salio mal. Por favor, intentelo de nuevo mas tarde.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese una clave.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La clave debe tener al menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor confirme la clave.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "La clave no coincidio.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO usuarios (username, password, rol) VALUES ( ?, ?,?)";
         
        if($stmt = $mysqli->prepare($sql)){

            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssi", $param_username, $param_password, $_POST["rol"]);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash            
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: index.html");
            } else{
                echo "UPS! Algo salio mal. Por favor, intentelo de nuevo mas tarde.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
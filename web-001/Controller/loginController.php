<?php
    // Imports
    require_once(__DIR__ . '/../Model/loginModel.php');
    require_once(__DIR__ . '/usuarioController.php');

    class loginController {
            
            // Metodo para loguearse
            public static function login($data) {
                try {
                    
                    // Se validan las credenciales del usuario
                    $user = loginModel::validateUser($data);
                    // print_r($user);

                    // Se verifica si se encontro un usuario
                    if (!is_null($user)) {
                        if(count($user) > 0) {
                            if (!is_null($user[0]['correo_electronico'])) {
                                // Se inicia la sesion
                                session_start();
        
                                // Se guardan los datos del usuario en la sesion
                                $_SESSION['email'] = $user[0]['correo_electronico'];
                                $_SESSION['tipoUsuario'] = $user[0]['tipo_usuario'];
        
                                $idUsuario = usuarioController::getUserByEmail($_POST);
                                $_SESSION['idUsuario'] = $idUsuario[0]['usuario_id'];
        
                                // Se redirige al usuario a la pagina de inicio
                                header('Location: ../html-otros/index.php');
        
                            } else {
                                // Se retorna un mensaje de error
                                echo "<script>alert('Usuario o contraseña incorrectos');</script>";
                                
                            }
                        } else {
                            // Se retorna un mensaje de error
                            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
                            
                        }
                    } else {
                        // Se retorna un mensaje de error
                        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
                        
                    }

                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            }

            // Metodo para desloguearse
            public static function logout() {
                try {
                    // Se inicia la sesion
                    session_start();

                    // Se destruye la sesion
                    session_destroy();

                    // Se redirige al usuario a la pagina de inicio
                    header('Location: ../html-otros/index.php');

                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            }

    }

?>
<?php session_start();
    $usuario='';
    $pass='';
    extract($_POST);
    //var_dump($_POST);
    if($usuario=='' || $pass==''){
        $mensa='Debe completar los campos.';
    }else{
        require_once 'controladores/C_Usuarios.php';
        $objUsuarios= new C_Usuarios();
        $datos['usuario']=$usuario;
        $datos['pass']=$pass;

        $resultado=$objUsuarios->validarUsuario(array(
                                                'usuario'=>$usuario,
                                                'pass'=>$pass
                                            ));

        if($resultado=='S'){
            header('Location: index.php');
        }else{
            $mensa='Datos incorrectos.';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/login.css">
        <!-----------------------------------JAVASCRIPT----------------------------------->
        <script type="text/javascript">
            function validar(){
                const usuario= document.getElementById("usuario");
                const pass= document.getElementById("pass");
                let mensaje='';
                if(usuario.value=='' || pass.value==''){
                    mensaje='Debes completar los campos.';
                }else{
                    //enviar formulario
                    document.getElementById("formularioLogin").submit();
                }
                document.getElementById("msj").innerHTML=mensaje;
            }
        </script>
    </head>
    <!-----------------------------------HTML----------------------------------->
    <body>
    <img src="imagenes/logo.png">
    <br>
    <form id="formularioLogin" name="formularioLogin" method="post" action="login.php">
        <h1>INICIO DE SESIÓN</h1>
        <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" 
                value="<?php echo $usuario; ?>">
                <br>
        <label for="pass">Contraseña:</label><br>   
            <input type="password" id="pass" name="pass" 
                value="<?php echo $pass; ?>"><br>
        <span id="msj"><?php echo $mensa; ?></span>
        <br>
        <button type="button" id="aceptar" onclick="validar()">Aceptar</button>
    </form>

    </body>
</html>
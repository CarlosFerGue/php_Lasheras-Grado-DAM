<?php session_start();
$usuario = '';
$pass = '';
$rol = '';
$permiso = '';
$mensa = '';
extract($_POST);

if ($usuario == '' || $pass == '') {
    $mensa = 'Debes completar los campos';
} else {
    require_once 'controladores/C_Usuarios.php';
    $objUsuarios = new C_Usuarios();
    $datos['usuario'] = $usuario;
    $datos['pass'] = $pass;

    $resultado = $objUsuarios->validarUsuario(array(
        'usuario' => $usuario,
        'pass' => $pass,
    ));

    //login.php --> C_Usuarios.php --> M_Usuarios.php --> vuelve
    $resultadoRolPermiso = $objUsuarios->getRolesyPermisos(array(
        'usuario' => $usuario,
        'pass' => $pass,
    ));

    if ($resultado == 'S') {
        $usuarioRoles = array();
        $usuarioPermisos = array();

        foreach ($resultadoRolPermiso as $row) {
            if (!in_array($row['rol_dominante'], $usuarioRoles) && $row['rol_dominante'] !== null) {
                $usuarioRoles[] = $row['rol_dominante'];
            }

            if (!in_array($row['Id_permisos'], $usuarioPermisos) && $row['Id_permisos'] !== null) {
                $usuarioPermisos[] = $row['Id_permisos'];
            }
        }

        // Almacena el rol y los permisos en sesiones
        $_SESSION['rol'] = $usuarioRoles[0]; // El primer rol obtenido
        $_SESSION['permisos'] = $usuarioPermisos; // Todos los permisos obtenidos   

        //Aqui le pasamos el ROL mas grande del usuario (si es admin y cliente, domina el admin)
        echo "Rol: ";
        switch ($usuarioRoles[0]) {
            case '1':
                echo "Admin";
                break;
            case '2':
                echo "Staff";
                break;
            case '3':
                echo "Cliente";
                break;
            default:
                echo "no rol";
                break;
        }
    }

    // Aqui le pasamos los PERMISOS del usuario en bucle y en base a ellos decidiremos que hacer
    echo ", Permisos: ";
    foreach ($usuarioPermisos as $permiso) {
        switch ($permiso) {
            case '1':
                echo "permiso 1 ";
                break;
            case '2':
                echo "permiso 2 ";
                break;
            case '3':
                echo "permiso 3 ";
                break;
            default:
                echo "no tiene permisos ";
                break;
        }
    }
}
?>


<!-- Aqui esta el front y back del login -->

<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript">
        function validar() {
            const usuario = document.getElementById("usuario");
            const pass = document.getElementById("pass");
            let mensaje = '';
            if (usuario.value == '' || pass.value == '') {
                mensaje = 'Debes completar los campos';
            } else {
                //enviar formulario
                document.getElementById("formularioLogin").submit();
            }
            document.getElementById("msj").innerHTML = mensaje;
        }
    </script>
    <link rel="stylesheet" href="css/login.css">
</head>


<body>
    <a href="index.php" class="volver-link">
        <h2 id="mi-encabezado">Volver</h2>
    </a>

    <div id="contenedor">
        <form id="formularioLogin" name="formularioLogin" method="post" action="login.php">


            <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>">
            <br>


            <label for="pass">Contraseña:</label><br>
            <input type="password" id="pass" name="pass" value="<?php echo $pass; ?>"><br>
            <span id="msj"><?php echo $mensa; ?></span>


            <button type="button" id="aceptar" onclick="validar()">Aceptar</button>



        </form>

    </div>
</body>

</html>
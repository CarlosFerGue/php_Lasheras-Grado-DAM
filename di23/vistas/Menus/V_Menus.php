<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="imagenes/87.ico" type="image/x-icon">
    <link rel="shortcut icon" href="imagenes/87.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- <link rel="stylesheet" href="css/menu.css"> -->
</head>

<body>

    <section id="secMenuPagina" class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #e3f2fd;" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <?php
                        $menus = $datos['menus'];

                        foreach ($menus as $menu) {
                            // Agrega un condicional if para verificar si id_Padre es igual a 0
                            if ($menu['id_Padre'] == 0) {
                        ?>
                                <li class="nav-item">
                                    <?php
                                    // Verifica si hay submenús para crear el desplegable
                                    $submenuItems = obtenerSubMenu($menus, $menu['id_Menu']);
                                    if (!empty($submenuItems)) {
                                    ?>
                                        <div class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php echo $menu['nombre']; ?>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <?php
                                                // Itera sobre los submenús
                                                foreach ($submenuItems as $submenu) {
                                                ?>
                                                    <li>
                                                        <a class="dropdown-item" onclick="getVistaUsuariosSeleccionado('<?php echo $submenu['controlador']; ?>', '<?php echo $submenu['model']; ?>')">
                                                            <?php echo $submenu['nombre']; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <a class="nav-link active" aria-current="page" onclick="getVistaUsuariosSeleccionado('<?php echo $menu['controlador']; ?>', '<?php echo $menu['model']; ?>')">
                                            <?php echo $menu['nombre']; ?>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <?php
    // Función para obtener los submenús de un menú específico
    function obtenerSubMenu($menus, $idPadre)
    {
        $submenu = array();
        foreach ($menus as $menu) {
            if ($menu['id_Padre'] == $idPadre) {
                $submenu[] = $menu;
            }
        }
        return $submenu;
    }
    ?>

    <section id="secContenidoPagina">

    </section>



    <script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
<div class="selector">

    <h3>Rol:</h3>
    <select id="selectRol">
        <option value="" selected>--Elija un rol</option>
        <?php
        $roles = $datos['roles'];
        // Verificar si la variable $roles está definida y no está vacía
        if (isset($roles) && !empty($roles)) {
            // Recorrer el array $roles para generar las opciones del desplegable
            foreach ($roles as $rol) {
                echo "<option value='{$rol['Id']}-{$rol['Nombre']}'>{$rol['Nombre']}</option>";
            }
        } else {
            // Si la variable $roles no está definida o está vacía, mostrar un mensaje de error o manejar la situación según tus necesidades
            echo "<option value=''>No hay roles disponibles</option>";
        }
        ?>
    </select>


    <button type="button" onclick="editarRol()">Editar</button>
    <button type="button" onclick="añadirRol()">Añadir</button>
    <button type="button" onclick="borrarRol()">X</button>

    <h3>Usuario:</h3>
    <select id="selectUsuario">
        <option value="" selected>--Elija un usuario</option>
        <?php
        $usuarios = $datos['usuarios'];

        if (isset($usuarios) && !empty($usuarios)) {

            foreach ($usuarios as $usuario) {
                echo "<option value='{$usuario['login']}'>{$usuario['login']}</option>";
            }
        } else {

            echo "<option value=''>No hay usuarios disponibles</option>";
        }
        ?>
    </select>


</div>


<?php
// Datos de los menús
$menus = $datos['menus'];
$permisos = $datos['permisos'];



// Función para ordenar los menús por su posición
function compararPosiciones($a, $b)
{
    return $a['posicion'] - $b['posicion'];
}

// Ordenar los menús por su posición
usort($menus, 'compararPosiciones');

// Recorremos los menús
foreach ($menus as $menu) {
    // Si el menú tiene id_Padre igual a 0, lo mostramos como una tarjeta principal
    if ($menu['id_Padre'] == 0) {
?>
        <button type="button" onclick="añadirMenu(0, <?php echo $menu['id_Menu']; ?>, '<?php echo $menu['posicion']; ?>')">Añadir Menu</button>
        <!-- Agregar cuadro de texto para el nombre del nuevo menú -->
        <input type="text" id="nombreMenu_<?php echo $menu['id_Menu']; ?>" placeholder="Nombre del menú">

        <div class="tarjeta">

            <div>

                <h3><?php echo $menu['nombre']; ?></h3>

                <button type="button" onclick="editarNombre('<?php echo $menu['id_Menu']; ?>', '<?php echo $menu['nombre']; ?>')">E</button>

            </div>



            <div class="permisos">
                <button type="button" id="botonPermisoMenu" onclick="añadirPermisoMenu(<?php echo $menu['id_Menu']; ?>, '<?php echo $menu['nombre']; ?>')">Añadir permiso</button>
                <label for="b_permisoMenu"></label>
                <input type="text" id="<?php echo $menu['nombre']; ?>" name="b_permisoMenu">

                <!-- Verificar si hay permisos asociados a este menú -->
                <?php foreach ($permisos as $permiso) {
                    if ($permiso['id_Menu'] == $menu['id_Menu']) { ?>
                        <div class="permiso" id="<?php echo $menu['nombre']; ?>/<?php echo $permiso['permiso']; ?>">
                            <p><?php echo $permiso['permiso']; ?></p>
                            <!-- Botón para borrar permiso -->
                            <div class="botonesPermisos">
                            <button type="button" onclick="borrarPermiso('<?php echo $menu['id_Menu']; ?>', '<?php echo $permiso['permiso']; ?>')">X</button>
                            <button type="button" onclick="editarPermiso('<?php echo $menu['id_Menu']; ?>', '<?php echo $permiso['permiso']; ?>')">E</button>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>

            <div class="eliminarMenu">
                <button type="button" id="botonPermisoMenu" onclick="eliminarMenu(<?php echo $menu['id_Menu']; ?>)">Borrar menu</button>
            </div>

            <button type="button" onclick="añadirMenu(1, <?php echo $menu['id_Menu']; ?>, <?php echo $menu['posicion']; ?>)">Añadir Submenu</button>
            <!-- Agregar cuadro de texto para el nombre del nuevo submenú -->
            <input type="text" id="nombreSubMenu_<?php echo $menu['id_Menu']; ?>" placeholder="Nombre del submenú">

            <!-- Buscar y mostrar submenús -->
            <?php foreach ($menus as $submenu) {
                if ($submenu['id_Padre'] == $menu['id_Menu']) { ?>
                    <div class="subtarjeta">
                        <!-- Mostrar nombre del submenú -->
                        <div>

                            <h5><?php echo $submenu['nombre']; ?></h5>

                            <button type="button" onclick="editarNombre('<?php echo $submenu['id_Menu']; ?>', '<?php echo $submenu['nombre']; ?>')">E</button>

                        </div>


                        <div class="permisos">
                            <button type="button" id="botonPermisoMenu" onclick="añadirPermisoSubMenu(<?php echo $submenu['id_Menu']; ?>, '<?php echo $submenu['nombre']; ?>')">Añadir permiso</button>
                            <label for="b_permisoMenu"></label>
                            <input type="text" id="<?php echo $submenu['nombre']; ?>" name="b_permisoMenu">

                            <!-- Verificar si hay permisos asociados a este submenú -->
                            <?php foreach ($permisos as $permiso) {
                                if ($permiso['id_Menu'] == $submenu['id_Menu']) { ?>
                                    <div class="permiso" id="<?php echo $submenu['nombre']; ?>/<?php echo $permiso['permiso']; ?>">
                                        <p><?php echo $permiso['permiso']; ?></p>
                                        <!-- Botón para borrar permiso -->
                                        <button type="button" onclick="borrarPermiso('<?php echo $submenu['id_Menu']; ?>', '<?php echo $permiso['permiso']; ?>')">X</button>
                                        <button type="button" onclick="editarPermiso('<?php echo $submenu['id_Menu']; ?>', '<?php echo $permiso['permiso']; ?>')">E</button>
                                    </div>
                            <?php }
                            } ?>
                        </div>

                        <div class="eliminarMenu">
                            <button type="button" id="botonPermisoMenu" onclick="eliminarMenu(<?php echo $submenu['id_Menu']; ?>)">Borrar submenu</button>
                        </div>
                    </div>
                    <button type="button" onclick="añadirMenu(1, <?php echo $submenu['id_Menu']; ?>, <?php echo $submenu['posicion']; ?>)">Añadir Submenu</button>
                    <!-- Agregar cuadro de texto para el nombre del nuevo submenú -->
                    <input type="text" id="nombreSubMenu_<?php echo $submenu['id_Menu']; ?>" placeholder="Nombre del submenú">
            <?php }
            } ?>
        </div>
<?php
    }
}
?>
<button type="button" onclick="añadirMenu(0, <?php echo $menu['id_Menu']; ?>, '<?php echo $menu['posicion']; ?>')">Añadir Menu</button>
<input type="text" id="nombreMenu_<?php echo $menu['id_Menu']; ?>" placeholder="Nombre del menú">


<!-- Ventanita donde editas los permisos que de normal esta oculta -->
<div id="popup2" class="popup">
    <div class="popup-content">
        <span class="close" onclick="cerrarPopup()">&times;</span>
        <h2>Editar Permiso</h2>
        <input type="text" id="nuevoPermiso" placeholder="Nuevo valor del permiso">
        <button onclick="guardarNuevoPermiso()">Guardar</button>
        <button onclick="cerrarPopup()">Cancelar</button>
    </div>
</div>


<!-- Ventanita donde editas los nombres que de normal esta oculta -->
<div id="popup3" class="popup">
    <div class="popup-content">
        <span class="close" onclick="cerrarPopup3()">&times;</span>
        <h2>Editar Nombre</h2>
        <input type="text" id="nuevoNombre" placeholder="Nuevo valor del nombre">
        <button onclick="nuevoNombre()">Guardar</button>
        <button onclick="cerrarPopup3()">Cancelar</button>
    </div>
</div>


<!-- Ventanita donde editar los roles que de normal esta oculta -->
<div id="popup4" class="popup">
    <div class="popup-content">
        <span class="close" onclick="cerrarPopup4()">&times;</span>
        <h2>Editar Rol</h2>
        <input type="text" id="nuevoRol" placeholder="Nuevo valor del rol">
        <button onclick="editarRol1()">Guardar</button>
        <button onclick="cerrarPopup4()">Cancelar</button>
    </div>
</div>


<!-- Ventanita donde creas los roles que de normal esta oculta -->
<div id="popup5" class="popup">
    <div class="popup-content">
        <span class="close" onclick="cerrarPopup5()">&times;</span>
        <h2>Crear Rol</h2>
        <input type="text" id="nuevoRolCreado" placeholder="Nuevo rol">
        <button onclick="nuevoRolCreado()">Guardar</button>
        <button onclick="cerrarPopup5()">Cancelar</button>
    </div>
</div>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/V_Usuarios.css">
</head>

<body>
    <div id="container">
        <form id="formularioBuscar" name="formularioBuscar" onkeydown="return event.key != 'Enter';">
            <label for="b_texto">Buscar por nombre de usuario:</label>
            <input type="text" id="b_texto" name="b_texto">

        </form>

        <form id="formularioBuscarTelefono" name="formularioBuscarTelefono" onkeydown="return event.key != 'Enter';">
            <label for="b_telefono">Buscar por número de teléfono:</label>
            <input type="text" id="b_telefono" name="b_telefono">
            
        </form>

        <button type="button" onclick="buscar()">Buscar</button>

    </div>

    <div id="CapaResultadoBusqueda">
        <!-- Aquí se mostrarán los resultados de la búsqueda  -->
    </div>


</body>

</html>
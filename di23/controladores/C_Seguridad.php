<?php
require_once 'controladores/Controlador.php';
require_once 'vistas/Vista.php';
require_once 'modelos/M_Seguridad.php';

class C_Seguridad extends Controlador
{
    private $modelo;

    public function __construct()
    {
        parent::__construct();
        $this->modelo = new M_Seguridad();
    }
    //Renderizar la vista de los menus para buscar debajo de la barra superior
    public function getVistaSeguridad()
    {
        Vista::render('vistas/Menus/V_MttoMenus.php');
    }

    public function buscarMenusCards($filtros = array())
    {
        list($menus, $permisos, $roles, $usuarios) = $this->modelo->buscarMenusCards($filtros);
        Vista::render('vistas/Menus/V_MttoMenus_Listado.php', array('menus' => $menus, 'permisos' => $permisos, 'roles' => $roles, 'usuarios' => $usuarios));
    }

    public function añadirPermisoMenu($filtros = array())
    {
        $menus = $this->modelo->añadirPermisoMenu($filtros);
    }

    public function borrarPermisoMenu($filtros = array())
    {
        $menus = $this->modelo->borrarPermisoMenu($filtros);
    }

    public function editarPermisoMenu($filtros = array())
    {
        $menus = $this->modelo->editarPermisoMenu($filtros);
    }

    public function borrarMenu($filtros = array())
    {
        $this->modelo->borrarMenu($filtros);
    }

    public function añadirMenus($filtros = array())
    {
        $this->modelo->añadirMenu($filtros);
    }

    public function añadirSubMenus($filtros = array())
    {
        $this->modelo->añadirSubMenus($filtros);
    }

    public function guardarNombre($filtros = array())
    {
        $this->modelo->guardarNombre($filtros);
    }


    //Apartado de los roles

    public function borrarRol($filtros = array())
    {
        echo json_encode($filtros);
        $this->modelo->borrarRol($filtros);
    }

    public function editarRol($filtros = array())
    {
        echo json_encode($filtros);
        $this->modelo->editarRol($filtros);
    }

    public function añadirRol($filtros = array())
    {
        echo json_encode($filtros);
        $this->modelo->añadirRol($filtros);
    }
}

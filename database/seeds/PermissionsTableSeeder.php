<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'users.show',
            'description'   => 'Ve en detalle cada usuario del sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Podría eliminar cualquier usuario del sistema',
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'roles.show',
            'description'   => 'Ve en detalle cada rol del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Podría eliminar cualquier rol del sistema',
        ]);

        //Sucursales
        Permission::create([
            'name'          => 'Navegar sucursales',
            'slug'          => 'sucursales.index',
            'description'   => 'Lista y navega todas las sucursales del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de sucursales',
            'slug'          => 'sucursales.create',
            'description'   => 'Podría crear nuevas sucursales en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de sucursales',
            'slug'          => 'sucursales.edit',
            'description'   => 'Podría editar sucursal del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar sucursales',
            'slug'          => 'sucursales.destroy',
            'description'   => 'Podría eliminar cualquier sucursal del sistema',
        ]);

        //Sucursales_usuarios (Asignacion de sucursales)
        Permission::create([
            'name'          => 'Navegar sucursales asignadas',
            'slug'          => 'sucursal_usuario.index',
            'description'   => 'Lista y navega todas las sucursales asignadas del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de asignacion de sucursales',
            'slug'          => 'sucursal_usuario.create',
            'description'   => 'Podría crear nueva asignacion sucursales en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de asignacion de sucursales',
            'slug'          => 'sucursal_usuario.edit',
            'description'   => 'Podría editar asignacion de sucursal del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar asignacion de sucursales',
            'slug'          => 'sucursal_usuario.destroy',
            'description'   => 'Podría eliminar cualquier asignacion de sucursal del sistema',
        ]);

        //===== DropdownCategoría ======//
        Permission::create([
            'name'          => 'Navegar dropdown categorias',
            'slug'          => 'dropdown.categorias',
            'description'   => 'navega toda la lista de dropdown de categorias',
        ]);

        //Vivienda, Oficinas - DropdownCategoría
        Permission::create([
            'name'          => 'Navegar categorias generales',
            'slug'          => 'categoria_general.index',
            'description'   => 'Lista y navega toda la categoria general',
        ]);

        Permission::create([
            'name'          => 'Creación de categoria general',
            'slug'          => 'categoria_general.create',
            'description'   => 'Podría crear nueva categoria general en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de categoria general',
            'slug'          => 'categoria_general.edit',
            'description'   => 'Podría editar una categoria general en el sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una categoria general',
            'slug'          => 'categoria_general.show',
            'description'   => 'Ve en detalle cada categoria general del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar categoria general',
            'slug'          => 'categoria_general.destroy',
            'description'   => 'Podría eliminar cualquier categoria general del sistema',
        ]);

        //Urbanizaciones - DropdownCategoría
        Permission::create([
            'name'          => 'Navegar categoria urbanizacion',
            'slug'          => 'categoria_urbanizacion.index',
            'description'   => 'Lista y navega toda la categoria urbanizacion',
        ]);

        Permission::create([
            'name'          => 'Creación de categoria urbanizacion',
            'slug'          => 'categoria_urbanizacion.create',
            'description'   => 'Podría crear nueva categoria general en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de categoria urbanizacion',
            'slug'          => 'categoria_urbanizacion.edit',
            'description'   => 'Podría editar una categoria urbanizacion en el sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una categoria urbanizacion',
            'slug'          => 'categoria_urbanizacion.show',
            'description'   => 'Ve en detalle cada categoria urbanizacion del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar categoria urbanizacion',
            'slug'          => 'categoria_urbanizacion.destroy',
            'description'   => 'Podría eliminar cualquier categoria urbanizacion del sistema',
        ]);

        //===== DropdownPersona ======//
        Permission::create([
            'name'          => 'Navegar dropdown personas',
            'slug'          => 'dropdown.personas',
            'description'   => 'navega toda la lista de dropdown de personas',
        ]);

        //Personas - DropdownPersona
        Permission::create([
            'name'          => 'Navegar personas',
            'slug'          => 'personas.index',
            'description'   => 'Lista y navega todas las personas',
        ]);

        Permission::create([
            'name'          => 'Creación de persona',
            'slug'          => 'personas.create',
            'description'   => 'Podría crear nueva persona en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de persona',
            'slug'          => 'personas.edit',
            'description'   => 'Podría editar una persona en el sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una persona',
            'slug'          => 'personas.show',
            'description'   => 'Ve en detalle cada persona del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar persona',
            'slug'          => 'personas.destroy',
            'description'   => 'Podría eliminar cualquier persona del sistema',
        ]);

        //Deudas Arquitecto - DropdownPersona
        Permission::create([
            'name'          => 'Navegar deudas arquitectos',
            'slug'          => 'deudapersona.index',
            'description'   => 'Lista y navega todas las deudas de arquitectos',
        ]);

        Permission::create([
            'name'          => 'Creación de deuda del arquitecto',
            'slug'          => 'deudapersona.create',
            'description'   => 'Podría crear nueva deuda del arquitecto en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de deuda del arquitecto',
            'slug'          => 'deudapersona.edit',
            'description'   => 'Podría editar deuda del arquitecto en el sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una deuda del arquitecto',
            'slug'          => 'deudapersona.show',
            'description'   => 'Ve en detalle cada deuda del arquitecto en el sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar deuda del arquitecto',
            'slug'          => 'deudapersona.destroy',
            'description'   => 'Podría eliminar cualquier deuda del arquitecto en el sistema',
        ]);

        //Venta de Servicios - DropdownPersona
        Permission::create([
            'name'          => 'Navegar ventas de servicio',
            'slug'          => 'ventaservicio.index',
            'description'   => 'Lista y navega todas las ventas de servicio',
        ]);

        Permission::create([
            'name'          => 'Creación de nueva venta de servicio',
            'slug'          => 'ventaservicio.create',
            'description'   => 'Podría crear nueva venta de servicio en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de venta de servicio',
            'slug'          => 'ventaservicio.edit',
            'description'   => 'Podría editar la venta en el sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una venta de servicio',
            'slug'          => 'ventaservicio.show',
            'description'   => 'Ve en detalle cada venta en el sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar venta de servicio',
            'slug'          => 'ventaservicio.destroy',
            'description'   => 'Podría eliminar cualquier venta de servicio en el sistema',
        ]);

        //===== DropdownProyectos ======//
        Permission::create([
            'name'          => 'Navegar dropdown proyectos',
            'slug'          => 'dropdown.proyectos',
            'description'   => 'navega toda la lista de dropdown de proyectos',
        ]);

        //Vivienda, Oficinas - DropdownProyectos
        Permission::create([
            'name'          => 'Navegar proyectos generales',
            'slug'          => 'proyecto_general.index',
            'description'   => 'Lista y navega todos los proyectos generales',
        ]);

        Permission::create([
            'name'          => 'Creación de proyecto general',
            'slug'          => 'proyecto_general.create',
            'description'   => 'Podría crear nuevo proyecto general en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de proyecto general',
            'slug'          => 'proyecto_general.edit',
            'description'   => 'Podría editar un proyecto general en el sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de proyecto general',
            'slug'          => 'proyecto_general.show',
            'description'   => 'Ve en detalle cada proyecto general del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar proyecto general',
            'slug'          => 'proyecto_general.destroy',
            'description'   => 'Podría eliminar cualquier proyecto general del sistema',
        ]);

        //Urbanizaciones - DropdownProyectos
        Permission::create([
            'name'          => 'Navegar proyectos de urbanizacion',
            'slug'          => 'proyecto_urbanizacion.index',
            'description'   => 'Lista y navega todos los proyectos de urbanizaciones',
        ]);

        Permission::create([
            'name'          => 'Creación de proyecto urbanizacion',
            'slug'          => 'proyecto_urbanizacion.create',
            'description'   => 'Podría crear nuevo proyecto urbanizacion en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de proyecto urbanizacion',
            'slug'          => 'proyecto_urbanizacion.edit',
            'description'   => 'Podría editar un proyecto urbanizacion en el sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un proyecto urbanizacion',
            'slug'          => 'proyecto_urbanizacion.show',
            'description'   => 'Ve en detalle cada proyecto urbanizacion del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar proyecto urbanizacion',
            'slug'          => 'proyecto_urbanizacion.destroy',
            'description'   => 'Podría eliminar cualquier proyecto urbanizacion del sistema',
        ]);

        //===== DropdownConfiguraciones ======//
        Permission::create([
            'name'          => 'Navegar dropdown de configuraciones',
            'slug'          => 'dropdown.configuraciones',
            'description'   => 'navega toda la lista de dropdown de configuraciones',
        ]);

        //Tipos de Pago - DropdownConfiguraciones
        Permission::create([
            'name'          => 'Navegar tipos de pago',
            'slug'          => 'tipopago.index',
            'description'   => 'Lista y navega todos los tipos de pago',
        ]);

        Permission::create([
            'name'          => 'Creación de nuevo tipo de pago',
            'slug'          => 'tipopago.create',
            'description'   => 'Podría crear nuevo tipo de pago en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de tipo de pago',
            'slug'          => 'tipopago.edit',
            'description'   => 'Podría editar el tipo de pago en el sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de tipo de pago',
            'slug'          => 'tipopago.show',
            'description'   => 'Ve en detalle cada tipo de pago en el sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar tipo de pago',
            'slug'          => 'tipopago.destroy',
            'description'   => 'Podría eliminar cualquier tipo de pago en el sistema',
        ]);

        //Tipos de servicios - DropdownConfiguraciones
        Permission::create([
            'name'          => 'Navegar tipos de servicio',
            'slug'          => 'tiposervicio.index',
            'description'   => 'Lista y navega todos los tipos de servicio',
        ]);

        Permission::create([
            'name'          => 'Creación de nuevo tipo de servicio',
            'slug'          => 'tiposervicio.create',
            'description'   => 'Podría crear nuevo tipo de servicio en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de tipo de servicio',
            'slug'          => 'tiposervicio.edit',
            'description'   => 'Podría editar el tipo de servicio en el sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de tipo de servicio',
            'slug'          => 'tiposervicio.show',
            'description'   => 'Ve en detalle cada tipo de servicio en el sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar tipo de servicio',
            'slug'          => 'tiposervicio.destroy',
            'description'   => 'Podría eliminar cualquier tipo de servicio en el sistema',
        ]);

        //===== DropdownReportes ======//
        Permission::create([
            'name'          => 'Navegar dropdown reportes',
            'slug'          => 'dropdown.reportes',
            'description'   => 'navega toda la lista de dropdown de reportes',
        ]);

        //Aviso invitado
        Permission::create([
            'name'          => 'Visualizar aviso del invitado',
            'slug'          => 'invitado.index',
            'description'   => 'visualizar mensaje de invitado',
        ]);
    }
}

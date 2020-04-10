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

        //Gimnasio
        Permission::create([
            'name'          => 'Navegar gimnasios',
            'slug'          => 'gimnasios.index',
            'description'   => 'Lista y navega todos los gimnasios del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un gimnasio',
            'slug'          => 'gimnasios.show',
            'description'   => 'Ve en detalle cada gimnasio del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de gimnasios',
            'slug'          => 'gimnasios.create',
            'description'   => 'Podría crear nuevos gimnasios en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de gimnasios',
            'slug'          => 'gimnasios.edit',
            'description'   => 'Podría editar cualquier dato de un gimnasio del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar gimnasios',
            'slug'          => 'gimnasios.destroy',
            'description'   => 'Podría eliminar cualquier gimnasio del sistema',      
        ]);

        //Especialidad
        Permission::create([
            'name'          => 'Navegar especialidades',
            'slug'          => 'especialidades.index',
            'description'   => 'Lista y navega todas las especialidades del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una especialidad',
            'slug'          => 'especialidades.show',
            'description'   => 'Ve en detalle cada especialidad del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de especialidades',
            'slug'          => 'especialidades.create',
            'description'   => 'Podría crear nuevas especialidades en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de especialidades',
            'slug'          => 'especialidades.edit',
            'description'   => 'Podría editar cualquier dato de una especialidad del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar especialidades',
            'slug'          => 'especialidades.destroy',
            'description'   => 'Podría eliminar cualquier cliente del sistema',      
        ]);

        //Cliente
        Permission::create([
            'name'          => 'Navegar clientes',
            'slug'          => 'clientes.index',
            'description'   => 'Lista y navega todos los clientes del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una cliente',
            'slug'          => 'clientes.show',
            'description'   => 'Ve en detalle cada cliente del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de clientes',
            'slug'          => 'clientes.create',
            'description'   => 'Podría crear nuevos clientes en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de clientes',
            'slug'          => 'clientes.edit',
            'description'   => 'Podría editar cualquier dato de un cliente del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar clientes',
            'slug'          => 'clientes.destroy',
            'description'   => 'Podría eliminar cualquier cliente del sistema',      
        ]);

        //Inscripcion
        Permission::create([
            'name'          => 'Navegar inscripciones',
            'slug'          => 'inscripciones.index',
            'description'   => 'Lista y navega todos las inscripciones del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una inscripcion',
            'slug'          => 'inscripciones.show',
            'description'   => 'Ve en detalle cada inscripcion del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de inscripciones',
            'slug'          => 'inscripciones.create',
            'description'   => 'Podría crear nuevas inscripciones en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de inscripciones',
            'slug'          => 'inscripciones.edit',
            'description'   => 'Podría editar cualquier dato de una inscripcion del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar inscripciones',
            'slug'          => 'inscripciones.destroy',
            'description'   => 'Podría eliminar cualquier inscripcion del sistema',      
        ]);


        //Cuota
        Permission::create([
            'name'          => 'Navegar cuotas',
            'slug'          => 'cuotas.index',
            'description'   => 'Lista y navega todas las cuotas del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una cuota',
            'slug'          => 'cuotas.show',
            'description'   => 'Ve en detalle cada cuota del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de cuotas',
            'slug'          => 'cuotas.create',
            'description'   => 'Podría crear nuevas cuotas en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de cuotas',
            'slug'          => 'cuotas.edit',
            'description'   => 'Podría editar cualquier dato de una cuota del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar cuotas',
            'slug'          => 'cuotas.destroy',
            'description'   => 'Podría eliminar cualquier cuota del sistema',      
        ]);

        //BajaCliente
        Permission::create([
            'name'          => 'Navegar bajas',
            'slug'          => 'bajas.index',
            'description'   => 'Lista y navega todas las bajas del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una baja',
            'slug'          => 'bajas.show',
            'description'   => 'Ve en detalle cada baja del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de bajas',
            'slug'          => 'bajas.create',
            'description'   => 'Podría crear nuevas bajas en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de bajas',
            'slug'          => 'bajas.edit',
            'description'   => 'Podría editar cualquier dato de una baja del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar bajas',
            'slug'          => 'bajas.destroy',
            'description'   => 'Podría eliminar cualquier baja del sistema',      
        ]);

    }
}

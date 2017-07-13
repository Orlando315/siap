<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $this->call(UsersTableSeeder::class);
      //  $faker = Faker\Factory::create();

        App\User::create([
          'nombres'   => 'Test',
          'apellidos' => 'Developer',
          'email'     => 'admin@admin.com',
          'password'  => bcrypt('123456')
        ]);

        App\Organizacion::create([
        	'organizacion' => 'PAI'
        ]);

        App\Organizacion::create([
        	'organizacion' => 'Biggot'
        ]);

        App\Tecnico::create([
        	'nombres' => 'Tecnico 1',
        	'apellidos' => 'Apellido 1',
        	'cedula' => '2213423',
        	'email' => 'tecnico@siap.com',
        	'estado' => 'Guarico',
        	'tlf_personal' => '22133213',
        	'tlf_opcional' => '412003120'
        ]);

        App\Tecnico::create([
        	'nombres' => 'Tecnico 2',
        	'apellidos' => 'Apellido 2',
        	'cedula' => '22134324',
        	'email' => 'tecnico2@siap.com',
        	'estado' => 'Cojedes',
        	'tlf_personal' => '23211663',
        	'tlf_opcional' => '414685895'
        ]);

        App\Productor::create([
        	'tecnico_id' => 1,
          'nombres' => 'Productor 1',
          'apellidos' => 'Apellido 1',
          'tipo' => 'V',
          'identificacion' => '20000000',
          'email' => 'productor1@siap.com',
          'estado' => 'Guarico',
          'tlf_personal' => '04240000000',
          'tlf_oficina' => '04240000000',
          'tlf_administracion' => '04240000000',
          'direccion' => 'Direccion',
          'contacto' => 'Contacto'
        ]);

        App\Productor::create([
        	'tecnico_id' => 1,
        	'organizacion_id' => 1,
          'nombres' => 'Productor 2',
          'apellidos' => 'Apellido 2',
          'tipo' => 'V',
          'identificacion' => '20000020',
          'email' => 'productor2@siap.com',
          'estado' => 'Portuguesa',
          'tlf_personal' => '04240000000',
          'tlf_oficina' => '04240000000',
          'tlf_administracion' => '04240000000',
          'direccion' => 'Direccion',
          'contacto' => 'Contacto'
        ]);

        App\Productor::create([
        	'tecnico_id' => 2,
        	'organizacion_id' => 2,
          'nombres' => 'Productor 3',
          'apellidos' => 'Apellido 3',
          'tipo' => 'V',
          'identificacion' => '20000030',
          'email' => 'productor3@siap.com',
          'estado' => 'Portuguesa',
          'tlf_personal' => '04240000000',
          'tlf_oficina' => '04240000000',
          'tlf_administracion' => '04240000000',
          'direccion' => 'Direccion',
          'contacto' => 'Contacto'
        ]);

        App\Ciclo::create([
        	'ciclo'  => 'Verano 1',
        	'anio'   => 2017,
        	'status' => true
        ]);

        App\Unidad::create([
        	'productor_id' => 1,
        	'unidad'       => 'La Vaquera',
        	'ubicacion'    => 'Guarico, algun lugar'
        ]);

        App\Lote::create([
        	'unidad_id' => 1,
        	'lote' => '1'
        ]);

        App\Lote::create([
        	'unidad_id' => 1,
        	'lote' => '2'
        ]);

        App\Lote::create([
        	'unidad_id' => 1,
        	'lote' => '3'
        ]);

        App\CicloProductor::create([
        	'ciclo_id' => 1,
        	'productor_id' => 1,
        	'unidad_id' => 1
        ]);

        App\Actividad::create([
        	'ciclo_productor_id' =>1
        ]);
    }
}

<?php

    use App\Models\Role;
    use Illuminate\Database\Seeder;

    class RolesStart extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $administrator = Role::create([
                'name'          => "Administrator",
                'description'   => "SuperAdmin",
                'group'         => "interno",
                'type'          => "função",
            ]);

            $usuarioN1 = Role::create([
                'name'          => "userN1",
                'description'   => "userN1",
                'group'         => "interno",
                'type'          => "função",
            ]);

            $usuarioN2 = Role::create([
                'name'          => "userN2",
                'description'   => "userN2",
                'group'         => "interno",
                'type'          => "função",
            ]);

            $departamento1 = Role::create([
                'name'          => "Support",
                'description'   => "Support",
                'group'         => "interno",
                'type'          => "departamento",
            ]);
        }
    }

<?php

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class UserStart extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = User::create([
            "first_name"    => "Administrator",
            "last_name"     => "SuperAdmin",
            "email"         => "admin@admin",
            "password"      => Hash::make("admin"),
        ]);
        $administrator->roles()->sync([1], true);

        $user1 = User::create([
            "first_name"    => "UserN1",
            "last_name"     => "UserN1",
            "email"         => "usern1@usern1",
            "password"      => Hash::make("usern1"),
        ]);
        $user1->roles()->sync([2], true);

        $user2 = User::create([
            "first_name"    => "UserN2",
            "last_name"     => "Segundo",
            "email"         => "usern2@usern2",
            "password"      => Hash::make("usern2"),
        ]);
        $user2->roles()->sync([3,4], true);
    }
}

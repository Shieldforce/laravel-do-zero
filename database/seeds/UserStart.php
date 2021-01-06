<?php

    use App\User;
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
        $user1 = User::create([
            "first_name"    => "User",
            "last_name"     => "Primeiro",
            "email"         => "user1@user1",
            "password"      => Hash::make("user1"),
        ]);

        $user2 = User::create([
            "first_name"    => "User",
            "last_name"     => "Segundo",
            "email"         => "user2@user2",
            "password"      => Hash::make("user2"),
        ]);

        $user3 = User::create([
            "first_name"    => "User",
            "last_name"     => "Terceiro",
            "email"         => "user3@user3",
            "password"      => Hash::make("user3"),
        ]);
    }
}

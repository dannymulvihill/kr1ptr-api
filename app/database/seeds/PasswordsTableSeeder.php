<?php

class PasswordsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('passwords')->delete();

        Passwords::create(array(
            'id' => '58958348-f0ff-485a-8f86-c92dfa9dfb56',
            'name' => 'Super Secret Password',
            'username' => 'danny',
            'host' => 'https://secret.com/login',
            'password' => '0QJqPG0rfFMj7Jvz',
        ));

        Passwords::create(array(
            'id' => 'c6cbed00-4513-4983-947a-58ef696a3090',
            'name' => 'Super Secret Password 2',
            'username' => 'pasi',
            'host' => 'https://secret2.com/login',
            'password' => '0QJqPG0rfFMj7Jvz',
        ));
    }

}
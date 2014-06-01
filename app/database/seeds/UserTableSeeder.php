<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'id' => '6d93a24f-d588-4a9e-80d4-4e821f53421e',
            'first_name' => 'danny',
            'last_name' => 'mulvihill',
            'email' => 'danny@mulvihill.us',
            'password' => Hash::make('first_password')
        ));

        User::create(array(
            'id' => '374d1544-665c-4b4e-ab44-eab085453a49',
            'first_name' => 'alexa',
            'last_name' => 'mulvihill',
            'email' => 'pasi@mulvihill.us',
            'password' => Hash::make('second_password')
        ));
    }

}
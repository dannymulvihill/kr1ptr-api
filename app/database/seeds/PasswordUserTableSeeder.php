<?php

class PasswordUserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('password_user')->delete();

        PasswordUser::create(array(
            'password_id' => '58958348-f0ff-485a-8f86-c92dfa9dfb56',
            'user_id' => '6d93a24f-d588-4a9e-80d4-4e821f53421e',
            'is_owner' => 1,
            'can_edit' => 1,
            'can_delete' => 1,
            'can_share' => 1,
        ));

        PasswordUser::create(array(
            'password_id' => 'c6cbed00-4513-4983-947a-58ef696a3090',
            'user_id' => '6d93a24f-d588-4a9e-80d4-4e821f53421e',
            'is_owner' => 1,
            'can_edit' => 1,
            'can_delete' => 1,
            'can_share' => 1,
        ));

        PasswordUser::create(array(
            'password_id' => '58958348-f0ff-485a-8f86-c92dfa9dfb56',
            'user_id' => '374d1544-665c-4b4e-ab44-eab085453a49',
            'is_owner' => 0,
            'can_edit' => 0,
            'can_delete' => 0,
            'can_share' => 0,
        ));
    }

}
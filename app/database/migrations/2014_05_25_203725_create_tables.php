<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('first_name', 50);
		    $table->string('last_name', 50);
		    $table->string('email')->unique();
		    $table->string('password', 64);
		    $table->timestamps();
		    $table->softDeletes();
		});

		Schema::create('passwords', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('name', 50)->nullable();
		    $table->string('username', 50)->nullable();
		    $table->string('host', 128)->nullable();
		    $table->string('password', 64)->nullable();
			$table->text('notes')->nullable();
			$table->text('encrypted_notes')->nullable();
		    $table->timestamps();
		    $table->softDeletes();
		});

		Schema::create('password_user', function(Blueprint $table)
		{
			$table->string('password_id', 36)->references('id')->on('passwords');
			$table->string('user_id', 36)->references('id')->on('users');
			$table->boolean('is_owner');
			$table->boolean('can_edit');
			$table->boolean('can_delete');
			$table->boolean('can_share');
			$table->timestamps();
			$table->softDeletes();

			$table->primary(array('password_id', 'user_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
		Schema::dropIfExists('passwords');
		Schema::drop('password_user');
	}

}

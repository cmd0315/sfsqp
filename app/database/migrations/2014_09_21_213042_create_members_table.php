<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 60);
			$table->string('middle_name', 60);
			$table->string('last_name', 60);
			$table->date('birthdate');
			$table->string('gender', 3);
			$table->string('civil_status', 10);
			$table->integer('country_id');
			$table->string('street_address', 150);
			$table->integer('location_id');
			$table->string('other_location', 150);
			$table->integer('area');
			$table->string('email', 60);
			$table->string('mobile', 30);
			$table->string('telephone', 30);
			$table->string('fb', 250);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members');
	}

}

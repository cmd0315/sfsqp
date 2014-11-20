<?php

class AccountSeeder extends ChurchSeeder {

	protected $table = "accounts";

	public function getData() {
		return [
			['username' => 'crist_lopez', 'password' => Hash::make('testing1234'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['username' => 'admin', 'password' => Hash::make('testing123'), 'created_at' => new DateTime, 'updated_at' => new DateTime]
		];
	}
}
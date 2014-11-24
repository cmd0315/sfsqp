<?php

class CountrySeeder extends ChurchSeeder {

	protected $table = "countries";

	public function getData() {
		return [
			['country_name' => 'Philippines','created_at' => new DateTime, 'updated_at' => new DateTime],
			['country_name' => 'United States','created_at' => new DateTime, 'updated_at' => new DateTime]
		];
	}
}
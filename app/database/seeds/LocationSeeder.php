<?php
use Flynsarmy\CsvSeeder\CsvSeeder;

class LocationSeeder extends CsvSeeder{

	public function __construct()
    {
        $this->table = 'locations';
        $this->filename = app_path().'/database/seeds/csvs/locations.csv';
        $this->insert_chunk_size = 300;
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
       // DB::table($this->table)->truncate();

        parent::run();
    }
}
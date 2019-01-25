<?php

use Illuminate\Database\Seeder;
use App\Series;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('ws_series')->truncate();

        $json = File::get('database/data/series.json');
        $data = json_decode($json);

        if(!empty($data)) {
            foreach($data as $obj) {
                Series::create(array(
                    'name' => $obj->name,
                    'name_eng' => $obj->name_eng,
                    'set_codes' => json_encode($obj->set_codes)
                ));
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

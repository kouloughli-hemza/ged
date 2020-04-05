<?php

use Illuminate\Database\Seeder;

class DirectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Kouloughli\Direction::create([
            'direc_name' => 'GED WILAYA MILA',
            'direc_description' => 'DIRECTION SUPER USER',
            'direc_email' => 'GED@mila.dz',
            'direc_phone' => '031000000',
            'direc_status' => \Kouloughli\Support\Enum\DirectionStatus::ACTIVE,
            'folder_path' => 'zaki',
        ]);
    }
}

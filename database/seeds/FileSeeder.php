<?php

use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    use \Kouloughli\Traits\ProgressableSeedTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // progress bar start, no default max provided
        $bar = $this->command->getOutput()->createProgressBar(100);
        //$this->command->getOutput()->progressStart();

        factory('Kouloughli\File',100)->create()->each(function ($u) use($bar){
            $bar->advance(1);
        });

        // End progress bar
        $bar->finish();
    }
}

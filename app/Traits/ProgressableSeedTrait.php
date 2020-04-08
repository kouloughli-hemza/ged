<?php
/**
 * Created by PhpStorm.
 * User: kouloughli
 * Date: 4/6/20
 * Time: 7:22 PM
 */
namespace Kouloughli\Traits;

trait ProgressableSeedTrait
{
    public function run()
    {
        $seeders = $this->seeders;

        $this->command->info('Seeding ' . __CLASS__ . '...');
        $this->command->getOutput()->progressStart(count($seeders));

        foreach ($seeders as $class => $is_class) {
            if ($is_class) {
                $this->call($class, true);
            } else {
                $method = $class;
                $this->$method();
            }
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
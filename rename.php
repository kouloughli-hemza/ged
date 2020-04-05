<?php
/**
 * Created by PhpStorm.
 * User: kouloughli
 * Date: 2/1/20
 * Time: 4:56 PM
 */

$dir = scandir ("public/theme/assets/css");
foreach ($dir as $fileName)
{
    $newFile = str_replace("dashforge", "kouloughli", $fileName);
    rename($fileName,$newFile);
}
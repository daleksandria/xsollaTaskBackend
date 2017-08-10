<?php

class Substring
{
    public function findV($str)
    {
        list($x, $y, $z) = explode(" ", $str);

        // вычислим наибольший общий делитель длин строк x, y, z
        $gcd = gmp_gcd(gmp_gcd(strlen($x), strlen($y)), strlen($z));

        // находим предполагаемую подстроку v
        $v = substr($x, 0, (int)$gcd);

        // проверяем v
        if (substr_count($x, $v) * strlen($v) == strlen($x) &&
            substr_count($y, $v) * strlen($v) == strlen($y) &&
            substr_count($z, $v) * strlen($v) == strlen($z))
            print_r($v . PHP_EOL);
        else
            print_r("Not found" . PHP_EOL);
    }
}

if ($argc > 1) {
    Substring::findV($argv[1]);
} else {
    echo "Error. Parameters count less than 2\n";
}
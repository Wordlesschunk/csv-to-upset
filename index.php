<?php

use Symfony\Component\ErrorHandler\Debug;

require 'vendor/autoload.php';

Debug::enable();

$csvFile = 'statement.csv';

if (!file_exists($csvFile)) {
    throw new \RuntimeException('No File Found! Please make sure the CSV is named statement.csv');
}

$totalOut = 0;
$totalIn = 0;

$totalFoodOUT = 0;

$row = 1;
if (($handle = fopen($csvFile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
        
        $incomeValue = (float) $data[2];
        $outgoingValue = (float) $data[3];
        
        $totalIn += $incomeValue;
        $totalOut += $outgoingValue;
        
        if (str_contains($data[1], 'MCDONALDS')) {
            $totalFoodOUT += $outgoingValue;
        }
        
        $num = count($data);
        $row++;
        
    }
    fclose($handle);
    
    dd($totalFoodOUT);
}


<?php

/* Sample inputs */
//$prices = [1,2,3,3,3,3,3,3,1,5,6,11,22,33,5,4,3,2,1000, 2000, 3000];
//$prices = [10,20,30,40,50,11,9,7,5,3];
//$prices = [4,1];
//$prices = [10,9,8,8,6,1,2,3,4,5,6,7,8,9,10,100,50,101,90,10,20,85];
$prices = [10,9,11,50,1,2,3,4,5,1,3,5,7,9,12,50];

$result = cryptoCurrency($prices);
var_dump($result);

/**
 * Determine the optimal point to buy and sell from an array of integers representing a currency.
 *  There may be multiple fluctuations (high and low points in the currency price).
 *  Determine the optimal point at which to buy and then subsequently sell to make the maximum profit.
 *  If no profit can be made, return 0.
 */
function cryptoCurrency($prices = []) {
    /* Record all increasing vectors where a <= b <= ... <= n */
    $vector = [];
    $miniVector = [];
    for ($i = 0; $i < count($prices)-1; $i++) {
        $miniVector[] = $i;
        if ($prices[$i] > $prices[$i+1]) {
            $vector[] = $miniVector;
            $miniVector = [];
        }
    }

    if (count($miniVector)) {
        $miniVector[] = count($prices)-1;
        $vector[] = $miniVector;
    }

    /* Calculate vector with largest payoff */
    $max_profit = 0;
    $v = $vector[count($vector)-1];
    foreach ($vector as $key => $value) {
        if (count($value) <= 1) {
            continue;
        }
        $size = count($value)-1;
        $payoff = ($prices[$value[$size]] - $prices[$value[0]]);
        if ($payoff > $max_profit) {
            $max_profit = $payoff;
        }
        $val = $prices[$v[count($v)-1]] - $prices[$value[0]];
        if ($val > $max_profit) {
            $max_profit = $val;
        }
    }

    return $max_profit;
}


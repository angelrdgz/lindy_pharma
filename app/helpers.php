<?php

if (! function_exists('convert')) {
    function convert($type1 = 0, $type2 = 0, $quantity = 0)
    {
        $total = 0;

        if ($type1 == 2 && $type2 == 1) {
            $total = $quantity * 1000;
        } elseif ($type1 == 2 && $type2 == 6) {
            $total = $quantity * 1000000;
        } elseif ($type1 == 4 && $type2 == 6) {
            $total = $quantity * 1000000;
        } elseif ($type1 == 4 && $type2 == 3) {
            $total = $quantity * 1000000;
        } else {
            $total = $quantity;
        }

        return $total;
    }
}

function reverse($type1 = 0, $type2 = 0, $quantity = 0)
    {
        $total = 0;

        if ($type1 == 2 && $type2 == 1) {
            $total = $quantity / 1000;
        } elseif ($type1 == 2 && $type2 == 6) {
            $total = $quantity / 1000000;
        } elseif ($type1 == 4 && $type2 == 6) {
            $total = $quantity / 1000000;
        } elseif ($type1 == 4 && $type2 == 3) {
            $total = $quantity / 1000000;
        } else {
            $total = $quantity;
        }

        return $total;
    }

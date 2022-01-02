<?php

function electricity_bill($units)
{
    if ($units <= 50) {
        echo "Electricity-Bill= " . $units * 3.50;
    } elseif ($units > 50 && $units <= 150) {
        echo "Electricity-Bill= " . $units * 4;
    } else {
        echo "Electricity-Bill= " . $units * 6.50;
    }
}

$units = 51; // add your units here
electricity_bill($units);

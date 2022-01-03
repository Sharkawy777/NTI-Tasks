<?php

function electricity_bill($units)
{
    if ($units <= 50) {
        echo "Electricity-Bill= " . $units * 3.50;
    } elseif ($units <= 150) {
        echo "Electricity-Bill= " . (50 * 3.50 + ($units-50)*4.00);
    } else {
        echo "Electricity-Bill= " . ((50 * 3.50) + (100 * 4.00) + ($units-150) * 6.50);
    }
}

$units = 51; // add your units here
electricity_bill($units);

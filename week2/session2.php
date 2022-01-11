<?php

$data = file_get_contents('http://shopping.marwaradwan.org/api/Products/1/1/0/100/atoz');
$arrayData = json_decode($data, true);

//print_r($arrayData);

//echo $arrayData['products_id'],


foreach ($arrayData['data'] as $key => $value) {
    echo 'products_id: ' . $value['products_id'] ." || ". "products_quantity: " . $value["products_quantity"] ." || ". "products_model: " . $value["products_model"] . '<br>';
}
